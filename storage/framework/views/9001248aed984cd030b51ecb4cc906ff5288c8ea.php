<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.topmenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="main-panel ">
        <div class="content">
            <div class="page-inner">
                <div class="mt-2 mb-4">
                    <h1 class="title1">Trading Accounts</h1>
                    <p class="">
                        Manage trading accounts submitted by users. Collect their submitted details and connect to your
                        master trading account
                    </p>
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
                <div class="mt-2 mb-5 row">
                    <div class="col-12">
                        <div class="card p-3">
                            <div class="row">
                                <div class="col-12">
                                    <ul class="nav nav-pills">
                                        <li class="nav-item">
                                            <a href="<?php echo e(route('msubtrade')); ?>" class="nav-link active">Submited Accounts</a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?php echo e(route('tacnts')); ?>" class="nav-link">Connected Accounts</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="mt-3 row">
                                
                                <div class="col-12">
                                    <div class="table-responsive" data-example-id="hoverable-table">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>USER</th>
                                                    <th>Account ID</th>
                                                    <th>Account Password</th>
                                                    <th>Account Type</th>
                                                    <th>Account Name</th>
                                                    <th>Currency</th>
                                                    <th>Leverage</th>
                                                    <th>Server</th>
                                                    <th>Duration</th>
                                                    <th>Submitted at</th>
                                                    <th>Started at</th>
                                                    <th>Expiring at</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e($sub->tuser->name); ?> <?php echo e($sub->tuser->l_name); ?></td>
                                                        <td><?php echo e($sub->mt4_id); ?></td>
                                                        <td><?php echo e($sub->mt4_password); ?></td>
                                                        <td><?php echo e($sub->account_type); ?></td>
                                                        <td><?php echo e($sub->account_name); ?></td>
                                                        <td><?php echo e($sub->currency); ?></td>
                                                        <td><?php echo e($sub->leverage); ?></td>
                                                        <td><?php echo e($sub->server); ?></td>
                                                        <td><?php echo e($sub->duration); ?></td>
                                                        <td><?php echo e($sub->created_at->toDayDateTimeString()); ?>

                                                        </td>
                                                        <td>
                                                            <?php if(!empty($sub->start_date)): ?>
                                                                <?php echo e($sub->start_date->toDayDateTimeString()); ?>

                                                            <?php else: ?>
                                                                Not Started yet
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php if(!empty($sub->end_date)): ?>
                                                                <?php echo e($sub->end_date->toDayDateTimeString()); ?>

                                                            <?php else: ?>
                                                                Not Started yet
                                                            <?php endif; ?>

                                                        </td>
                                                        <td><?php echo e($sub->status); ?></td>
                                                        <td>
                                                            <?php if($sub->status == 'Pending'): ?>
                                                                <form action="<?php echo e(route('create.sub')); ?>" method="post">
                                                                    <?php echo csrf_field(); ?>
                                                                    <input type="hidden" name="login"
                                                                        value="<?php echo e($sub->mt4_id); ?>">
                                                                    <input type="hidden" name="password"
                                                                        value="<?php echo e($sub->mt4_password); ?>">
                                                                    <input type="hidden" name="serverName"
                                                                        value="<?php echo e($sub->server); ?>">
                                                                    <input type="hidden" name="acntype"
                                                                        value="<?php echo e($sub->account_type); ?>">
                                                                    <input type="hidden" name="leverage"
                                                                        value="<?php echo e($sub->leverage); ?>">
                                                                    <input type="hidden" name="currency"
                                                                        value="<?php echo e($sub->currency); ?>">
                                                                    <input type="hidden" name="name"
                                                                        value="<?php echo e($sub->account_name); ?>">
                                                                    <input type="hidden" name="mt4id"
                                                                        value="<?php echo e($sub->id); ?>">
                                                                    <button type="submit"
                                                                        class="mb-2 btn btn-primary btn-sm">Process</button>
                                                                </form>
                                                            <?php else: ?>
                                                                
                                                            <?php endif; ?>
                                                            <a href="<?php echo e(url('admin/dashboard/delsub')); ?>/<?php echo e($sub->id); ?>"
                                                                class="btn btn-danger btn-sm">Delete</a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>

                                        <?php echo e($subscriptions->links()); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mazibuckler/apps/sites/tradez/resources/views/admin/subscription/msubtrade.blade.php ENDPATH**/ ?>