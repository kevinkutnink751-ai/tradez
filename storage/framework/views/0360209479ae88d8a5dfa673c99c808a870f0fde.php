<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>
    <!-- Page title -->
    <div class="page-title">
        <div class="row justify-content-between align-items-center">
            <div class="mb-3 col-md-6 mb-md-0">
                <h5 class="mb-0 text-white h3 font-weight-400">Your <?php echo e($plan->dplan->name); ?> Plan</h5>
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
    <div class="mt-3 row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <div class="d-flex justify-content-between align-items-center">
                            <p>
                                <a href="<?php echo e(route('myplans', 'All')); ?>">
                                    <i class="p-2 rounded-lg fal fa-arrow-circle-left fa-2x bg-light"></i>
                                </a>
                            </p>
                        </div>

                        <h2 class="text-black">
                            <?php echo e($plan->dplan->name); ?> -
                            <?php echo e($plan->dplan->increment_type == 'Fixed' ? $settings->currency : ''); ?><?php echo e($plan->dplan->increment_amount); ?><?php echo e($plan->dplan->increment_type == 'Percentage' ? '%' : ''); ?>

                            <?php echo e($plan->dplan->increment_interval); ?>

                            for <?php echo e($plan->dplan->expiration); ?>

                        </h2>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <?php if($plan->active == 'yes'): ?>
                                    <span class="badge badge-success">Active</span>
                                <?php elseif($plan->active == 'expired'): ?>
                                    <span class="badge badge-danger">Expired</span>
                                <?php else: ?>
                                    <span class="badge badge-danger">Inactive</span>
                                <?php endif; ?>
                            </div>
                            <?php if($settings->should_cancel_plan): ?>
                                <?php if($plan->active == 'yes'): ?>
                                    <a href="#" class="px-3 btn btn-danger btn-sm" data-toggle="modal"
                                        data-target="#exampleModal"> <i class=" fas fa-times"></i> Cancel this Plan</a>

                                    <!-- cancel plan modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">cancel plan</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to cancel your <?php echo e($plan->dplan->name); ?> plan?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>

                                                    <a href="<?php echo e(route('cancelplan', $plan->id)); ?>" type="button"
                                                        class="btn btn-danger">Cancel</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <hr>
                    <div class="mt-5">
                        <h4 class="mb-3">Plan information</h4>
                        <div class="mb-5 row">
                            <div class="col-12">
                                <div class="d-flex justify-content-around">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h2 class="m-0">
                                                <?php echo e($settings->currency); ?><?php echo e(number_format($plan->amount, 2, '.', ',')); ?> +
                                                &nbsp;
                                            </h2>
                                            <small>Invested amount</small>
                                        </div>
                                        <div>
                                            <h2 class="m-0 text-success">
                                                <?php echo e($settings->currency); ?><?php echo e(number_format($plan->profit_earned, 2, '.', ',')); ?>

                                            </h2>
                                            <small>Profit earned</small>
                                        </div>
                                    </div>
                                    <div>
                                        <h2 class="m-0 text-success">
                                            <?php if($settings->return_capital): ?>
                                                <?php echo e($settings->currency); ?><?php echo e(number_format($plan->amount + $plan->profit_earned, 2, '.', ',')); ?>

                                            <?php else: ?>
                                                <?php echo e($settings->currency); ?><?php echo e(number_format($plan->profit_earned, 2, '.', ',')); ?>

                                            <?php endif; ?>


                                        </h2>
                                        <small>Total Return</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row border-bottom">
                            <div class="col-md-3">
                                <p>Duration: <br><strong><?php echo e($plan->dplan->expiration); ?></strong> </p>
                            </div>
                            <div class="col-md-3">
                                <p>Start Date: <br>
                                    <strong><?php echo e($plan->created_at->addHour()->toDayDateTimeString()); ?></strong>
                                </p>
                            </div>
                            <div class="col-md-3">
                                <p>End Date:
                                    <br><strong><?php echo e(\Carbon\Carbon::parse($plan->expire_date)->addHour()->toDayDateTimeString()); ?></strong>
                                </p>
                            </div>
                        </div>
                        <div class="mt-4 row border-bottom">
                            <div class="col-md-3">
                                <p>Minimum Return: <br><strong><?php echo e($plan->dplan->minr); ?>%</strong> </p>
                            </div>
                            <div class="col-md-3">
                                <p>Maximum Return: <br> <strong><?php echo e($plan->dplan->maxr); ?>%</strong> </p>
                            </div>
                            <div class="col-md-3">
                                <p>ROI Interval:
                                    <br><strong><?php echo e($plan->dplan->increment_interval); ?></strong>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-5 ">
                        <h4>
                            Transactions
                        </h4>
                        <div class="table-responsive">
                            <table class="table table-hover ">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Type</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td>Profit</td>
                                            <td><?php echo e($history->created_at->addHour()->toDayDateTimeString()); ?></td>
                                            <td><?php echo e($settings->currency); ?><?php echo e(number_format($history->amount, 2, '.', ',')); ?>

                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr class="text-center">
                                            <td colspan="3">No transaction record yet</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div>
                            <?php echo e($transactions->links()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macbookair/Documents/Brynamics/OnlineTraderSoftware/onlinetrader/resources/views/user/plandetails.blade.php ENDPATH**/ ?>