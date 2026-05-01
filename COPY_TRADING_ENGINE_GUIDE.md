# In-House Copy Trading Engine - Implementation Guide

## 📌 Overview

The **Copy Trading Engine** is the core of our new trading system. Instead of relying on external APIs, we build our own system to:

- Monitor master accounts for trades
- Replicate trades to subscriber accounts
- Enforce risk management rules
- Track all activity for auditing

---

## 🏗️ Architecture Components

### **1. Trade Signal Detection**

**How it works:**

```
Every 30 seconds:
1. Check each master account for new trades
2. Compare with what we already have (avoid duplicates)
3. Create TradeSignal record
4. Emit TradeSignalDetected event
5. Queue replication job
```

**Code Flow:**

```
MonitorCopyTrading command (every 30 sec)
    ↓
CopyTradingEngine::monitorMasterAccount()
    ↓
Fetch trades from MT4 API
    ↓
Check if trade already exists
    ↓
TradeSignal::create()
    ↓
event(new TradeSignalDetected($signal))
```

### **2. Trade Replication**

**How it works:**

```
For EACH subscriber copying from this master:
1. Get subscribers' risk settings
2. Calculate adjusted position size
3. Validate against risk limits
4. Execute trade on subscriber's MT4
5. Log the copied trade
6. Update subscriber's last_copied_trade_at
```

**Code Flow:**

```
ReplicateTradeSignalListener listens for event
    ↓
Dispatch ReplicateTradeSignalJob to queue
    ↓
Job runs ReplicateTradeSignalJob::handle()
    ↓
CopyTradingEngine::replicateTradeSignal()
    ↓
For each subscriber in CopyTradeRelationship:
    ├─ calculatePositionSize()
    ├─ isWithinRiskLimits()
    ├─ executeTradeOnMt4()
    └─ CopyTradeLog::create()
```

### **3. Risk Management**

**Position Sizing Strategies:**

1. **Exact**: Copy master's volume as-is

   ```php
   subscriber_volume = master_volume
   ```

2. **Balance Ratio**: Scale by account balance

   ```php
   ratio = subscriber_balance / master_balance
   subscriber_volume = master_volume * ratio
   ```

3. **Fixed Risk**: Size based on risk percentage

   ```php
   max_risk = account_balance * risk_percent / 100
   subscriber_volume = max_risk / sl_distance_in_pips
   ```

4. **Multiplier**: Apply custom multiplier
   ```php
   subscriber_volume = master_volume * multiplier
   ```

**Exposure Limits:**

- Max position size (e.g., 10 lots max per trade)
- Max open positions (e.g., 5 concurrent trades)
- Daily loss limit (e.g., 5% of account balance)
- Allowed symbols (whitelist)
- Forbidden symbols (blacklist)

### **4. Trade Closing**

**How it works:**

```
Master closes trade
    ↓
Detect trade closure
    ↓
Find all linked copies
    ↓
Close each copy (same logic)
    ↓
Calculate profit/loss
    ↓
Update CopyTradeLog with close details
```

---

## 📋 Database Schema Details

### **TradeSignal Table**

Represents every trade opened by master accounts

```sql
CREATE TABLE trade_signals (
    id BIGINT PRIMARY KEY,
    master_account_id INT,
    external_trade_id VARCHAR(255),  -- ID from MT4
    trade_type VARCHAR(10),           -- BUY, SELL
    symbol VARCHAR(20),               -- EURUSD, GBPUSD
    volume DECIMAL(10,2),
    open_price DECIMAL(15,8),
    close_price DECIMAL(15,8),        -- NULL until closed
    stop_loss DECIMAL(15,8),
    take_profit DECIMAL(15,8),
    profit_loss DECIMAL(15,2),        -- NULL until closed
    signal_timestamp DATETIME,         -- When master opened
    closed_timestamp DATETIME,         -- When master closed
    status VARCHAR(50),                -- NEW, REPLICATED, CLOSED
    created_at TIMESTAMP,
    updated_at TIMESTAMP
);
```

**Example Data:**

```
ID | Master | External | Type | Symbol | Volume | Price   | SL      | TP      | Status
─────────────────────────────────────────────────────────────────────────────────────
1  | 100    | MT4-5001 | BUY  | EURUSD | 1.0    | 1.10500 | 1.10000 | 1.11000 | NEW
2  | 100    | MT4-5002 | SELL | GBPUSD | 0.5    | 1.25000 | 1.25500 | 1.24500 | NEW
```

### **CopyTradeLog Table**

Represents every trade copied to subscribers

```sql
CREATE TABLE copy_trade_logs (
    id BIGINT PRIMARY KEY,
    trade_signal_id BIGINT,           -- Links to TradeSignal
    subscriber_account_id BIGINT,     -- Links to mt4_details
    executed_volume DECIMAL(10,2),    -- Actual volume (after sizing)
    executed_price DECIMAL(15,8),     -- Actual price
    executed_trade_id VARCHAR(255),   -- ID on subscriber's MT4
    closed_price DECIMAL(15,8),
    profit_loss DECIMAL(15,2),
    status VARCHAR(50),               -- SUCCESS, FAILED, CLOSED
    error_message TEXT,               -- Why it failed
    copied_at DATETIME,
    closed_at DATETIME,
    created_at TIMESTAMP
);
```

**Example Data:**

```
ID | Signal | Subscriber | Volume | Price   | Status  | P/L
──────────────────────────────────────────────────────────
1  | 1      | 10         | 0.5    | 1.10505 | SUCCESS | 125.00
2  | 1      | 11         | 0.8    | 1.10510 | SUCCESS | 180.00
3  | 1      | 12         | 1.0    | 1.10500 | FAILED  | NULL (max position breach)
```

### **CopyTradeRelationship Table**

Links subscribers to masters with risk settings

```sql
CREATE TABLE copy_trade_relationships (
    id BIGINT PRIMARY KEY,
    subscriber_account_id BIGINT,
    master_account_id INT,
    status VARCHAR(50),               -- ACTIVE, DISABLED, PAUSED
    risk_settings JSON,
    enabled_at DATETIME,
    disabled_at DATETIME,
    total_trades_copied INT,          -- Cumulative count
    successful_copies INT,            -- How many succeeded
    failed_copies INT,                -- How many failed
    total_profit_loss DECIMAL(15,2),  -- P/L from all copied trades
    last_trade_copied_at DATETIME,
    created_at TIMESTAMP
);
```

**Risk Settings JSON:**

```json
{
  "sizing_strategy": "balance_ratio",
  "volume_multiplier": 1.0,
  "master_balance": 10000,
  "max_position_size": 10.0,
  "max_open_positions": 10,
  "daily_loss_limit": 500,
  "allowed_symbols": ["EURUSD", "GBPUSD", "USDJPY"],
  "forbidden_symbols": ["GOLD", "OIL"]
}
```

---

## 🔧 Implementation Steps

### **Step 1: Create Database Tables**

```bash
# Generate migration
php artisan make:migration create_trade_signals_table
php artisan make:migration create_copy_trade_logs_table
php artisan make:migration create_copy_trade_relationships_table
```

### **Step 2: Create Models**

```bash
php artisan make:model TradeSignal
php artisan make:model CopyTradeLog
php artisan make:model CopyTradeRelationship
```

### **Step 3: Create Events & Listeners**

```bash
# Event
php artisan make:event TradeSignalDetected

# Listener
php artisan make:listener ReplicateTradeSignalListener --event=TradeSignalDetected
```

Register in `EventServiceProvider`:

```php
protected $listen = [
    TradeSignalDetected::class => [
        ReplicateTradeSignalListener::class,
    ],
];
```

### **Step 4: Create Jobs**

```bash
php artisan make:job ReplicateTradeSignalJob
php artisan make:job ExecuteCopyTradeJob
```

### **Step 5: Create Service**

```bash
# Create app/Services/CopyTradingEngine.php
# Manually create (or generate scaffold)
```

### **Step 6: Create Commands**

```bash
php artisan make:command MonitorCopyTrading
php artisan make:command SyncTradingData
```

### **Step 7: Setup Scheduling**

In `app/Console/Kernel.php`:

```php
protected function schedule(Schedule $schedule)
{
    // Monitor every 30 seconds (real-time)
    $schedule->command('copy-trading:monitor')
        ->everyThirtySeconds();

    // Sync once hourly
    $schedule->command('trading:sync')
        ->hourly();
}
```

### **Step 8: Setup Queue Worker**

```bash
# Terminal 1: Start queue worker
php artisan queue:work redis --queue=trading --delay=0

# Terminal 2 (optional): Monitor queue
php artisan queue:monitor
```

---

## 🧪 Testing Strategy

### **Unit Tests**

```php
// Test position sizing calculations
public function test_balance_ratio_position_sizing()
{
    $engine = new CopyTradingEngine();

    $size = $engine->calculatePositionSize(
        masterVolume: 1.0,
        riskSettings: [
            'sizing_strategy' => 'balance_ratio',
            'master_balance' => 10000,
        ],
        subscriberBalance: 5000
    );

    $this->assertEquals(0.5, $size);
}

// Test risk limit validation
public function test_max_position_size_limit()
{
    $subscriber = Mt4Details::factory()->create([
        'max_position_size' => 5.0
    ]);

    $engine = new CopyTradingEngine();

    $isValid = $engine->isWithinRiskLimits(
        subscriber: $subscriber,
        volume: 10.0,  // Exceeds limit
        signal: $tradeSignal
    );

    $this->assertFalse($isValid);
}
```

### **Integration Tests**

```php
// Test full trade copying workflow
public function test_full_copy_trading_workflow()
{
    // Setup: Create master, subscriber, and link
    $master = Mt4Details::factory()->create(['mt4_id' => 'MASTER123']);
    $subscriber = Mt4Details::factory()->create(['mt4_id' => 'SUB123']);
    $link = CopyTradeRelationship::create([
        'subscriber_account_id' => $subscriber->id,
        'master_account_id' => $master->id,
        'status' => 'ACTIVE',
        'risk_settings' => json_encode([...])
    ]);

    // Mock: Master opens BUY trade
    $signal = TradeSignal::create([
        'master_account_id' => $master->id,
        'trade_type' => 'BUY',
        'symbol' => 'EURUSD',
        'volume' => 1.0,
        'open_price' => 1.10500,
        ...
    ]);

    // Execute: Engine processes signal
    $engine = new CopyTradingEngine();
    $engine->replicateTradeSignal($signal);

    // Assert: CopyTradeLog created
    $this->assertDatabaseHas('copy_trade_logs', [
        'trade_signal_id' => $signal->id,
        'subscriber_account_id' => $subscriber->id,
        'status' => 'SUCCESS',
    ]);
}
```

---

## 🚀 Performance Considerations

### **Scaling Concerns**

**Problem**: If we have 1000 masters with 10,000 subscribers copying, checking every 30 seconds could be expensive.

**Solution:**

```
Architecture: Distributed monitoring

1. Use queue to distribute work:
   - 10 workers, each monitors 100 masters
   - Each worker checks every 30 seconds
   - Total: 10 parallel processes

2. Use caching for metadata:
   - Cache master account list
   - Cache subscriber relationship list
   - Invalidate cache on changes

3. Use database indexes:
   - INDEX(master_account_id, status)
   - INDEX(subscriber_account_id, status)
   - INDEX(created_at) for old trade cleanup
```

### **Database Optimization**

```sql
-- Add indexes for fast queries
CREATE INDEX idx_trade_signals_master ON trade_signals(master_account_id);
CREATE INDEX idx_copy_logs_subscriber ON copy_trade_logs(subscriber_account_id);
CREATE INDEX idx_relationships_status ON copy_trade_relationships(status);

-- Archive old trades (older than 6 months)
DELETE FROM copy_trade_logs WHERE closed_at < NOW() - INTERVAL 6 MONTH;
```

---

## 📊 Monitoring & Alerting

### **What to Monitor**

```
1. Copy Trade Success Rate
   - Total trades copied: 1000
   - Successful: 985 (98.5%)
   - Failed: 15 (1.5%)

2. Average Copy Latency
   - Signal detected at 12:00:00.500
   - Trade executed at 12:00:05.200
   - Average latency: ~5 seconds

3. Risk Limit Breaches
   - How often traders hit daily loss limits
   - How often max position size prevented trades

4. Queue Depth
   - Jobs waiting to be processed
   - If queue is growing, add more workers
```

### **Alert Conditions**

```php
// Alert if copy success rate drops below 95%
if ($successRate < 0.95) {
    notify('admin@tradez.pro', 'Copy trade success rate: ' . $successRate);
}

// Alert if queue depth > 1000
if ($queueDepth > 1000) {
    notify('admin@tradez.pro', 'Queue backed up, add more workers');
}

// Alert if no trades copied in 30 minutes (possible system failure)
if ($lastTradeTime < now()->subMinutes(30)) {
    notify('admin@tradez.pro', 'No trades copied in 30 minutes');
}
```

---

## 🔐 Security & Compliance

### **Data Security**

1. **Encrypt MT4 Passwords**

   ```php
   $mt4->mt4_password = Crypt::encryptString($request->password);
   ```

2. **API Key Rotation**
   - Store in `.env`, never in code
   - Rotate quarterly

3. **Audit Logging**
   - Every trade logged to database
   - Include timestamp, user, IP address

4. **Rate Limiting**
   - Max 100 copy trades per second
   - Backoff if broker returns "too many requests"

### **Compliance**

1. **Trade History**
   - 3-year retention minimum
   - Full audit trail

2. **Risk Disclosure**
   - Show subscribers copy trading risks
   - Get explicit consent

3. **Slippage Tracking**
   - Compare master price vs actual execution price
   - Disclose to subscribers

---

## 🧠 Future Enhancements

### **Phase 2 Features**

1. **Machine Learning Position Sizing**
   - Learn optimal sizing per master
   - Learn best risk settings per subscriber

2. **Trade Filtering**
   - Skip trades during high volatility
   - Skip trades during news events
   - Skip trades with high slippage

3. **Portfolio Optimization**
   - Combine multiple masters intelligently
   - Diversification across masters

4. **Performance Analytics**
   - Compare each master's returns
   - Suggest switching masters
   - Identify underperforming subscribers

5. **Live Leaderboard**
   - Show top performers
   - Gamification (badges, streaks)

---

## 📞 Troubleshooting

### **Common Issues**

**Issue**: Trades not being copied

```
Checklist:
1. Is MonitorCopyTrading command running?
2. Is queue worker running?
3. Check logs: storage/logs/laravel.log
4. Are subscribers linked to master? (CopyTradeRelationship)
5. Is copy trade status = 'ACTIVE'?
```

**Issue**: Trades copied with wrong volume

```
Check: Risk settings in CopyTradeRelationship
- sizing_strategy?
- master_balance?
- Check calculatePositionSize() logic
```

**Issue**: Risk limits not preventing trades

```
Check: isWithinRiskLimits() implementation
- Are limits being enforced?
- Are risk_settings JSON valid?
```

**Issue**: Queue jobs stuck/not processing

```
Restart queue worker:
php artisan queue:restart

Or check for failed jobs:
php artisan queue:failed
php artisan queue:retry {id}
```

---

## 📚 Reference Files

- `app/Services/CopyTradingEngine.php` - Main engine
- `app/Models/TradeSignal.php` - Trade signal model
- `app/Models/CopyTradeLog.php` - Copy trade log model
- `app/Events/TradeSignalDetected.php` - Event
- `app/Listeners/ReplicateTradeSignalListener.php` - Event listener
- `app/Jobs/ReplicateTradeSignalJob.php` - Queue job
- `app/Jobs/ExecuteCopyTradeJob.php` - Execution job
- `app/Console/Commands/MonitorCopyTrading.php` - Monitoring command
