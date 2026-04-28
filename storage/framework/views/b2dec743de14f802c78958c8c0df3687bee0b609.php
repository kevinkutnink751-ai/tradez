<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>

    <!-- Page title -->
    <div class="page-title">
        <div class="row justify-content-between align-items-center">
            <div class="mb-3 col-md-6 mb-md-0">
                <h5 class="mb-0 text-white h3 font-weight-400">Welcome, <?php echo e(Auth::user()->name); ?>!</h5>
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
    <?php if(!empty($settings->welcome_message) and Auth::user()->created_at->diffInDays() <= 3): ?>
        <div class="row">
            <div class="col-12">
                <div class="py-4 alert alert-primary alert-dismissible fade show" role="alert">
                    <?php echo e($settings->welcome_message); ?>

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if($settings->enable_annoc == 'on' and !empty($settings->newupdate)): ?>
        <div class="row">
            <div class="col-12">
                <div class="py-4 alert alert-info alert-dismissible fade show" role="alert">
                    <?php echo e($settings->newupdate); ?>

                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="nk-block-head-content">
                                <h5 class="text-primary h5">Account Summary</h5>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card card-stats">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h6 class="mb-1 text-muted">Account balance</h6>
                                            <span
                                                class="mb-0 h5 font-weight-bold"><?php echo e($settings->currency); ?><?php echo e(number_format(Auth::user()->account_bal, 2, '.', ',')); ?></span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="text-white icon bg-gradient-primary rounded-circle icon-shape">
                                                <i class="fas fa-sack-dollar"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if($mod['investment']): ?>
                            <div class="col-xl-4 col-md-6">
                                <div class="card card-stats">
                                    <!-- Card body -->
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h6 class="mb-1 text-muted">Total Profit</h6>
                                                <span
                                                    class="mb-0 h5 font-weight-bold"><?php echo e($settings->currency); ?><?php echo e(number_format(Auth::user()->roi, 2, '.', ',')); ?></span>
                                            </div>
                                            <div class="col-auto">
                                                <div class="text-white icon bg-gradient-primary rounded-circle icon-shape">
                                                    <i class="fas fa-coins"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="col-xl-4 col-md-6">
                            <div class="card card-stats">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h6 class="mb-1 text-muted">Bonus</h6>
                                            <span
                                                class="mb-0 h5 font-weight-bold"><?php echo e($settings->currency); ?><?php echo e(number_format(Auth::user()->bonus, 2, '.', ',')); ?></span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="text-white icon bg-gradient-primary rounded-circle icon-shape">
                                                <i class="fas fa-gift"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php if($mod['subscription']): ?>
                            <div class="col-xl-4 col-md-6">
                                <div class="card card-stats">
                                    <!-- Card body -->
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h6 class="mb-1 text-muted">Trading Accounts</h6>
                                                <span class="mb-0 h5 font-weight-bold"><?php echo e($trading_accounts); ?></span>
                                            </div>
                                            <div class="col-auto">
                                                <div class="text-white icon bg-gradient-primary rounded-circle icon-shape">
                                                    <i class="fas fa-th-list"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="col-xl-4 col-md-6">
                            <div class="card card-stats">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h6 class="mb-1 text-muted">Referral Bonus</h6>
                                            <span
                                                class="mb-0 h5 font-weight-bold"><?php echo e($settings->currency); ?><?php echo e(number_format(Auth::user()->ref_bonus, 2, '.', ',')); ?></span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="text-white icon bg-gradient-primary rounded-circle icon-shape">
                                                <i class="fas fa-gifts"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-6">
                            <div class="card card-stats">
                                <!-- Card body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h6 class="mb-1 text-muted">Total Deposit</h6>
                                            <span class="mb-0 h5 font-weight-bold">
                                                <span
                                                    class="mb-0 h5 font-weight-bold "><?php echo e($settings->currency); ?><?php echo e(number_format($deposited, 2, '.', ',')); ?>

                                                </span>
                                            </span>
                                        </div>
                                        <div class="col-auto">
                                            <div class="text-white icon bg-gradient-primary rounded-circle icon-shape">
                                                <i class="fas fa-arrow-alt-circle-down"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php if($mod['investment'] || $mod['cryptoswap']): ?>
                            <div class="col-xl-4 col-md-6">
                                <div class="card card-stats">
                                    <!-- Card body -->
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h6 class="mb-1 text-muted">Total Withdrawal</h6>
                                                <span class="mb-0 h5 font-weight-bold">
                                                    <?php echo e($settings->currency); ?><?php echo e(number_format($total_withdrawal, 2, '.', ',')); ?>

                                                </span>
                                            </div>
                                            <div class="col-auto">
                                                <div class="text-white icon bg-gradient-primary rounded-circle icon-shape">
                                                    <i class="fas fa-arrow-circle-up"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>


                    <?php if($mod['investment']): ?>
                        
                        <div class="mt-4 row">
                            <div class="col-12">
                                <div class="nk-block-head-content">
                                    
                                    <h5 class="text-primary h5">Active Plan(s) <span
                                            class="text-base count">(<?php echo e($plans ? count($plans) : '0'); ?>)</span></h5>
                                </div>
                            </div>
                            <div class="col-12">
                                <?php $__empty_1 = true; $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="py-4 card">
                                                <div class="card-body d-flex justify-content-between align-items-center">

                                                    <div class="">
                                                        <h6 class="text-black h6"><?php echo e($plan->dplan->name); ?></h6>
                                                        <p class="text-muted">Amount - <span
                                                                class="amount"><?php echo e($settings->currency); ?><?php echo e(number_format($plan->amount)); ?></span>
                                                        </p>
                                                    </div>
                                                    <div class="d-none d-md-block">
                                                        <div class="d-flex justify-content-around">
                                                            <div class="mr-3">
                                                                <h6 class="text-black bold">
                                                                    <?php echo e($plan->created_at->toDayDateTimeString()); ?>

                                                                </h6>
                                                                <span class="nk-iv-scheme-value date">Start Date</span>
                                                            </div>
                                                            <i class="fas fa-arrow-right text-muted"></i>
                                                            <div class="ml-3">
                                                                <h6 class="text-black bold">
                                                                    <?php echo e(\Carbon\Carbon::parse($plan->expire_date)->toDayDateTimeString()); ?>

                                                                </h6>
                                                                <span class="nk-iv-scheme-value date">End Date</span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div>
                                                        <h6 class="text-black">
                                                            <?php if($plan->active == 'yes'): ?>
                                                                <span class="badge badge-success">Active</span>
                                                            <?php elseif($plan->active == 'expired'): ?>
                                                                <span class="badge badge-danger">Expired</span>
                                                            <?php else: ?>
                                                                <span class="badge badge-danger">Inactive</span>
                                                            <?php endif; ?>
                                                        </h6>
                                                        <span class="nk-iv-scheme-value amount">Status</span>
                                                    </div>

                                                    <a href="<?php echo e(route('plandetails', $plan->id)); ?>">
                                                        <i class="fas fa-chevron-right fa-2x"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div class="mt-4 row">
                                        <div class="col-md-12">
                                            <div class="py-4 card">
                                                <div class="text-center card-body">
                                                    <p>You do not have an active investment plan at the moment.</p>
                                                    <a href="<?php echo e(route('mplans')); ?>" class="px-3 btn btn-primary">Buy a
                                                        plan</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if(count($plans) > 0): ?>
                                    <div class="text-right">
                                        <a href="<?php echo e(route('myplans', 'yes')); ?>"> <i class="fas fa-archive"></i> Go to my
                                            plans</a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                    <?php endif; ?>


                    
                    <div class="mt-4 row">
                        <div class="col-12">
                            <div class="nk-block-head-content">
                                <h6 class="text-primary h5">Recent transactions <span
                                        class="text-base count">(<?php echo e(count($t_history)); ?>)</span>
                                </h6>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-2 text-right">
                                        <a href="<?php echo e(route('accounthistory')); ?>"> <i class="fas fa-clipboard"></i> View
                                            all
                                            transactions</a>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr class="bg-light">
                                                    <th>Date</th>
                                                    <th>Type</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__empty_1 = true; $__currentLoopData = $t_history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo e($item->created_at->toDayDateTimeString()); ?>

                                                        </td>
                                                        <td>
                                                            <?php echo e($item->type); ?>

                                                        </td>
                                                        <td>
                                                            <span class="badge badge-secondary">
                                                                <?php echo e($settings->currency); ?><?php echo e(number_format($item->amount)); ?></span>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <td colspan="3">
                                                        No record yet
                                                    </td>
                                                <?php endif; ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    

                    <div class="mt-4 row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="text-black">Refer Us & Earn</h5>
                                    <p>Use the below link to invite your friends.</p>
                                    <div class="mb-3 input-group">
                                        <input type="text" class="form-control myInput readonly"
                                            value="<?php echo e(Auth::user()->ref_link); ?>" id="reflink" readonly>
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-primary" onclick="myFunction()"
                                                type="button">
                                                <i class="fas fa-copy"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macbookair/Documents/Brynamics/OnlineTraderSoftware/onlinetrader/resources/views/user/dashboard.blade.php ENDPATH**/ ?>