<?php $uc = app('App\Http\Controllers\User\UsersController'); ?>
<?php
    $array = \App\Models\User::all();
    $usr = Auth::user()->id;
?>

<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>
    <!-- Page title -->
    <div class="page-title">
        <div class="row justify-content-between align-items-center">
            <div class="mb-3 col-md-6 mb-md-0">
                <h5 class="mb-0 text-white h3 font-weight-400">Refer users to <?php echo e($settings->site_name); ?> community</h5>
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
                    <div class="p-4 row">
                        <div class="col-md-8 offset-md-2 text-center">
                            <strong>You can refer users by sharing your referral link:</strong><br>
                            <div class="mb-3 input-group">
                                <input type="text" class="form-control readonly" value="<?php echo e(Auth::user()->ref_link); ?>"
                                    id="reflink" readonly>
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" onclick="myFunction()" type="button"
                                        id="button-addon2">
                                        <i class="fas fa-copy"></i>
                                    </button>
                                </div>
                            </div>

                            <strong>or your Referral ID</strong><br>
                            <h4 class="text-success"> <?php echo e(Auth::user()->username); ?></h4>
                            <h5 class="title1 text-center">
                                You were referred by
                            </h5>
                            <i class="fa fa-user fa-2x d-block"></i>
                            <small><?php echo e($uc->getUserParent($usr)); ?></small>
                        </div>
                        <div class="mt-4 col-md-12">
                            <h6 class="text-left title1">Your Referrals.</h6>
                            <div class="table-responsive">
                                <table class="table UserTable table-hover ">
                                    <thead>
                                        <tr>
                                            <th>Client name</th>
                                            <th>Ref. level</th>
                                            <th>Parent</th>
                                            <th>Client status</th>
                                            <th>Date registered</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php echo $uc->getdownlines($array, $usr); ?>

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

<?php echo $__env->make('layouts.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macbookair/Documents/Brynamics/OnlineTraderSoftware/onlinetrader/resources/views/user/referuser.blade.php ENDPATH**/ ?>