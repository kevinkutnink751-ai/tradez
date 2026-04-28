<!-- Sidenav -->
<div class="sidenav" id="sidenav-main">
    <!-- Sidenav header -->
    <div class="sidenav-header d-flex align-items-center">
        <a class="navbar-brand" href="<?php echo e(route('dashboard')); ?>">
            <img src="<?php echo e(asset('storage/app/public/' . $settings->logo)); ?>" class="navbar-brand-img" alt="logo">
        </a>
        <div class="ml-auto">
            <!-- Sidenav toggler -->
            <div class="sidenav-toggler sidenav-toggler-dark d-md-none" data-action="sidenav-unpin"
                data-target="#sidenav-main">
                <div class="sidenav-toggler-inner">
                    <i class="bg-white sidenav-toggler-line"></i>
                    <i class="bg-white sidenav-toggler-line"></i>
                    <i class="bg-white sidenav-toggler-line"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- User mini profile -->
    <div class="text-center sidenav-user d-flex flex-column align-items-center justify-content-between">
        <!-- Avatar -->
        <div>
            <a href="#" class="avatar rounded-circle avatar-xl">
                <i class="fas fa-user-circle fa-4x"></i>
            </a>
            <div class="mt-4">
                <h5 class="mb-0 text-white"> <?php echo e(Auth::user()->name); ?></h5>
                <span class="mb-3 text-sm text-white d-block opacity-8">online</span>
                <a href="#" class="shadow btn btn-sm btn-white btn-icon rounded-pill hover-translate-y-n3">
                    <span class="btn-inner--icon"><i class="far fa-coins"></i></span>
                    <span
                        class="btn-inner--text"><?php echo e($settings->currency); ?><?php echo e(number_format(Auth::user()->account_bal, 2, '.', ',')); ?></span>
                </a>
            </div>
        </div>
        <!-- User info -->
        <!-- Actions -->
        <div class="mt-4 w-100 actions d-flex justify-content-between">
            
            
        </div>
    </div>
    <!-- Application nav -->
    <div class="clearfix nav-application">
        <a href="<?php echo e(route('dashboard')); ?>"
            class="text-sm btn btn-square <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
            <span class="btn-inner--icon d-block"><i class="far fa-home fa-2x"></i></span>
            <span class="pt-2 btn-inner--icon d-block">Home</span>
        </a>
        <a href="<?php echo e(route('deposits')); ?>"
            class="text-sm btn btn-square <?php echo e(request()->routeIs('deposits') ? 'active' : ''); ?> <?php echo e(request()->routeIs('payment') ? 'active' : ''); ?> <?php echo e(request()->routeIs('pay.crypto') ? 'active' : ''); ?>">
            <span class="btn-inner--icon d-block"><i class="far fa-download fa-2x"></i></span>
            <span class="pt-2 btn-inner--icon d-block">Deposit</span>
        </a>
        <?php if($mod['investment'] || $mod['cryptoswap']): ?>
            <a href="<?php echo e(route('withdrawalsdeposits')); ?>"
                class="text-sm btn btn-square <?php echo e(request()->routeIs('withdrawalsdeposits') ? 'active' : ''); ?> <?php echo e(request()->routeIs('withdrawfunds') ? 'active' : ''); ?>">
                <span class="btn-inner--icon d-block"><i class="fas fa-arrow-alt-circle-up fa-2x"></i></span>
                <span class="pt-2 btn-inner--icon d-block">Withdraw</span>
            </a>
        <?php endif; ?>
        <?php if($mod['investment']): ?>
            <a href="<?php echo e(route('tradinghistory')); ?>"
                class="text-sm btn btn-square <?php echo e(request()->routeIs('tradinghistory') ? 'active' : ''); ?>">
                <span class="btn-inner--icon d-block"><i class="fal fa-history fa-2x"></i></span>
                <span class="pt-2 btn-inner--icon d-block">Profit History</span>
            </a>
        <?php endif; ?>
        <a href="<?php echo e(route('accounthistory')); ?>"
            class="text-sm btn btn-square <?php echo e(request()->routeIs('accounthistory') ? 'active' : ''); ?>">
            <span class="btn-inner--icon d-block"><i class="fas fa-money-check-alt fa-2x"></i></span>
            <span class="pt-2 btn-inner--icon d-block">Transactions</span>
        </a>
        <?php if($mod['cryptoswap']): ?>
            <a href="<?php echo e(route('assetbalance')); ?>"
                class="text-sm btn btn-square <?php echo e(request()->routeIs('assetbalance') ? 'active' : ''); ?> <?php echo e(request()->routeIs('swaphistory') ? 'active' : ''); ?>">
                <span class="btn-inner--icon d-block"><i class="fab fa-stack-exchange fa-2x"></i></span>
                <span class="pt-2 btn-inner--icon d-block">Swap Crypto</span>
            </a>
        <?php endif; ?>
        <?php if($moresettings->use_transfer): ?>
            <a href="<?php echo e(route('transferview')); ?>"
                class="text-sm btn btn-square <?php echo e(request()->routeIs('transferview') ? 'active' : ''); ?>">
                <span class="btn-inner--icon d-block"><i class="fas fa-exchange fa-2x"></i></span>
                <span class="pt-2 btn-inner--icon d-block">Transfer funds</span>
            </a>
        <?php endif; ?>
        <?php if($mod['subscription']): ?>
            <a href="<?php echo e(route('subtrade')); ?>"
                class="text-sm btn btn-square <?php echo e(request()->routeIs('subtrade') ? 'active' : ''); ?>">
                <span class="btn-inner--icon d-block"><i class="far fa-receipt fa-2x"></i></span>
                <span class="pt-2 btn-inner--icon d-block">Managed Accounts</span>
            </a>
        <?php endif; ?>
        <a href="<?php echo e(route('profile')); ?>"
            class="text-sm btn btn-square <?php echo e(request()->routeIs('profile') ? 'active' : ''); ?>">
            <span class="btn-inner--icon d-block"><i class="fas fa-address-card fa-2x"></i></span>
            <span class="pt-2 btn-inner--icon d-block">Profile</span>
        </a>
        <?php if($mod['investment']): ?>
            <a href="<?php echo e(route('mplans')); ?>"
                class="text-sm btn btn-square <?php echo e(request()->routeIs('mplans') ? 'active' : ''); ?>">
                <span class="btn-inner--icon d-block"><i class="fas fa-hand-holding-seedling fa-2x"></i></span>
                <span class="pt-2 btn-inner--icon d-block">Trading Plans</span>
            </a>

            <a href="<?php echo e(route('myplans', 'All')); ?>"
                class="text-sm btn btn-square <?php echo e(request()->routeIs('myplans') ? 'active' : ''); ?> <?php echo e(request()->routeIs('plandetails') ? 'active' : ''); ?>">
                <span class="btn-inner--icon d-block"><i class="far fa-hand-holding-seedling fa-2x"></i></span>
                <span class="pt-2 btn-inner--icon d-block">My Plans</span>
            </a>
        <?php endif; ?>
        <?php if($mod['membership']): ?>
            <a href="<?php echo e(route('user.courses')); ?>"
                class="text-sm btn btn-square <?php echo e(request()->routeIs('user.mycourses') ? 'active' : ''); ?> <?php echo e(request()->routeIs('user.courses') ? 'active' : ''); ?> <?php echo e(request()->routeIs('user.course.details') ? 'active' : ''); ?>">
                <span class="btn-inner--icon d-block"><i class="fas fa-graduation-cap fa-2x"></i></span>
                <span class="pt-2 btn-inner--icon d-block">Education</span>
            </a>
        <?php endif; ?>
        <?php if($mod['signal']): ?>
            <a href="<?php echo e(route('tsignals')); ?>"
                class="text-sm btn btn-square <?php echo e(request()->routeIs('tsignals') ? 'active' : ''); ?>">
                <span class="btn-inner--icon d-block">
                    <i class="fas fa-wave-square fa-2x"></i>
                </span>
                <span class="pt-2 btn-inner--icon d-block">Trade Signals</span>
            </a>
        <?php endif; ?>
        <a href="<?php echo e(route('referuser')); ?>"
            class="text-sm btn btn-square <?php echo e(request()->routeIs('referuser') ? 'active' : ''); ?>">
            <span class="btn-inner--icon d-block"><i class="fas fa-retweet fa-2x"></i></span>
            <span class="pt-2 btn-inner--icon d-block">Referrals</span>
        </a>
    </div>
    <!-- Misc area -->
    <div class="card bg-gradient-warning">
        <div class="card-body">
            <h5 class="text-white">Need Help!</h5>
            <p class="mb-4 text-white">
                Contact our 24/7 customer support center
            </p>
            <a href="<?php echo e(route('support')); ?>" class="btn btn-sm btn-block btn-white rounded-pill">Contact Us</a>
        </div>
    </div>
</div>
<?php /**PATH /Users/macbookair/Documents/Brynamics/OnlineTraderSoftware/onlinetrader/resources/views/user/sidebar.blade.php ENDPATH**/ ?>