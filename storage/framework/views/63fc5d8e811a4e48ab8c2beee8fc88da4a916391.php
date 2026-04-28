<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>
    <!-- Page title -->
    <div class="page-title">
        <div class="row justify-content-between align-items-center">
            <div class="mb-3 col-md-6 mb-md-0">
                <h5 class="mb-0 text-white h3 font-weight-400">Fund your account balance</h5>
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
            <div class="card ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <form action="javascript:;" method="post" id="submitpaymentform">
                                <?php echo csrf_field(); ?>
                                <div class="row">
                                    <div class="mb-4 col-md-12">
                                        <h5 class="card-title ">Enter Amount</h5>
                                        <input class="form-control " placeholder="Enter Amount"
                                            min="<?php echo e($moresettings->minamt); ?>" type="number" name="amount" required>
                                    </div>
                                    <div class="mb-4 col-md-12">
                                        <input type="hidden" name="payment_method" id="paymethod">
                                    </div>
                                    <div class="mt-2 mb-1 col-md-12">
                                        <h5 class="card-title ">Choose Payment Method from the list below</h5>
                                    </div>
                                    <?php $__empty_1 = true; $__currentLoopData = $dmethods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <div class="mb-2 col-md-6">
                                            <a style="cursor: pointer;" data-method="<?php echo e($method->name); ?>"
                                                id="<?php echo e($method->id); ?>" class="text-decoration-none"
                                                onclick="checkpamethd(this.id)">
                                                <div class="rounded border">
                                                    <div
                                                        class="card-body d-flex justify-content-between align-items-center">
                                                        <span class="">
                                                            <?php if(!empty($method->img_url)): ?>
                                                                <img src="<?php echo e($method->img_url); ?>" alt=""
                                                                    class="" style="width: 25px;">
                                                            <?php endif; ?>
                                                            <?php echo e($method->name); ?>

                                                        </span>
                                                        <span>
                                                            <input type="radio" id="<?php echo e($method->id); ?>customCheck1"
                                                                readonly>
                                                        </span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <div class="mb-1 col-md-12">
                                            <p class="">No Payment Method enabled at the moment, please check
                                                back later.</p>
                                        </div>
                                    <?php endif; ?>
                                    <?php if(count($dmethods) > 0): ?>
                                        <div class="mt-2 mb-1 col-md-12">
                                            <input type="submit" class="px-5 btn btn-primary btn-lg"
                                                value="Procced to Payment">
                                        </div>
                                        <input type="hidden" id="lastchosen" value="0">
                                    <?php endif; ?>
                                </div>
                            </form>
                        </div>
                        <div class="mt-4 col-md-4">
                            <!-- Seller -->
                            <div class="card">

                                <div class="card-body">
                                    <div class="pb-4">
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <h6 class="mb-0">Total Deposit</h6>
                                                <span class="text-sm text-muted">-</span>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="mb-1">
                                                    <b><?php echo e($settings->currency); ?><?php echo e(number_format($deposited, 2, '.', ',')); ?>

                                                    </b>
                                                </h6>
                                                <span class="text-sm text-muted">Amount</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="actions d-flex justify-content-between">
                                        <a href="<?php echo e(route('accounthistory')); ?>" class="action-item">
                                            <span class="btn-inner--icon">View deposit history</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php $__env->startSection('scripts'); ?>
        <?php echo \Illuminate\View\Factory::parentPlaceholder('scripts'); ?>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <!-- Bootstrap Notify -->
        <script src="<?php echo e(asset('dash2/libs/bootstrap-notify/bootstrap-notify.min.js')); ?> "></script>

        <?php echo $__env->make('user.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macbookair/Documents/Brynamics/OnlineTraderSoftware/onlinetrader/resources/views/user/deposits.blade.php ENDPATH**/ ?>