<?php
if (Auth('admin')->User()->dashboard_style == 'light') {
    $text = 'dark';
    $bg = 'light';
} else {
    $text = 'light';
    $bg = 'dark';
}
?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.topmenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="main-panel ">
        <div class="content ">
            <div class="page-inner">
                <a href="<?php echo e(route('courses')); ?>" class="btn btn-info btn-sm">
                    <i class="fa fa-arrow-left"></i>
                    <span>Back</span>
                </a>
                <div class="mt-2 mb-3 d-lg-flex justify-content-lg-between">
                    <div>
                        <h1 class="title1 text-<?php echo e($text); ?> d-inline mr-4">Lessons </h1>
                        <h3 class="text-<?php echo e($text); ?> font-weight-bolder"><?php echo e($course->course_title); ?></h3>
                    </div>
                    <div class="mt-3 mt-lg-0">
                        <?php if($lessons and !count($lessons) == 0): ?>
                            <button class="btn btn-light shadow-sm px-3 border" type="button" data-toggle="modal"
                                data-target="#lessonModal">
                                <i class=" fa fa-plus"></i>
                                New Lesson
                            </button>
                        <?php endif; ?>
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

                <div class="mt-2 mb-5 row">

                    <?php $__empty_1 = true; $__currentLoopData = $lessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $less): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="col-md-4">
                            <div class="card ">
                                <img src="<?php echo e(str_starts_with($less->thumbnail, 'http') ? $less->thumbnail : asset('storage/' . $less->thumbnail)); ?>"
                                    class="card-img-top" alt="course image">
                                <div class="card-body">
                                    <h4 class="text-<?php echo e($text); ?> font-weight-bolder"><?php echo e($loop->iteration); ?>.
                                        <?php echo e($less->title); ?>

                                    </h4>
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <a href="#" class="btn btn-primary btn-sm px-2" data-toggle="modal"
                                            data-target="#lessonModal<?php echo e($less->id); ?>">Edit Lesson</a>

                                        <div class="d-flex align-items-center text-<?php echo e($text); ?>">
                                            <i class="mr-1 fa fa-clock"></i>
                                            <span> <?php echo e($less->length); ?></span>
                                        </div>
                                    </div>
                                    <a href="#" class="btn btn-danger btn-sm px-2 btn-block mt-3" data-toggle="modal"
                                        data-target="#lessonDeleteModal<?php echo e($less->id); ?>">Delete Lesson</a>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" tabindex="-1" id="lessonModal<?php echo e($less->id); ?>"
                            aria-h6ledby="exampleModalh6" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header ">
                                        <h3 class="mb-2 d-inline text-<?php echo e($text); ?>">Update Lesson</h3>
                                        <button type="button" class="close text-<?php echo e($text); ?>" data-dismiss="modal"
                                            aria-h6="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body ">
                                        <div>
                                            <form method="POST" action="<?php echo e(route('updatedlesson')); ?>"
                                                enctype="multipart/form-data">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PATCH'); ?>
                                                <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                        <h6 class="text-<?php echo e($text); ?>">Lesson Title</h6>
                                                        <input type="text"
                                                            class="form-control  text-<?php echo e($text); ?>"
                                                            value="<?php echo e($less->title); ?>" name="title" required>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <h6 class="text-<?php echo e($text); ?>">Description</h6>
                                                        <textarea name="desc" id="" cols="4" class="form-control  text-<?php echo e($text); ?>" required>
                                                            <?php echo e($less->description); ?>

                                                        </textarea>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <h6 class="text-<?php echo e($text); ?>">Video Link</h6>
                                                        <input type="text"
                                                            class="form-control  text-<?php echo e($text); ?>" name="videolink"
                                                            value="<?php echo e($less->video_link); ?>" required>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <h6 class="text-<?php echo e($text); ?>">Length of video</h6>
                                                        <input type="text"
                                                            class="form-control  text-<?php echo e($text); ?>" name="length"
                                                            value="<?php echo e($less->length); ?>" required>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <h6 class="text-<?php echo e($text); ?>">Allow Preview</h6>
                                                        <select name="preview"
                                                            class="form-control  text-<?php echo e($text); ?>">
                                                            <option value="<?php echo e($less->locked); ?>">
                                                                <?php echo e($less->locked); ?></option>
                                                            <option value="true">true</option>
                                                            <option value="false">false</option>
                                                        </select>
                                                        <small class="text-<?php echo e($text); ?>">If you want users to be
                                                            able to view this lesson before
                                                            purchase
                                                        </small>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <h6 class="text-<?php echo e($text); ?>">Lesson Thumbnail (File)</h6>
                                                        <input type="file"
                                                            class="form-control  text-<?php echo e($text); ?>" name="image">

                                                        <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                            <div class="alert alert-danger"><?php echo e($message); ?></div>
                                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <h6 class="text-<?php echo e($text); ?>">Lesson Thumbnail (Url)</h6>
                                                        <input type="text"
                                                            class="form-control  text-<?php echo e($text); ?>" name="image_url"
                                                            value="<?php echo e($less->thumbnail); ?>">
                                                    </div>
                                                    <h6 class="text-<?php echo e($text); ?>">
                                                        Use either file upload or url to
                                                        choose a lesson image, if both is entered, the file upload will be
                                                        used.
                                                    </h6>
                                                    <input type="hidden" value="<?php echo e($less->id); ?>" name="lesson_id">
                                                    <input type="hidden" value="<?php echo e($course->id); ?>" name="course_id">
                                                </div>
                                                <button type="submit" class="px-4 btn btn-primary">Update Lesson</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Modal -->
                        <div class="modal fade" tabindex="-1" id="lessonDeleteModal<?php echo e($less->id); ?>"
                            aria-h6ledby="exampleModalh6" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header ">
                                        <h3 class="mb-2 d-inline text-<?php echo e($text); ?>">Delete Lesson</h3>
                                        <button type="button" class="close text-<?php echo e($text); ?>"
                                            data-dismiss="modal" aria-h6="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body ">
                                        <div>
                                            <p class="text-<?php echo e($text); ?>">Are you sure you want delete this lesson?
                                            </p>
                                            <a href="<?php echo e(route('deletelesson', $less->id)); ?>"
                                                class="btn btn-danger">DELETE</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="col-md-12">
                            <div class="card  text-center py-3">
                                <h5 class="text-<?php echo e($text); ?>">No Lesson for this course</h5>
                                <div>
                                    <button class="btn btn-secondary px-3" data-toggle="modal"
                                        data-target="#lessonModal">Add Lesson</button>
                                </div>

                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" tabindex="-1" id="lessonModal" aria-h6ledby="exampleModalh6" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header ">
                        <h3 class="mb-2 d-inline text-<?php echo e($text); ?>">Add Lesson</h3>
                        <button type="button" class="close text-<?php echo e($text); ?>" data-dismiss="modal"
                            aria-h6="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body ">
                        <div>
                            <form method="POST" action="<?php echo e(route('addlesson')); ?>" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <h6 class="text-<?php echo e($text); ?>">Lesson Title</h6>
                                        <input type="text" class="form-control  text-<?php echo e($text); ?>"
                                            name="title" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <h6 class="text-<?php echo e($text); ?>">Description</h6>
                                        <textarea name="desc" id="" cols="4" class="form-control  text-<?php echo e($text); ?>" required></textarea>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <h6 class="text-<?php echo e($text); ?>">Video Link</h6>
                                        <input type="text" class="form-control  text-<?php echo e($text); ?>"
                                            name="videolink" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <h6 class="text-<?php echo e($text); ?>">Length of video</h6>
                                        <input type="text" class="form-control  text-<?php echo e($text); ?>"
                                            name="length" required>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <h6 class="text-<?php echo e($text); ?>">Allow Preview</h6>
                                        <div class="selectgroup">
                                            <label class="selectgroup-item">
                                                <input type="radio" value="true" class="selectgroup-input"
                                                    name="preview">
                                                <span class="selectgroup-button">Allow</span>
                                            </label>
                                            <label class="selectgroup-item">
                                                <input type="radio" value="false" class="selectgroup-input"
                                                    name="preview">
                                                <span class="selectgroup-button">Don't Allow</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <h6 class="text-<?php echo e($text); ?>">Lesson Thumbnail (File)</h6>
                                        <input type="file" class="form-control  text-<?php echo e($text); ?>"
                                            name="image">

                                        <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="alert alert-danger"><?php echo e($message); ?></div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>

                                    <div class="form-group col-md-12">
                                        <h6 class="text-<?php echo e($text); ?>">Lesson Thumbnail (Url)</h6>
                                        <input type="text" class="form-control  text-<?php echo e($text); ?>"
                                            name="image_url">
                                    </div>
                                    <h6 class="text-<?php echo e($text); ?>">Use either file upload or url to
                                        choose a lesson image, if both is entered, the file upload will be used.
                                    </h6>
                                    <input type="hidden" value="<?php echo e($course->id); ?>" name="course_id">
                                </div>
                                <button type="submit" class="px-4 btn btn-primary">Add Lesson</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mazibuckler/apps/sites/tradez/resources/views/admin/memebership/lessons.blade.php ENDPATH**/ ?>