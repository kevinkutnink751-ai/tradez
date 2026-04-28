<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>
    <!-- Page title -->
    <div class="page-title mb-5">

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
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div>
                        <h4><?php echo e($course->course_title); ?></h4>
                    </div>
                    <div class="p-2 d-lg-flex justify-content-lg-between align-items-center mt-3">
                        <div class="mt-2 mt-lg-0">
                            <p class="m-0 text-primary font-weight-bold">CREATED BY</p>
                            <P class="m-0"><?php echo e($settings->site_name); ?></P>
                        </div>
                        <div class="mt-2 mt-lg-0">
                            <p class="m-0 text-primary font-weight-bold">CATEGORY</p>
                            <P class="m-0"><?php echo e($course->category); ?></P>
                        </div>
                        <div class="mt-2 mt-lg-0">
                            <p class="m-0 text-primary font-weight-bold">LAST UPDATED</p>
                            <P class="m-0"><?php echo e(\Carbon\Carbon::parse($course->updated_at)->toDayDateTimeString()); ?></P>
                        </div>
                    </div>
                    <div class="mt-5">
                        <h4>About Course</h4>
                        <p class="mt-2">
                            <?php echo e($course->description); ?>

                        </p>
                    </div>
                    <div class="mt-5">
                        <h4>Course Lessons</h4>
                        <?php $__empty_1 = true; $__currentLoopData = $lessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lesson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div>
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <i class="fas fa-play-circle fa-2x text-danger mr-2"></i>
                                        <div>
                                            <h6 class="h6 m-0"><?php echo e($lesson->title); ?></h6>
                                            <small class="text-muted d-block"><?php echo e($lesson->description); ?></small>
                                            <small class="text-muted"><?php echo e($lesson->length); ?></small>
                                        </div>
                                    </div>
                                    <div>
                                        <?php if($lesson->locked == 'true'): ?>
                                            <a href="#" data-toggle="modal" data-target="#preview<?php echo e($lesson->id); ?>"
                                                class="px-3 shadow bg-info text-white rounded-4 rounded-md">Preview</a>
                                            <i class="fas fa-unlock"></i>
                                        <?php else: ?>
                                            <i class="fas fa-lock"></i>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div style="border-top: 1px dashed black;" class="my-3"></div>
                            </div>

                            <?php if($loop->iteration == 5): ?>
                                <div>
                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                        <div class="d-flex align-items-center justify-content-start">
                                            
                                            <div>
                                                <h6 class="h6 m-0"><?php echo e($loop->remaining); ?> More
                                                    Lesson<?php echo e($loop->remaining > 1 ? 's' : ''); ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if($loop->iteration == 5) break; ?>
                            <!-- Modal -->
                            <div class="modal fade" tabindex="-1" id="preview<?php echo e($lesson->id); ?>"
                                aria-h6ledby="exampleModalh6" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe class="embed-responsive-item" src="<?php echo e($lesson->video_link); ?>"
                                                allowfullscreen></iframe>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="text-center py-3">
                                <p>No Data Available</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <img src="<?php echo e(str_starts_with($course->course_image, 'http') ? $course->course_image : asset('storage/' . $course->course_image)); ?>"
                    class="card-img-top" alt="course image">
                <div class="card-body">
                    <h2 class="font-weight-bolder text-black">
                        <?php echo e(!$course->amount ? 'Free' : $settings->currency . number_format($course->amount)); ?>

                    </h2>
                    <button class="btn btn-danger btn-lg py-3 btn-block rounded-none rounded-0" data-bs-toggle="modal"
                        data-bs-target="#buyModal">Buy Now</button>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="buyModal" tabindex="-1" aria-labelledby="buyModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="text-center">
                            <p class="mb-3">
                                <?php echo e(!$course->amount ? $settings->currency . '0' : $settings->currency . number_format($course->amount)); ?>

                                will be
                                deducted from your account balance.
                            </p>
                            <form action="<?php echo e(route('user.buycourse')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="amount" value="<?php echo e($course->amount); ?>">
                                <input type="hidden" name="course" value="<?php echo e($course->id); ?>">
                                <button type="submit" class="btn btn-primary btn-block">Purchase now</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mazibuckler/apps/sites/tradez/resources/views/user/membership/courseDetails.blade.php ENDPATH**/ ?>