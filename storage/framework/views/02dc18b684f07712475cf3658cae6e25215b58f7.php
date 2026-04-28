<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>
    <!-- Page title -->
    <div class="page-title">
        <div class="row justify-content-between align-items-center">
            <div class="mb-3 col-md-6 mb-md-0">
                <h5 class="mb-0 text-white h3 font-weight-400">Place a withdrawal request</h5>
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
        <div class="my-5 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="my-5 row d-flex nowrap">
                        <?php $__currentLoopData = $wmethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="mb-4 col-lg-4">
                                <div class="card-deck">
                                    <div
                                        class="text-center border-0 rounded-lg shadow-lg card card-pricing hover-scale-110 bg-primary popular">
                                        <div class="py-0 border-0 card-header">
                                            <span
                                                class="px-4 py-1 mx-auto bg-white shadow-sm h6 d-inline-block rounded-bottom"><?php echo e($method->name); ?></span>
                                            <div class="py-5">
                                                <img src="<?php echo e(asset('themes/purposeTheme/assets/img/Wallet.svg.png')); ?>"
                                                    alt="withdrawal method image" srcset=""
                                                    class="img-fluid img-center" style="height:90px;">

                                            </div>
                                        </div>
                                        <hr class="my-0 divider divider-fade divider-dark" />
                                        <div class="card-body">
                                            <ul class="mb-4 text-white list-unstyled">
                                                <li>
                                                    <small>Minimum withdrawable amount</small>
                                                    <p class="text-white h5">
                                                        <?php echo e($settings->currency); ?><?php echo e(number_format($method->minimum)); ?></p>
                                                </li>
                                                <li>
                                                    <small>Maximum withdrawable amount</small>
                                                    <p class="text-white h5">
                                                        <?php echo e($settings->currency); ?><?php echo e(number_format($method->maximum)); ?></p>
                                                </li>
                                                <li>Charge Type: <strong><?php echo e($method->charges_type); ?></strong></li>
                                                <li>
                                                    Charges Amount:
                                                    <strong>
                                                        <?php if($method->charges_type == 'percentage'): ?>
                                                            <?php echo e($method->charges_amount); ?>%
                                                        <?php else: ?>
                                                            <?php echo e($settings->currency); ?><?php echo e($method->charges_amount); ?>

                                                        <?php endif; ?>
                                                    </strong>
                                                </li>
                                                <li>
                                                    Duration: <strong><?php echo e($method->duration); ?></strong>
                                                </li>
                                            </ul>
                                            <?php if($settings->enable_with == 'false'): ?>
                                                <button class="mb-3 btn btn-sm btn-neutral" data-toggle="modal"
                                                    data-target="#withdrawdisabled"><i class="fa fa-plus"></i> Request
                                                    withdrawal</button>
                                            <?php else: ?>
                                                <form action='<?php echo e(route('withdrawamount')); ?>' method="POST">
                                                    <?php echo csrf_field(); ?>
                                                    <div class="form-group">
                                                        <input type="hidden" value="<?php echo e($method->name); ?>" name="method">
                                                        <button class="mb-3 btn btn-sm btn-neutral" type='submit'><i
                                                                class="fa fa-plus"></i> Request withdrawal</button>
                                                    </div>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <!-- Withdrawal Modal -->
                    <div id="withdrawdisabled" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header ">
                                    <h6 class="modal-title">Withdrawal Status</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                </div>
                                <div class="modal-body ">
                                    <h6 class="">Withdrawal is Disabled at the moment, Please check
                                        back later</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /Withdrawals Modal -->
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macbookair/Documents/Brynamics/OnlineTraderSoftware/onlinetrader/resources/views/user/withdrawals.blade.php ENDPATH**/ ?>