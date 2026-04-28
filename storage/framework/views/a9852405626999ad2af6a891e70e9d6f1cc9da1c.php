<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>
    <!-- Page title -->
    <div class="page-title">
        <div class="row justify-content-between align-items-center">
            <div class="mb-3 col-md-6 mb-md-0">
                <h5 class="mb-0 text-white h3 font-weight-400">24/7 Customer Support</h5>
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
					<div class="mb-5 row p-md-3">
						<div class="col-12 p-md-2">
							<div class="p-3 text-center col-12">
								<h1><?php echo e($settings->site_name); ?> Support</h1>
								<div class="">
									<h4 class="h5">For inquiries, suggestions or complains. Mail us</h4>
									<h1 class="mt-3 text-primary h4"> <a href="mailto:<?php echo e($settings->contact_email); ?>"><?php echo e($settings->contact_email); ?></a> </h1>
								</div>
							</div>
							<div class="pb-5 col-md-8 offset-md-2">
								<form method="post" action="<?php echo e(route('enquiry')); ?>">
									<input type="hidden" name="name" value="<?php echo e(Auth::user()->name); ?>" />
									<div class="form-group">
										<input type="hidden" name="email" value="<?php echo e(Auth::user()->email); ?>">
									</div>
									<div class="form-group">
										<h5 for="" class="">Message<span class=" text-danger">*</span></h5>
										<textarea name="message" class="form-control " rows="5"></textarea>
									</div>
									<input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
									<div class="">
										<input type="submit" class="py-2 btn btn-primary btn-block" value="Send">
									</div>
								</form>
							</div>
						</div>
						
					</div>
                </div>
            </div>
        </div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macbookair/Documents/Brynamics/OnlineTraderSoftware/onlinetrader/resources/views/user/support.blade.php ENDPATH**/ ?>