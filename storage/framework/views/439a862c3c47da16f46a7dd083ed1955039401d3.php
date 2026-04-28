<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>
    <!-- Page title -->
    <div class="page-title">
        <div class="row justify-content-between align-items-center">
            <div class="mb-3 col-md-6 mb-md-0">
                <h5 class="mb-0 text-white h3 font-weight-400">My Investment plans
                    (<?php echo e(request()->route('sort') == 'yes' ? 'Active' : request()->route('sort')); ?>)</h5>
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
                    <?php if($numOfPlan > 0): ?>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-end">
                                <select name="sortplan" id="sortvalue"
                                    class="custom-select custom-select-sm form-control w-25">
                                    <option value="All">All</option>
                                    <option value="yes">Active</option>
                                    <option value="cancelled">Cancelled/Inactive</option>
                                    <option value="expired">Expired</option>
                                </select>
                                <a href="javascript:;" id="sortform" class="btn btn-primary btn-sm">Sort</a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php $__empty_1 = true; $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="mt-4 row">
                            <div class="col-md-12">
                                <div class="py-4 card">
                                    <div class="card-body d-flex justify-content-between align-items-center">
                                        <div class="d-flex align-items-center">
                                            
                                            <div class="">
                                                <h6 class="text-black h6"><?php echo e($plan->dplan->name); ?></h6>
                                                <p class="text-muted">Amount - <span
                                                        class="amount"><?php echo e($settings->currency); ?><?php echo e(number_format($plan->amount)); ?></span>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="d-none d-md-block">
                                            <div class="d-flex justify-content-around">
                                                <div class="mr-3">
                                                    <h6 class="text-black bold">
                                                        <?php echo e($plan->created_at->addHour()->toDayDateTimeString()); ?></h6>
                                                    <span class="nk-iv-scheme-value date">Start Date</span>
                                                </div>
                                                <i class="fas fa-arrow-right text-muted"></i>
                                                <div class="ml-3">
                                                    <h6 class="text-black bold">
                                                        <?php echo e(\Carbon\Carbon::parse($plan->expire_date)->addHour()->toDayDateTimeString()); ?>

                                                    </h6>
                                                    <span class="nk-iv-scheme-value date">End Date</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="">
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

                                        <p>You do not have an investment plan at the moment or no value match your query.
                                        </p>
                                        <a href="<?php echo e(route('mplans')); ?>" class="px-3 btn btn-primary">Buy a plan</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if(count($plans) > 0): ?>
                        <div class="row">
                            <div class="mt-2 col-12">
                                <?php echo e($plans->links()); ?>

                            </div>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('scripts'); ?>
    <script>
        var sortvalue = document.getElementById('sortvalue');
        var sortform = document.getElementById('sortform');
        let makepayurl = "<?php echo e(url('/dashboard/sort-plans/All')); ?>";
        sortform.href = makepayurl;
        sortvalue.addEventListener('change', function() {
            makepayurl = "<?php echo e(url('/dashboard/sort-plans/')); ?>" + '/' + sortvalue.value;
            sortform.href = makepayurl;
        })
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macbookair/Documents/Brynamics/OnlineTraderSoftware/onlinetrader/resources/views/user/myplans.blade.php ENDPATH**/ ?>