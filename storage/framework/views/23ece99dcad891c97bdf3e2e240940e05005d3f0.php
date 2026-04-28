<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>
    <!-- Page title -->
    <div class="page-title">
        <div class="row justify-content-between align-items-center">
            <div class="mb-3 col-md-6 mb-md-0">
                <p class="mb-0 text-white h3 font-weight-400">Swap Crypto</p>
            </div>
        </div>
    </div>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.danger-alert','data' => []]); ?>
<?php $component->withName('danger-alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = $__env->getContainer()->make(Illuminate\View\AnonymousComponent::class, ['view' => 'components.success-alert','data' => []]); ?>
<?php $component->withName('success-alert'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="mt-2 mb-4">

                        <div class="d-inline">
                            <a href="<?php echo e(route('swaphistory')); ?>" class="float-right btn btn-primary btn-sm">Transactions</a>
                        </div>
                        <p class="text-<?php echo e($text); ?>">
                            Earn even more when you swap your Account balance to and from crypto.
                        </p>
                        <div class="row">
                            <div class="col-sm-6 col-lg-3">
                                <div class="p-3 card  shadow">
                                    <div class="d-flex align-items-center">
                                        <span class="mr-3 bg-transparent stamp stamp-md">

                                        </span>
                                        <div>
                                            <p class="mb-1 text-<?php echo e($text); ?>">
                                                <b><?php echo e($settings->currency); ?><?php echo e(number_format(Auth::user()->account_bal, 2, '.', ',')); ?></b>
                                            </p>
                                            <small class="text-muted">Account Balance</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if($moresettings->btc == 'enabled'): ?>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="p-3 card  shadow">
                                        <div class="d-flex align-items-center">
                                            <span class="mr-3 bg-transparent stamp stamp-md">
                                                <img class="w-50"
                                                    src="https://img.icons8.com/color/48/000000/bitcoin--v1.png" />
                                            </span>
                                            <div>
                                                <p class="mb-1 text-<?php echo e($text); ?>"><b><?php echo e(round($cbalance->btc, 8)); ?>

                                                        BTC</b></p>
                                                <small class="text-muted usdelement" id="btc"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if($moresettings->eth == 'enabled'): ?>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="p-3 card  shadow">
                                        <div class="d-flex align-items-center">
                                            <span class="mr-3 bg-transparent stamp stamp-md">
                                                <img class="w-50"
                                                    src="https://img.icons8.com/fluency/48/000000/ethereum.png" />
                                            </span>
                                            <div>
                                                <p class="mb-1 text-<?php echo e($text); ?>">
                                                    <b><?php echo e(round($cbalance->eth, 8)); ?> ETH</b>
                                                </p>
                                                <small class="text-muted usdelement" id="eth"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if($moresettings->ltc == 'enabled'): ?>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="p-3 card  shadow">
                                        <div class="d-flex align-items-center">
                                            <span class="mr-3 bg-transparent stamp stamp-md">
                                                <img class="w-50"
                                                    src="https://img.icons8.com/fluency/48/000000/litecoin.png" />
                                            </span>
                                            <div>
                                                <p class="mb-1 text-<?php echo e($text); ?>">
                                                    <b><?php echo e(round($cbalance->ltc, 8)); ?> LTC</b>
                                                </p>
                                                <small class="text-muted usdelement" id="ltc"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if($moresettings->link == 'enabled'): ?>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="p-3 card  shadow">
                                        <div class="d-flex align-items-center">
                                            <span class="mr-3 bg-transparent stamp stamp-md">
                                                <img class="w-50"
                                                    src="https://img.icons8.com/cotton/64/000000/chainlink.png" />
                                            </span>
                                            <div>
                                                <p class="mb-1 text-<?php echo e($text); ?>">
                                                    <b><?php echo e(round($cbalance->link, 8)); ?> LINK</b>
                                                </p>
                                                <small class="text-muted usdelement" id="link"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if($moresettings->bnb == 'enabled'): ?>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="p-3 card  shadow">
                                        <div class="d-flex align-items-center">
                                            <span class="mr-3 bg-transparent stamp stamp-md">
                                                <img class="w-50"
                                                    src="https://s2.coinmarketcap.com/static/img/coins/64x64/1839.png" />
                                            </span>
                                            <div>
                                                <p class="mb-1 text-<?php echo e($text); ?>">
                                                    <b><?php echo e(round($cbalance->bnb, 8)); ?> BNB</b>
                                                </p>
                                                <small class="text-muted usdelement" id="bnb"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if($moresettings->ada == 'enabled'): ?>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="p-3 card  shadow">
                                        <div class="d-flex align-items-center">
                                            <span class="mr-3 bg-transparent stamp stamp-md">
                                                <img class="w-50"
                                                    src="https://s2.coinmarketcap.com/static/img/coins/64x64/2010.png" />
                                            </span>
                                            <div>
                                                <p class="mb-1 text-<?php echo e($text); ?>">
                                                    <b><?php echo e(round($cbalance->ada, 8)); ?> ADA</b>
                                                </p>
                                                <small class="text-muted usdelement" id="ada"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if($moresettings->aave == 'enabled'): ?>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="p-3 card  shadow">
                                        <div class="d-flex align-items-center">
                                            <span class="mr-3 bg-transparent stamp stamp-md">
                                                <img class="w-25"
                                                    src="https://dynamic-assets.coinbase.com/6ad513d3c9108b163cf0a4c9fd3441cadcb9cf656ea7b9fb333eb7e4a94cd503528e0a94188285d31aedfc392f0793fd4161f7ad4e04d5f6b82e4d70a314d295/asset_icons/80f3d2256652f5ccd680fc48702d130dd01f1bd7c9737fac560a02949efac3b9.png" />
                                            </span>
                                            <div>
                                                <p class="mb-1 text-<?php echo e($text); ?>">
                                                    <b><?php echo e(round($cbalance->aave, 8)); ?> AAVE</b>
                                                </p>
                                                <small class="text-muted usdelement" id="aave"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if($moresettings->usdt == 'enabled'): ?>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="p-3 card  shadow">
                                        <div class="d-flex align-items-center">
                                            <span class="mr-3 bg-transparent stamp stamp-md">
                                                <img class="w-50"
                                                    src="https://img.icons8.com/color/48/000000/tether--v2.png" />
                                            </span>
                                            <div>
                                                <p class="mb-1 text-<?php echo e($text); ?>">
                                                    <b><?php echo e(round($cbalance->usdt, 8)); ?> USDT</b>
                                                </p>
                                                <small
                                                    class="text-muted"><?php echo e($settings->currency); ?><?php echo e(number_format(round($cbalance->usdt))); ?>

                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if($moresettings->bch == 'enabled'): ?>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="p-3 card  shadow">
                                        <div class="d-flex align-items-center">
                                            <span class="mr-3 bg-transparent stamp stamp-md">
                                                <img class="w-75"
                                                    src="https://img.icons8.com/material-sharp/24/000000/bitcoin.png" />
                                            </span>
                                            <div>
                                                <p class="mb-1 text-<?php echo e($text); ?>">
                                                    <b><?php echo e(round($cbalance->bch, 8)); ?> BCH</b>
                                                </p>
                                                <small class="text-muted usdelement" id="bch"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if($moresettings->xrp == 'enabled'): ?>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="p-3 card  shadow">
                                        <div class="d-flex align-items-center">
                                            <span class="mr-3 bg-transparent stamp stamp-md">
                                                <img class="w-50"
                                                    src="https://img.icons8.com/fluency/48/000000/ripple.png" />
                                            </span>
                                            <div>
                                                <p class="mb-1 text-<?php echo e($text); ?>">
                                                    <b><?php echo e(round($cbalance->xrp, 8)); ?> XRP</b>
                                                </p>
                                                <small class="text-muted usdelement" id="xrp"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if($moresettings->xlm == 'enabled'): ?>
                                <div class="col-sm-6 col-lg-3">
                                    <div class="p-3 card  shadow">
                                        <div class="d-flex align-items-center">
                                            <span class="mr-3 bg-transparent stamp stamp-md">
                                                <img class="w-50"
                                                    src="https://img.icons8.com/ios/50/000000/stellar.png" />
                                            </span>
                                            <div>
                                                <p class="mb-1 text-<?php echo e($text); ?>">
                                                    <b><?php echo e(round($cbalance->xlm, 8)); ?> XLM</b>
                                                </p>
                                                <small class="text-muted usdelement" id="xlm"></small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="tradingview-widget-container">
                                    <div id="tradingview_f933e"></div>
                                    <div class="tradingview-widget-copyright">
                                        <a href="#" rel="noopener" target="_blank"><span class="blue-text"></span>
                                            <span class="blue-text">Personal trading chart</span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <form method="POST" action="javascript:void(0)" id="exchnageform">
                                    <?php echo csrf_field(); ?>
                                    <div class="form-group">
                                        <p class="text-<?php echo e($text); ?>">Source Account</p>
                                        <select class="form-control text-<?php echo e($text); ?> " name="source"
                                            id="sourceasset">
                                            <?php if($moresettings->btc == 'enabled'): ?>
                                                <option value="btc">BTC</option>
                                            <?php endif; ?>
                                            <?php if($moresettings->link == 'enabled'): ?>
                                                <option value="link">LINK</option>
                                            <?php endif; ?>
                                            <?php if($moresettings->bnb == 'enabled'): ?>
                                                <option value="bnb">BNB</option>
                                            <?php endif; ?>
                                            <?php if($moresettings->ada == 'enabled'): ?>
                                                <option value="ada">ADA</option>
                                            <?php endif; ?>
                                            <?php if($moresettings->aave == 'enabled'): ?>
                                                <option value="aave">AAVE</option>
                                            <?php endif; ?>
                                            <?php if($moresettings->xlm == 'enabled'): ?>
                                                <option value="xlm">XLM</option>
                                            <?php endif; ?>
                                            <?php if($moresettings->xrp == 'enabled'): ?>
                                                <option value="xrp">XRP</option>
                                            <?php endif; ?>
                                            <?php if($moresettings->ltc == 'enabled'): ?>
                                                <option value="ltc">LTC</option>
                                            <?php endif; ?>
                                            <?php if($moresettings->bch == 'enabled'): ?>
                                                <option value="bch">BCH</option>
                                            <?php endif; ?>
                                            <?php if($moresettings->eth == 'enabled'): ?>
                                                <option value="eth">ETH</option>
                                            <?php endif; ?>
                                            <?php if($moresettings->usdt == 'enabled'): ?>
                                                <option value="usdt">USDT</option>
                                            <?php endif; ?>
                                            <option value="usd">USD</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <p class="text-<?php echo e($text); ?>">Destination Account</p>
                                        <select name="destination" class="form-control text-<?php echo e($text); ?> "
                                            id="destinationasset">
                                            <option value="usd">USD</option>
                                            <?php if($moresettings->btc == 'enabled'): ?>
                                                <option value="btc">BTC</option>
                                            <?php endif; ?>
                                            <?php if($moresettings->link == 'enabled'): ?>
                                                <option value="link">LINK</option>
                                            <?php endif; ?>
                                            <?php if($moresettings->bnb == 'enabled'): ?>
                                                <option value="bnb">BNB</option>
                                            <?php endif; ?>
                                            <?php if($moresettings->ada == 'enabled'): ?>
                                                <option value="ada">ADA</option>
                                            <?php endif; ?>
                                            <?php if($moresettings->aave == 'enabled'): ?>
                                                <option value="aave">AAVE</option>
                                            <?php endif; ?>
                                            <?php if($moresettings->xlm == 'enabled'): ?>
                                                <option value="xlm">XLM</option>
                                            <?php endif; ?>
                                            <?php if($moresettings->xrp == 'enabled'): ?>
                                                <option value="xrp">XRP</option>
                                            <?php endif; ?>
                                            <?php if($moresettings->ltc == 'enabled'): ?>
                                                <option value="ltc">LTC</option>
                                            <?php endif; ?>
                                            <?php if($moresettings->bch == 'enabled'): ?>
                                                <option value="bch">BCH</option>
                                            <?php endif; ?>
                                            <?php if($moresettings->eth == 'enabled'): ?>
                                                <option value="eth">ETH</option>
                                            <?php endif; ?>
                                            <?php if($moresettings->usdt == 'enabled'): ?>
                                                <option value="usdt">USDT</option>
                                            <?php endif; ?>
                                        </select>
                                        <small class="text-<?php echo e($text); ?>">NOTE:USD is your account balance.</small>
                                    </div>

                                    <div class="form-group">
                                        <p class="text-<?php echo e($text); ?>">Amount</p>
                                        <input type="text" name="amount"
                                            class="form-control text-<?php echo e($text); ?> "
                                            placeholder="Enter amount of btc" id="amount">
                                    </div>
                                    <div class="form-group">
                                        <p class="text-<?php echo e($text); ?>">You will get</p>
                                        <input type="text" class="form-control text-<?php echo e($text); ?> "
                                            placeholder="Quantity of usd" id="quantity" readonly </div>
                                        <input type="hidden" id="realquantity" name="quantity">
                                        <div class="form-group">
                                            <span class="mb-1 ml-2 caption">
                                                <span class="text-<?php echo e($text); ?>"><b>Fees =
                                                        <?php echo e($moresettings->fee); ?>%</b></span>
                                            </span>
                                        </div>

                                        <div class="cta inline-group">
                                            <button class="btn btn-success btn-block btn-sm" disbaled>
                                                Swap
                                            </button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
    <script type="text/javascript">
        new TradingView.widget({
            "width": "100%",
            "height": "400",
            "symbol": "COINBASE:BTCUSD",
            "interval": "1",
            "timezone": "Etc/UTC",
            "theme": '<?php echo $bg; ?>',
            "style": "9",
            "locale": "en",
            "toolbar_bg": "#f1f3f6",
            "enable_publishing": false,
            "hide_side_toolbar": false,
            "allow_symbol_change": true,
            "calendar": false,
            "studies": [
                "BB@tv-basicstudies"
            ],
            "container_id": "tradingview_f933e"
        });
    </script>

    <?php echo $__env->make('user.exchangescript', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mazibuckler/apps/sites/tradez/resources/views/user/asset.blade.php ENDPATH**/ ?>