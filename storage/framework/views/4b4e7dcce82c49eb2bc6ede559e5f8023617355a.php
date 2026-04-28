<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>
    <!-- Page title -->
    <div class="page-title">
        <div class="row justify-content-between align-items-center">
            <div class="mb-3 col-md-6 mb-md-0 d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-white h3 font-weight-400">Trade Signal</h5>
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
                    <div class="row">
                        <div class="col-12">
                            <?php if(!$subscription): ?>
                                <div class="text-center">
                                    <p>You do not have have a subscription</p>
                                    <button type="button" class="btn btn-primary px-4 btn-sm"" data-toggle="modal"
                                        data-target="#exampleModal">
                                        Subscribe Now
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Subscribe</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('user.subscribe-to-signal', [])->html();
} elseif ($_instance->childHasBeenRendered('qBDUiPm')) {
    $componentId = $_instance->getRenderedChildComponentId('qBDUiPm');
    $componentTag = $_instance->getRenderedChildComponentTagName('qBDUiPm');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('qBDUiPm');
} else {
    $response = \Livewire\Livewire::mount('user.subscribe-to-signal', []);
    $html = $response->html();
    $_instance->logRenderedChild('qBDUiPm', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php else: ?>
                                <div class="">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <h3 class=" h5"><?php echo e($subscription->subscription); ?> Subscription</h3>
                                            <h3 class="text-primary"><?php echo e($settings->currency . $subscription->amount_paid); ?>

                                            </h3>
                                        </div>
                                        <div>
                                            <small class="text-danger">Expiring</small>
                                            <p class="m-0">
                                                <?php echo e(\Carbon\Carbon::parse($subscription->expired_at)->toDayDateTimeString()); ?>

                                            </p>

                                            <?php if(now()->greaterThanOrEqualTo(\Carbon\Carbon::parse($subscription->reminded_at)) or
                                                now()->greaterThanOrEqualTo(\Carbon\Carbon::parse($subscription->expired_at))): ?>
                                                <div>
                                                    <button type="button" class="btn btn-primary btn-sm"
                                                        data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                        Pay
                                                        <?php if($subscription->subscription == 'Monthly'): ?>
                                                            <?php echo e($settings->currency . $set->signal_monthly_fee); ?>

                                                        <?php elseif($subscription->subscription == 'Quarterly'): ?>
                                                            <?php echo e($settings->currency . $set->signal_monthly_fee); ?>

                                                        <?php else: ?>
                                                            <?php echo e($settings->currency . $set->signal_yearly_fee); ?>

                                                        <?php endif; ?>
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h6 class="modal-title fs-5" id="exampleModalLabel">
                                                                        Renew
                                                                        your Subscription</h6>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h5>
                                                                        <?php if($subscription->subscription == 'Monthly'): ?>
                                                                            <?php echo e($settings->currency . $set->signal_monthly_fee); ?>

                                                                        <?php elseif($subscription->subscription == 'Quarterly'): ?>
                                                                            <?php echo e($settings->currency . $set->signal_monthly_fee); ?>

                                                                        <?php else: ?>
                                                                            <?php echo e($settings->currency . $set->signal_yearly_fee); ?>

                                                                        <?php endif; ?> will be deducted from
                                                                        your
                                                                        account balance..
                                                                    </h5>
                                                                    <div class="mt-2 text-right">
                                                                        <button type="button"
                                                                            class="btn btn-secondary btn-sm"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <a href="<?php echo e(route('renewsignals')); ?>"
                                                                            class="btn btn-primary btn-sm">Yes,
                                                                            Proceed</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- /plans Modal -->

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mazibuckler/apps/sites/tradez/resources/views/user/signals/subscribe.blade.php ENDPATH**/ ?>