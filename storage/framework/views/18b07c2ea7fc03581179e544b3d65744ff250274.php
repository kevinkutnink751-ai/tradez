<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.topmenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="main-panel ">
        <div class="content ">
            <div class="page-inner">
                <div class="mt-2 mb-3 d-flex justify-content-between">
                    <div>
                        <h1 class="title1  d-inline mr-4">Courses</h1>
                        <p>List all the courses you have created.</p>
                    </div>
                    <div>
                        <button class="btn btn-light shadow-sm px-3 border" type="button" data-toggle="modal"
                            data-target="#adduser">
                            <i class=" fa fa-plus"></i>
                            Create New
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" tabindex="-1" id="adduser" aria-h6ledby="exampleModalh6"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header ">
                                        <h3 class="mb-2 d-inline ">Add Course</h3>
                                        <button type="button" class="close " data-dismiss="modal" aria-h6="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body ">
                                        <div>
                                            <form method="POST" action="<?php echo e(route('addcourse')); ?>"
                                                enctype="multipart/form-data">
                                                <?php echo csrf_field(); ?>
                                                <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                        <h6 class="">Course Category</h6>
                                                        <select name="category" id="" class="form-control  ">
                                                            <option value="Null">Null</option>

                                                            
                                                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($cat->category->category); ?>"><?php echo e($cat->category->category); ?>

                                                                </option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <h6 class="">Course Title</h6>
                                                        <input type="text" class="form-control  " name="title"
                                                            required>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <h6 class="">Description</h6>
                                                        <textarea name="desc" id="" cols="4" class="form-control  " required></textarea>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <h6 class="">Amount
                                                            <?php echo e($settings->currency); ?>

                                                        </h6>
                                                        <input type="number" class="form-control  " name="amount">
                                                        <span class=" mt-2"> Enter amount a user
                                                            can
                                                            pay to
                                                            get this course. If empty the course will
                                                            be available for free.
                                                        </span>
                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <h6 class="">Course Image (File)</h6>
                                                        <input type="file" class="form-control  " name="image">

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
                                                        <h6 class="">Course Image (Url)</h6>
                                                        <input type="text" class="form-control  " name="image_url">
                                                    </div>
                                                    <h6 class="">Use either file upload or url to
                                                        choose a course image, if both is entered, the file upload will be
                                                        used.
                                                    </h6>
                                                </div>
                                                <button type="submit" class="px-4 btn btn-primary">Add Course</button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
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

                <div class="mt-2 mb-5 row">
                    
                    <?php $__empty_1 = true; $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="col-md-4">
                            <div class="card ">
                                <img src="<?php echo e(str_starts_with($course->course->course_image, 'http') ? $course->course->course_image : asset('storage/' . $course->course->course_image)); ?>"
                                    class="card-img-top" alt="course image">
                                <div class="card-body">
                                    <h4 class=" font-weight-bolder">
                                        <?php echo e($course->course->course_title); ?>

                                    </h4>
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        <a href="#" class="btn btn-primary btn-sm px-2" data-toggle="modal"
                                            data-target="#editcourse<?php echo e($course->course->id); ?>">Edit Course</a>
                                        <a href="<?php echo e(route('lessons', $course->course->id)); ?>">
                                            <div class="d-flex align-items-center ">
                                                <i class="mr-1 fa fa-book"></i>
                                                <span>
                                                    <?php echo e(count($course->lessons)); ?>

                                                    <?php echo e(count($course->lessons) > 1 ? 'Lessons' : 'Lesson'); ?>

                                                </span>
                                                <i class="fa fa-share ml-1"></i>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="mt-3">
                                        <h2 class=" font-weight-bolder ">
                                            <?php echo e(!$course->course->amount ? 'Free' : $settings->currency . $course->course->amount); ?>

                                        </h2>
                                    </div>
                                    <a href="#" class="btn btn-danger btn-sm px-2 btn-block mt-3" data-toggle="modal"
                                        data-target="#courseDeleteModal<?php echo e($course->course->id); ?>">Delete
                                        Course</a>
                                </div>
                            </div>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" tabindex="-1" id="editcourse<?php echo e($course->course->id); ?>"
                            aria-h6ledby="exampleModalh6" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header ">
                                        <h3 class="mb-2 d-inline ">Update Course</h3>
                                        <button type="button" class="close " data-dismiss="modal" aria-h6="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body ">
                                        <div>
                                            <form method="POST" action="<?php echo e(route('updatecourse')); ?>"
                                                enctype="multipart/form-data">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PATCH'); ?>
                                                <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                        <h6 class="">Course Category</h6>
                                                        <select name="category" id="" class="form-control  ">
                                                            <option value="<?php echo e($course->course->category); ?>">
                                                                <?php echo e($course->course->category); ?></option>
                                                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($cat->category->category); ?>"><?php echo e($cat->category->category); ?>

                                                                </option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <h6 class="">Course Title</h6>
                                                        <input type="text" class="form-control  " name="title"
                                                            value="<?php echo e($course->course->course_title); ?>" required>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <h6 class="">Description</h6>
                                                        <textarea name="desc" id="" cols="4" class="form-control  " required>
                                                        <?php echo e($course->course->description); ?>

                                                        </textarea>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <h6 class="">Amount
                                                            <?php echo e($settings->currency); ?>

                                                        </h6>
                                                        <input type="number" class="form-control  " name="amount"
                                                            value="<?php echo e($course->course->amount); ?>">
                                                        <span class=" mt-2"> Enter amount a user
                                                            can
                                                            pay to
                                                            get this course. If empty the course will
                                                            be available for free.</span>

                                                    </div>

                                                    <div class="form-group col-md-12">
                                                        <h6 class="">Course Image (File)</h6>
                                                        <input type="file" class="form-control  " name="image">

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
                                                        <h6 class="">Course Image (Url)</h6>
                                                        <input type="text" class="form-control  " name="image_url"
                                                            value="<?php echo e($course->course->course_image); ?>">
                                                    </div>
                                                    <h6 class="">Use either file upload or url to
                                                        choose a course image, if both is entered, the file upload will be
                                                        used.
                                                    </h6>
                                                </div>
                                                <input type="hidden" name="course_id"
                                                    value="<?php echo e($course->course->id); ?>">
                                                <button type="submit" class="px-4 btn btn-primary">Update Course</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                        <!-- Modal -->
                        <div class="modal fade" tabindex="-1" id="courseDeleteModal<?php echo e($course->course->id); ?>"
                            aria-h6ledby="exampleModalh6" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header ">
                                        <h3 class="mb-2 d-inline ">Delete Course</h3>
                                        <button type="button" class="close " data-dismiss="modal" aria-h6="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body ">
                                        <div>
                                            <p class="">Are you sure you want delete this Course
                                                and it's related lessons?
                                            </p>
                                            <a href="<?php echo e(route('deletecourse', $course->course->id)); ?>"
                                                class="btn btn-danger">DELETE</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="col-md-12">
                            <div class="card  text-center py-5">
                                <h5 class="">No Course added</h5>
                                <div>
                                    <button class="btn btn-secondary px-3" data-toggle="modal" data-target="#adduser">Add
                                        Course</button>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mazibuckler/apps/sites/tradez/resources/views/admin/memebership/courses.blade.php ENDPATH**/ ?>