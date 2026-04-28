<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.topmenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
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
                <?php echo $__env->make('admin.subscription.master.statistics', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="mb-5 row">
                    <div class="col-md-12">
                        <?php if($accounts and count($accounts) < 1): ?>
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-center">
                                        <h5 class="card-title">No Master Trading Account</h5>
                                        <p>Add a master account</p>
                                        <a href="<?php echo e(route('create.master')); ?>" type="button"
                                            class="text-white btn btn-primary" data-toggle="modal"
                                            data-target="#masterModal">
                                            Add Account
                                        </a>
                                    </div>

                                </div>
                            </div>
                        <?php else: ?>
                            <div class="card">
                                <div class="card-body">
                                    <div class="text-center">
                                        <p>Add a master account</p>
                                        <a href="<?php echo e(route('create.master')); ?>" type="button"
                                            class="text-white btn btn-primary" data-toggle="modal"
                                            data-target="#masterModal">
                                            Add Account
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 mb-2">
                                            <h1 class=" font-weight-bold d-md-block d-none">Your Master(Provider) Accounts
                                            </h1>
                                            <h2 class=" font-weight-bold d-md-none d-block">Your Master(Provider) Accounts
                                            </h2>
                                            <p class="text-primary font-weight-bold">
                                                NOTE: Your master Account will be
                                                deleted after
                                                10 days of
                                                expiration and have not been renewed.
                                            </p>
                                            <div class=" table-responsive">
                                                <table class="table table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th>Account ID</th>
                                                            <th>Account Password</th>
                                                            <th>Account Type</th>
                                                            <th>Account Name</th>
                                                            <th>Server</th>
                                                            <th>Deployment status</th>
                                                            <th>Started at</th>
                                                            <th>Expiring at</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $__empty_1 = true; $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                            <tr>
                                                                <td>
                                                                    <?php echo e($item->login); ?>

                                                                </td>
                                                                <td>
                                                                    <?php echo e($item->password); ?>

                                                                </td>
                                                                <td>
                                                                    <?php echo e($item->account_type); ?>

                                                                </td>
                                                                <td>
                                                                    <?php echo e($item->account_name); ?>

                                                                </td>
                                                                <td>
                                                                    <?php echo e($item->server); ?>

                                                                </td>
                                                                <td>
                                                                    <?php if($item->deployment_status == 'Deployed'): ?>
                                                                        <h2 class="badge badge-success">
                                                                            <?php echo e($item->deployment_status); ?></h2>
                                                                    <?php else: ?>
                                                                        <h2 class="badge badge-warning">
                                                                            <?php echo e($item->deployment_status); ?></h2>
                                                                    <?php endif; ?>
                                                                </td>
                                                                <td>
                                                                    <span><?php echo e(\Carbon\Carbon::parse($item->start_date)->toDayDateTimeString()); ?></span>
                                                                </td>
                                                                <td>
                                                                    <?php echo e(\Carbon\Carbon::parse($item->end_date)->toDayDateTimeString()); ?>

                                                                </td>
                                                                <td>
                                                                    <?php if(now()->greaterThanOrEqualTo(\Carbon\Carbon::parse($item->end_date))): ?>
                                                                        <a href="#" class="btn btn-info btn-sm m-1"
                                                                            data-toggle="modal"
                                                                            data-target="#renewModal<?php echo e($item->id); ?>">Renew</a>
                                                                    <?php endif; ?>
                                                                    <button type="button" data-toggle="modal"
                                                                        data-target="#strategyModal<?php echo e($item->id); ?>"
                                                                        class="btn btn-secondary btn-sm m-1">
                                                                        <span>
                                                                            Update Strategy
                                                                        </span>
                                                                    </button>
                                                                    <button type="button" data-toggle="modal"
                                                                        data-target="#deleteModal<?php echo e($item->id); ?>"
                                                                        class="btn btn-danger btn-sm m-1">
                                                                        <i class="fa fa-trash"></i>
                                                                        <span> Delete</span>
                                                                    </button>
                                                                    <?php echo $__env->make('admin.subscription.master.delete-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                                    <?php echo $__env->make('admin.subscription.master.renew-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                            <tr>
                                                                <td colspan="9" class="text-center">
                                                                    No Data Available
                                                                </td>
                                                            </tr>
                                                        <?php endif; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <?php echo $__env->make('admin.subscription.master.create-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mazibuckler/apps/sites/tradez/resources/views/admin/subscription/trading-settings.blade.php ENDPATH**/ ?>