<div>
    <!-- Page title -->
    <div class="page-title">
        <div class="row">
            <div class="mb-3 col-12 justify-content-between align-items-center d-flex">
                <div class="p-lg-4 p-2">
                    <h5 class="mb-0 text-white h3 font-weight-400">See All Course</h5>
                    <p class="text-white">Learning often happens in classrooms but it doesn’t have to. Use
                        <?php echo e($settings->site_name); ?> to facilitate
                        learning experiences no matter the context. </p>
                </div>
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
            <div class="row">
                <div class="col-12 mb-5">
                    <div class="w-100 mb-5">
                        <div class="d-flex justify-content-between align-items-center">
                            <div></div>
                            <div>
                                <a href="<?php echo e(route('user.mycourses')); ?>" class="btn btn-outline-light btn-sm">
                                    My Course(s)
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php if($courses): ?>
                        <?php $__empty_1 = true; $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="col-md-4">
                                <div class="card">
                                    <a
                                        href="<?php echo e(route('user.course.details', ['course' => str_replace(' ', '-', $item->course->course_title), 'id' => $item->course->id])); ?>">
                                        <img src="<?php echo e(str_starts_with($item->course->course_image, 'http') ? $item->course->course_image : asset('storage/' . $item->course->course_image)); ?>"
                                            class="card-img-top" alt="course image">
                                    </a>
                                    <div class="card-body">
                                        <a
                                            href="<?php echo e(route('user.course.details', ['course' => str_replace(' ', '-', $item->course->course_title), 'id' => $item->course->id])); ?>">
                                            <h5 class="font-weight-bolder"><?php echo e($item->course->course_title); ?></h5>
                                        </a>
                                        <div class="d-flex justify-content-between align-items-center mt-2">
                                            <div class="d-flex align-items-center">
                                                <i class="mr-1 fa fa-book"></i>
                                                <span>
                                                    <?php echo e(count($item->lessons)); ?>

                                                    <?php echo e(count($item->lessons) > 1 ? 'Lessons' : 'Lesson'); ?>

                                                </span>
                                            </div>
                                            <div class="d-flex align-items-center">
                                                <i class="fas fa-users mr-1"></i>
                                                <span>
                                                    <?php echo e(count($item->users)); ?>

                                                </span>
                                            </div>
                                        </div>
                                        <div style="border-top: 1px dashed black;" class="my-2 px-2"></div>
                                        <div class="d-flex align-items-center justify-content-between">

                                            <h3 class="font-weight-bolder text-danger">
                                                <?php echo e(!$item->course->amount ? 'Free' : $settings->currency . number_format(intval($item->course->amount))); ?>

                                            </h3>
                                            <a href="<?php echo e(route('user.course.details', ['course' => str_replace(' ', '-', $item->course->course_title), 'id' => $item->course->id])); ?>"
                                                class="btn btn-sm btn-outline-primary">Get</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body text-center py-2">
                                        <p>No Data Available</p>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="col-md-12">
                            
                        </div>
                        <div class="col-md-12 my-4">
                            <h5 class="mb-0 h3 font-weight-400">More Lessons</h5>
                        </div>
                        <div class="col-12">
                            <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <?php if(count($cat->lessons) > 0): ?>
                                    <div>
                                        <small class="mb-0">Category</small>
                                        <h2 class=" font-weight-bolder"><?php echo e($cat->category->category); ?></h2>
                                    </div>
                                    <?php $__currentLoopData = $cat->lessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $less): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($less->category): ?>
                                            <div class="card px-3">
                                                <div>
                                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                                        <div class="d-flex align-items-center justify-content-start">
                                                            <i class="fas fa-play-circle fa-2x text-danger mr-2"></i>
                                                            <div>
                                                                <h6 class="h6 m-0"><?php echo e($less->title); ?></h6>
                                                                <small
                                                                    class="text-muted d-block"><?php echo e($less->description); ?></small>
                                                                <small class="text-muted"><?php echo e($less->length); ?></small>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <a href="<?php echo e(route('user.learning', ['lesson' => $less->id])); ?>"
                                                                class="px-3 shadow bg-info text-white rounded-4 rounded-md">Watch</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="card text-center pt-3">
                                    <p>No Data Available</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <div class="card text-center py-5">
                            <p>No Data Available</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /Users/macbookair/Documents/Brynamics/OnlineTraderSoftware/onlinetrader/resources/views/livewire/user/system-courses.blade.php ENDPATH**/ ?>