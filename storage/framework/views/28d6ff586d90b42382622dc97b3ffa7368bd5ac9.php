<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>
    <!-- Page title -->
    <div class="page-title">
        <div class="row justify-content-between align-items-center">
            <div class="mb-3 col-md-6 mb-md-0">
                <h5 class="mb-0 text-white h3 font-weight-400">Transaction Records</h5>
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
                    <ul class="mb-3 nav nav-pills nav-pills-icon nav-justified" id="pills-tab" role="tablist">
                        <li class="p-2 nav-item" role="presentation">
                            <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home"
                                role="tab" aria-controls="pills-home" aria-selected="true">
                                <span class="d-block">
                                    <i class="fas fa-download "></i>
                                </span>
                                <span class="mt-2 d-none d-sm-block">Deposit</span>
                            </a>
                        </li>
                        <li class="p-2 nav-item" role="presentation">
                            <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile"
                                role="tab" aria-controls="pills-profile" aria-selected="false">
                                <span class="d-block">
                                    <i class="fas fa-arrow-alt-circle-up "></i>
                                </span>
                                <span class="mt-2 d-none d-sm-block">Withdrawal</span>
                            </a>
                        </li>
                        <li class="p-2 nav-item" role="presentation">
                            <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact"
                                role="tab" aria-controls="pills-contact" aria-selected="false">
                                <span class="d-block">
                                    <i class="far fa-arrow-alt-from-left"></i>
                                </span>
                                <span class="mt-2 d-none d-sm-block">Others</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            <div class="table-responsive">
                                <table id="DeposTbl" class="table table-hover ">
                                    <thead>
                                        <tr>
                                            <th>Amount</th>
                                            <th>Payment mode</th>
                                            <th>Status</th>
                                            <th>Date created</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $deposits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deposit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($settings->currency); ?><?php echo e($deposit->amount); ?></td>
                                                <td><?php echo e($deposit->payment_mode); ?></td>
                                                <td>
                                                    <?php if($deposit->status == 'Processed'): ?>
                                                        <span class="badge badge-success"><?php echo e($deposit->status); ?></span>
                                                    <?php else: ?>
                                                        <span class="badge badge-danger"><?php echo e($deposit->status); ?></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo e(\Carbon\Carbon::parse($deposit->created_at)->toDayDateTimeString()); ?>

                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="table-responsive">
                                <table id="WithdrawTbl" class="table table-hover ">
                                    <thead>
                                        <tr>
                                            <th>Amount requested</th>
                                            <th>Amount + charges</th>
                                            <th>Recieving mode</th>
                                            <th>Status</th>
                                            <th>Date created</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $withdrawals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $withdrawal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($settings->currency); ?><?php echo e($withdrawal->amount); ?></td>
                                                <td><?php echo e($settings->currency); ?><?php echo e($withdrawal->to_deduct); ?></td>
                                                <td><?php echo e($withdrawal->payment_mode); ?></td>
                                                <td>
                                                    <?php if($withdrawal->status == 'Processed'): ?>
                                                        <span class="badge badge-success"><?php echo e($withdrawal->status); ?></span>
                                                    <?php else: ?>
                                                        <span class="badge badge-danger"><?php echo e($withdrawal->status); ?></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo e(\Carbon\Carbon::parse($withdrawal->created_at)->toDayDateTimeString()); ?>

                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div class="table-responsive">
                                <table id="OthersTable" class="table table-hover ">
                                    <thead>
                                        <tr>
                                            <th>Amount</th>
                                            <th>Type</th>
                                            <th>Plan/Narration</th>
                                            <th>Date created</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $t_history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($settings->currency); ?><?php echo e($history->amount); ?></td>
                                                <td><?php echo e($history->type); ?></td>
                                                <td><?php echo e($history->plan); ?></td>
                                                <td><?php echo e(\Carbon\Carbon::parse($history->created_at)->toDayDateTimeString()); ?>

                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macbookair/Documents/Brynamics/OnlineTraderSoftware/onlinetrader/resources/views/user/transactions.blade.php ENDPATH**/ ?>