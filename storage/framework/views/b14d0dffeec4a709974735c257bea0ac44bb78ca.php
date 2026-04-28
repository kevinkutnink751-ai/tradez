<?php
    $sub_link = 'https://trade.mql5.com/trade';
?>


<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>
    <!-- Page title -->
    <div class="page-title">
        <div class="row justify-content-between align-items-center">
            <div class="mb-3 col-md-6 mb-md-0">
                <h5 class="mb-0 text-white h3 font-weight-400">Trading Account(s)</h5>
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
                    <div class="mb-5 row">
                        <div class="shadow-lg col-lg-12 card p-lg-3 p-sm-5">
                            <h2 class=""><?php echo e($settings->site_name); ?> Account manager</h2> <br>
                            <div clas="well">
                                <p class="text-justify ">Don’t have time to trade or learn how to
                                    trade?
                                    Our Account Management Service is The Best Profitable Trading Option for you,
                                    We can help you to manage your account in the financial MARKET with a simple
                                    subscription model.<br>
                                    <small>Terms and Conditions apply</small><br>Reach us at <?php echo e($settings->contact_email); ?>

                                    for more info.
                                </p>
                            </div>
                            <br>
                            <div class="py-3">
                                <a class="text-white btn btn-primary" data-toggle="modal" data-target="#submitmt4modal">
                                    Subscribe Now
                                </a>
                            </div>

                        </div>
                    </div>
                    <div class="p-2 mb-5 p-md-4 row">
                        <div class="mb-3 col-12">
                            <h5 class="">My Trading Accounts</h5>
                        </div>
                        <?php $__empty_1 = true; $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="col-md-4 p-2">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo e($sub->mt4_id); ?>/<?php echo e($sub->account_type); ?>

                                        </h5>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-primary">Currency</span>
                                            <span><?php echo e($sub->currency); ?></span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-primary">Leverage</span>
                                            <span><?php echo e($sub->leverage); ?></span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-primary">Server</span>
                                            <span><?php echo e($sub->server); ?></span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-primary">Duration</span>
                                            <span><?php echo e($sub->duration); ?></span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-primary">Account Password</span>
                                            <span>xxxxxxx</span>
                                        </div>

                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="text-primary">Status</span>
                                            <span><?php echo e($sub->status); ?></span>
                                        </div>
                                        <div class="d-flex justify-content-center mb-2">
                                            <small>Submitted:
                                                <?php echo e(\Carbon\Carbon::parse($sub->created_at)->toDayDateTimeString()); ?></small>
                                        </div>
                                        <div class="d-flex justify-content-center mb-2">
                                            <small>
                                                Started:
                                                <?php if(!empty($sub->start_date)): ?>
                                                    <?php echo e(\Carbon\Carbon::parse($sub->start_date)->toDayDateTimeString()); ?>

                                                <?php else: ?>
                                                    Not Started yet
                                                <?php endif; ?>
                                            </small>
                                        </div>
                                        <div class="d-flex justify-content-center mb-2">
                                            <small>Expire:
                                                <?php if(!empty($sub->end_date)): ?>
                                                    <?php echo e(\Carbon\Carbon::parse($sub->end_date)->toDayDateTimeString()); ?>

                                                <?php else: ?>
                                                    Not Started yet
                                                <?php endif; ?>
                                            </small>
                                        </div>
                                        <div class="mt-4 text-center">
                                            <?php
                                                $endAt = \Carbon\Carbon::parse($sub->end_date);
                                                $remindAt = \Carbon\Carbon::parse($sub->reminded_at);
                                            ?>
                                            <a href="#" data-toggle="modal" class="btn btn-danger btn-sm"
                                                onclick="deletemt4()">Cancel</a>
                                            <?php if(($sub->status != 'Pending' && now()->isSameDay($remindAt)) || $sub->status == 'Expired'): ?>
                                                <a href="<?php echo e(route('renewsub', $sub->id)); ?>"
                                                    class="btn btn-success btn-sm">Renew</a>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="col-md-12">
                                <div class="py-4 card">
                                    <div class="text-center card-body">
                                        <p>You do not have an trading at the moment.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h3 class="">Connect to your trading account to monitor activities on
                                your trading account(s).</h3>
                            <iframe src="<?php echo e($sub_link); ?>" name="WebTrader" title="<?php echo e($title); ?>" frameborder="0"
                                style="display: block; border: none; height: 76vh; width: 80vw;"></iframe>
                        </div>
                    </div>
                    <!-- end of chart -->
                </div>
            </div>
        </div>
    </div>
    <?php echo $__env->make('user.modals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <script type="text/javascript">
        function deletemt4() {
            swal({
                title: "Error!",
                text: "Send an Email to <?php echo e($settings->contact_email); ?> to have your MT4 Details cancelled.",
                icon: "error",
                buttons: {
                    confirm: {
                        text: "Okay",
                        value: true,
                        visible: true,
                        className: "btn btn-danger",
                        closeModal: true
                    }
                }
            });
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macbookair/Documents/Brynamics/OnlineTraderSoftware/onlinetrader/resources/views/user/subtrade.blade.php ENDPATH**/ ?>