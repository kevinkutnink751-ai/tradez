# Trading Account System - Visual Reference Guide

## 🔄 CURRENT SYSTEM FLOWS

### **Current User Submission Flow**

```
User fills form:
├─ MT4 Login
├─ MT4 Password (unencrypted!)
├─ Account Type
├─ Currency
├─ Leverage
├─ Server
├─ Duration
└─ Amount

         ↓

POST /savemt4details
         │
         ├─ ✅ Balance check passes?
         │   └─ Deduct amount immediately ⚠️
         │
         ├─ Create Mt4Details
         │   status = 'Pending'
         │
         ├─ Create Tp_Transaction (history record)
         │
         └─ Send email to admin

         ↓

AWAITING ADMIN ACTION
(Balance already gone from user account!)
         │
         ├─ Admin clicks "Confirm"
         │  └─ Status → 'Active'
         │  └─ Dates calculated
         │  └─ User notified ✅
         │
         └─ Admin clicks reject? ❌ NO REFUND LOGIC!
```

### **Current Admin Copy Trade Flow**

```
Admin views [tacnts] tab (Active Accounts)
         │
         ├─ Sees list of subscriber accounts
         │
         └─ Clicks "Start CopyTrade"
            └─ Opens modal
               ├─ Selects master account (dropdown)
               │
               └─ POST /start-copy-account
                  │
                  └─ TradingAccountController@copyTrade()
                     │
                     └─ Call fetctApi('/copytrade', [...])
                        │
                        ├─ ✅ API succeeds → Redirect with success
                        │   (But NO database record of relationship!)
                        │
                        └─ ❌ API fails → Redirect with error


⚠️ SEPARATE STEP: Admin then clicks "Deploy"
         │
         └─ POST /deployment/{id}/Deploy
            │
            └─ fetctApi('/deployment', [...])
               │
               └─ ✅ API turns on trading

⚠️ NO VISIBILITY INTO WHICH MASTER WAS LINKED
⚠️ NO HISTORY OF COPY TRADE CHANGES
⚠️ CANNOT DISABLE/CHANGE MASTER LATER EASILY
```

---

## 📊 DATA INCONSISTENCY PROBLEM

```
┌──────────────────────────────────────────────────────────┐
│              External Trading Engine                     │
│         https://app.gettradez.pro/api/v1                │
│                                                          │
│  SOURCE OF TRUTH for:                                   │
│  - Master accounts                                      │
│  - Copy trade relationships                             │
│  - Account deployment status                            │
│  - Trading execution                                    │
│                                                          │
│  Data Flow: Only fetch via HTTP API 🔄                 │
└──────────────────────────────────────────────────────────┘
         ↑                              ↑
    GET/POST                       GET/POST
    (one-off calls)                (one-off calls)
         │                              │
         └──────────────────┬───────────┘
                            │
        ┌───────────────────┴────────────────────┐
        │                                        │
        ▼                                        ▼
┌─────────────────────┐              ┌──────────────────────┐
│  Laravel Database   │              │  Cached File         │
│  (mt4_details)      │              │  (trading_settings)  │
│                     │              │                      │
│  - User subs        │              │  - Master accounts   │
│  - Statuses         │              │  - Strategies        │
│  - Dates            │              │  - Settings          │
│  - Passwords (!)    │              │                      │
│                     │              │  Updated: manually   │
│  Updated: only      │              │  via var_export()    │
│  when admin acts    │              │  ❌ Stale!          │
└─────────────────────┘              └──────────────────────┘

RESULT: Three data sources, none authoritative in real-time
─────────────────────────────────────────────────────────────
└─ If API returns data → Database doesn't have it
└─ If admin creates locally → API doesn't know about it
└─ If cache updates → API might have changed it
```

---

## 🔐 CURRENT DATABASE SCHEMA

### **mt4_details Table** (With Issues Highlighted)

```
┌────────────────────────────────────────────────────────┐
│ Column            │ Type      │ Notes                  │
├────────────────────────────────────────────────────────┤
│ id                │ BIGINT PK │ ✅ OK                 │
│ client_id         │ INT       │ ✅ Foreign key to user│
│ mt4_id            │ VARCHAR   │ ✅ Login ID           │
│ mt4_password      │ VARCHAR   │ ❌ PLAIN TEXT!        │
│ type              │ VARCHAR   │ ❌ UNUSED             │
│ account_type      │ VARCHAR   │ ✅ Standard/Micro     │
│ currency          │ VARCHAR   │ ✅ USD/EUR            │
│ leverage          │ VARCHAR   │ ✅ 1:100, 1:500       │
│ server            │ VARCHAR   │ ✅ Broker server      │
│ options           │ VARCHAR   │ ❌ UNUSED             │
│ duration          │ VARCHAR   │ ✅ Monthly/Quarterly  │
│ status            │ VARCHAR   │ ✅ Pending/Active/Exp │
│ start_date        │ DATETIME  │ ✅ Subscription start │
│ end_date          │ DATETIME  │ ✅ Subscription exp   │
│ created_at        │ TIMESTAMP │ ✅ Laravel             │
│ updated_at        │ TIMESTAMP │ ✅ Laravel             │
│                   │           │                        │
│ MISSING:          │           │                        │
│ account_name      │ VARCHAR   │ ❌ Used in code!      │
│ reminded_at       │ DATETIME  │ ❌ Used in code!      │
│ master_id         │ INT       │ ❌ No copy trade link │
│ copy_trade_on     │ BOOLEAN   │ ❌ No status          │
│ deployment_st     │ VARCHAR   │ ❌ No deployment track│
│ api_account_id    │ VARCHAR   │ ❌ No external ref    │
│ verified_at       │ DATETIME  │ ❌ No verification    │
│ rejection_reason  │ TEXT      │ ❌ No rejection log   │
└────────────────────────────────────────────────────────┘
```

---

## 🆕 PROPOSED NEW TABLES

### **mt4_transaction_logs** (Complete Audit Trail)

```
id | mt4_id | user_id | admin_id | action | before | after | details | api_resp | timestamp
────────────────────────────────────────────────────────────────────────────────────────
1  | 1      | 5       | NULL     | CREATED| NULL   | PEND  | {...}   | NULL     | 2025-01-01
2  | 1      | 5       | 3        | APPRO  | PEND   | ACTV  | {...}   | {...}    | 2025-01-02
3  | 1      | 5       | 3        | CP_ON  | ACTV   | ACTV  | m:2     | {...}    | 2025-01-03
4  | 1      | 5       | 3        | DEPL   | ACTV   | DEPL  | {...}   | {...}    | 2025-01-03

Every action logged with:
- WHO: user_id or admin_id
- WHEN: precise timestamp
- WHAT: before/after state
- WHY: action details
- HOW: api_response if external call
```

### **copy_trade_relationships** (Master Account Link)

```
id | subscriber_id | master_id | status    | enabled_at | disabled_at | error
──────────────────────────────────────────────────────────────────────────────
1  | 1             | 5         | ACTIVE    | 2025-01-03 | NULL        | NULL
2  | 2             | 7         | DISABLED  | 2025-01-02 | 2025-01-04  | NULL
3  | 3             | 5         | FAILED    | 2025-01-05 | NULL        | "API error"

Tracks:
- Which subscriber copies from which master
- When it was enabled/disabled
- If it failed and why
```

### **deployment_records** (Deployment History)

```
id | mt4_id | type    | status  | admin_id | error              | timestamp
──────────────────────────────────────────────────────────────────────────────
1  | 1      | DEPLOY  | SUCCESS | 3        | NULL               | 2025-01-03
2  | 1      | DEPLOY  | FAILED  | 3        | "API connection"   | 2025-01-03
3  | 1      | DEPLOY  | SUCCESS | 3        | NULL               | 2025-01-03
4  | 1      | UNDEPLOY| SUCCESS | 3        | NULL               | 2025-01-04

Tracks:
- Each deployment attempt (including failures)
- Who requested it
- When
- If it failed and why
```

---

## 🔄 PROPOSED NEW FLOWS

### **New User Submission Flow**

```
User fills form with MT4 credentials

         ↓

UserSubscriptionController@savemt4details()
         │
         ├─ 🔐 STEP 1: Validate credentials with External API
         │   └─ Call: TradingApiService::validateMt4Credentials()
         │      ├─ ✅ Valid → Continue
         │      └─ ❌ Invalid → Show error, stop here
         │
         ├─ 🔓 STEP 2: Encrypt password before saving
         │   └─ $mt4->mt4_password = Crypt::encryptString(...)
         │
         ├─ 📝 STEP 3: Create Mt4Details with NEW status
         │   └─ status = 'CREDENTIALS_VERIFIED' (NOT 'Pending'!)
         │   └─ verified_at = now()
         │   └─ NO CHARGE YET! ✅
         │
         ├─ 📋 STEP 4: Create Mt4TransactionLog
         │   └─ action = 'CREDENTIALS_VERIFIED'
         │
         └─ 📧 STEP 5: Notify admin
            └─ "Please approve or reject this subscription"

         ↓

AWAITING ADMIN DECISION
(User balance is SAFE!)
         │
         ├─ Admin clicks "Approve"
         │  └─ TradingAccountController@approveSubscription()
         │     ├─ 💰 NOW charge user (STEP NEW!)
         │     ├─ Update status = 'ACTIVE'
         │     ├─ Calculate dates
         │     ├─ Log transaction
         │     └─ Notify user ✅
         │
         └─ Admin clicks "Reject"
            └─ TradingAccountController@rejectSubscription()
               ├─ Update status = 'REJECTED'
               ├─ NO REFUND (user wasn't charged) ✅
               ├─ Log reason
               └─ Notify user
```

### **New Admin Copy Trade Flow**

```
Admin views [tacnts] tab

         ├─ Column 1: Account details
         ├─ Column 2: Copy Trade Status
         ├─ Column 3: Master Linked To
         ├─ Column 4: Deployment Status
         └─ Column 5: Actions


Action 1: ENABLE COPY TRADE
         │
         └─ Admin selects Master & clicks "Enable"
            │
            └─ POST to enableCopyTrade()
               │
               ├─ 🔗 STEP 1: Call TradingApiService::enableCopyTrade()
               │   └─ API links subscriber to master
               │
               ├─ 📝 STEP 2: Create CopyTradeRelationship record
               │   └─ subscriber_id = X
               │   └─ master_id = Y
               │   └─ status = 'ACTIVE'
               │
               ├─ 🔄 STEP 3: Update Mt4Details
               │   └─ copy_trade_enabled = true
               │   └─ master_account_id = Y
               │
               ├─ 📋 STEP 4: Log action
               │   └─ Mt4TransactionLog: COPY_TRADE_ENABLED
               │
               └─ ✅ Success → Show "Copy Trade is now ACTIVE"


Action 2: DEPLOY ACCOUNT (after copy trade enabled)
         │
         └─ Admin clicks "Deploy" on active copy trade account
            │
            └─ POST to deployAccount()
               │
               ├─ ✅ STEP 1: Verify copy trade is enabled
               │   └─ If not → Error: "Enable copy trade first!"
               │
               ├─ 🚀 STEP 2: Call TradingApiService::deployAccount()
               │   └─ Turns on live trading
               │
               ├─ 📝 STEP 3: Create DeploymentRecord
               │   └─ deployment_type = 'DEPLOY'
               │   └─ status = 'SUCCESS' or 'FAILED'
               │
               ├─ 🔄 STEP 4: Update Mt4Details
               │   └─ deployment_status = 'DEPLOYED'
               │
               ├─ 📋 STEP 5: Log action
               │   └─ Mt4TransactionLog: DEPLOYED
               │
               └─ 📧 STEP 6: Notify user
                  └─ "Your trading account is now ACTIVE!"


Action 3: DISABLE / UNDEPLOY
         │
         └─ Similar to above but calls disable() methods
            └─ DeploymentRecord: type = 'UNDEPLOY'
            └─ CopyTradeRelationship: status = 'DISABLED'
            └─ Mt4Details: deployment_status = 'UNDEPLOYED'
```

---

## 🔄 HOURLY SYNC PROCESS

```
Schedule: Every hour (1:00 AM, 2:00 AM, ..., 11:00 PM)

SyncTradingDataCommand runs:
         │
         ├─ 🔄 STEP 1: Sync master accounts from API
         │   └─ Call: TradingApiService::getMasterAccounts()
         │   └─ Update: TradingService (file cache) + Database
         │
         ├─ ⏰ STEP 2: Find expiring subscriptions (10 days before)
         │   └─ WHERE end_date <= NOW() + 10 days
         │   └─ WHERE reminded_at IS NULL
         │   └─ ACTION: Send reminder email
         │   └─ SET: reminded_at = now()
         │
         ├─ 🏁 STEP 3: Expire old subscriptions
         │   └─ WHERE end_date < NOW()
         │   └─ WHERE status != 'EXPIRED'
         │   └─ ACTION: Set status = 'EXPIRED'
         │   └─ ACTION: Auto-undeploy
         │   └─ ACTION: Disable copy trade
         │   └─ ACTION: Notify user "Your subscription expired"
         │
         └─ 📝 STEP 4: Log all actions
            └─ Mt4TransactionLog for each change
```

---

## 🎯 STATE TRANSITIONS ALLOWED

```
CREDENTIALS_VERIFIED
    ├─ → ACTIVE (admin approve)
    └─ → REJECTED (admin reject)

ACTIVE (subscription active)
    ├─ → ACTIVE (enable copy trade) *status doesn't change*
    ├─ → ACTIVE (deploy) *status doesn't change*
    ├─ → RENEWED (user renews early)
    └─ → EXPIRED (10 days after end_date)

RENEWED
    └─ → EXPIRED (when renewed end_date passes)

EXPIRED
    └─ → ACTIVE (user renews subscription) *rare*

REJECTED
    └─ (final state)

DEPLOYMENT_STATUS values:
- NONE: No copy trade setup
- DEPLOYING: Deployment in progress
- DEPLOYED: Trading is live
- UNDEPLOYED: Deployment was removed
```

---

## 📊 COMPARISON TABLE

```
┌─────────────────────────────────┬──────────────┬──────────────┐
│ Aspect                          │ Current      │ Proposed     │
├─────────────────────────────────┼──────────────┼──────────────┤
│ Amount charged                  │ ❌ Immediate │ ✅ After OK  │
│ Credential validation           │ ❌ None      │ ✅ API check │
│ Copy trade tracking             │ ❌ API only  │ ✅ Database  │
│ Password encryption             │ ❌ Plain     │ ✅ Encrypted │
│ Audit trail                     │ ❌ Minimal   │ ✅ Complete  │
│ Deployment tracking             │ ❌ No record │ ✅ Recorded  │
│ Data sync with API              │ ❌ Manual    │ ✅ Hourly    │
│ Error handling                  │ ❌ Basic     │ ✅ Robust    │
│ User notifications              │ ❌ Basic     │ ✅ Proactive │
│ Admin visibility                │ ❌ Limited   │ ✅ Complete  │
└─────────────────────────────────┴──────────────┴──────────────┘
```

---

## 🚨 ERROR SCENARIOS HANDLED

### **Current System**

- User insufficient balance → Stop
- Admin rejects → No refund logic (user loses money!)
- API fails silently → No retry
- Copy trade API fails → No error logged
- Deployment fails → No record of attempt

### **Proposed System**

- User insufficient balance → Stop
- Admin rejects → No charge (all good!)
- API fails → Logged with retry logic
- Copy trade API fails → Create CopyTradeRelationship with error_message
- Deployment fails → Create DeploymentRecord with status='FAILED' + error

---

## 📋 CHECKLIST FOR REVIEW

- [ ] Do you agree amount should be charged after approval?
- [ ] Should we validate credentials with external API first?
- [ ] Should password be encrypted?
- [ ] Should we create audit tables?
- [ ] Should hourly sync check for expiries?
- [ ] Should deployment be separate from copy trade?
- [ ] Should we add error notification to admins?
- [ ] Should users see their subscription history?
- [ ] Should users be notified when expiry is 10 days away?
- [ ] Should expired subscriptions auto-undeploy?
