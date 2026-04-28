<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.topmenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="main-panel ">
        <div class="content ">
            <div class="page-inner">
                <div class="mt-2 mb-4">
                    <h1 class="title1 ">Edit Front page of your website</h1>
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

                <?php if(count($errors) > 0): ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-danger alert-dismissable" role="alert">
                                <button type="button" class="close" data-dismiss="alert"
                                    aria-hidden="true">&times;</button>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <i class="fa fa-warning"></i> <?php echo e($error); ?>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="mb-5 row">
                    <div class="p-3 col-12">
                        <?php echo $__env->make('admin.Settings.FrontendSettings.faqs', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('admin.Settings.FrontendSettings.testimony', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('admin.Settings.FrontendSettings.images', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('admin.Settings.FrontendSettings.content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                    <div class="col-12">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="mb-2 nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#1"
                                    role="tab" aria-controls="nav-home" aria-selected="true">
                                    FAQ(S)</a>

                                <a class="mb-2 nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#2"
                                    role="tab" aria-controls="nav-profile" aria-selected="false">TESTIMONIALS</a>

                                <a class="mb-2 nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#3"
                                    role="tab" aria-controls="nav-contact" aria-selected="false">WEBSITE CONTENTS</a>

                                <a class="mb-2 nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#4"
                                    role="tab" aria-controls="nav-about" aria-selected="false">IMAGES</a>
                            </div>
                        </nav>


                        <div class="px-3 py-3 tab-content px-sm-0" id="nav-tabContent">
                            
                            <div class="tab-pane fade show active p-3" id="1" role="tabpanel"
                                aria-labelledby="nav-home-tab">
                                <div class="boxes">
                                    <div class="row">
                                        <?php $__empty_1 = true; $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <div class="p-1 col-md-4">
                                                <div class="card border p-1 ">
                                                    <div class="card-body">
                                                        <h5 class="card-title "><strong><?php echo e($faq->question); ?></strong>
                                                        </h5>
                                                        <p class="card-text "><?php echo e($faq->answer); ?></p>
                                                        <a href="<?php echo e(url('admin/dashboard/delfaq')); ?>/<?php echo e($faq->id); ?>"
                                                            type="button" data-toggle="tooltip" title=""
                                                            class="btn btn-sm btn-danger" data-original-title="Remove"><i
                                                                class="fa fa-times"></i></a> &nbsp;
                                                        <a href="#" data-toggle="modal"
                                                            data-target="#editfaq<?php echo e($faq->id); ?>"
                                                            class="btn btn-primary btn-sm">Edit</a>
                                                    </div>
                                                </div>
                                            </div>

                                            <div id="editfaq<?php echo e($faq->id); ?>" class="modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header ">
                                                            <h4 class="modal-title" style="text-align:center;">Update Faq
                                                            </h4>
                                                            <button type="button" class="close "
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body ">
                                                            <form action="<?php echo e(route('updatefaq')); ?>" method="post">
                                                                <?php echo e(csrf_field()); ?>

                                                                <div class="form-group">
                                                                    <h5 class="">Question</h5>
                                                                    <input type="text" name="question"
                                                                        value="<?php echo e($faq->question); ?>"
                                                                        placeholder="Enter the Question here"
                                                                        class="form-control  " required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <h5 class="">Answer</h5>
                                                                    <textarea name="answer" placeholder="Enter the Answer to the question above" class="form-control  " rows="4"
                                                                        required><?php echo e($faq->answer); ?></textarea>
                                                                </div>
                                                                <input type="hidden" name="id"
                                                                    value="<?php echo e($faq->id); ?>">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Update</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <div class="col-12">
                                                <div class="card border">
                                                    <div class="card-body text-center">
                                                        <h5>No Data Available</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            </div>

                            
                            <div class="tab-pane fade p-3" id="2" role="tabpanel"
                                aria-labelledby="nav-profile-tab">
                                <div class="boxes">
                                    <div class="row">
                                        <?php $__empty_1 = true; $__currentLoopData = $testimonies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <div class="p-1 col-md-4">
                                                <div class="card border p-1 ">
                                                    <div class="card-body">

                                                        <h5 class="card-title "><strong><?php echo e($faq->name); ?></strong> </h5>
                                                        <p class="card-text "><?php echo e($faq->what_is_said); ?></p>
                                                    </div>
                                                    <ul class="list-group list-group-flush ">
                                                        <li class="list-group-item  ">
                                                            <?php echo e($faq->position); ?></li>
                                                        <li class=" list-group-item ">
                                                            <?php echo e($faq->picture); ?></li>
                                                    </ul>
                                                    <div class="card-body">
                                                        <a href="<?php echo e(url('admin/dashboard/deltestimony')); ?>/<?php echo e($faq->id); ?>"
                                                            type="button" data-toggle="tooltip" title=""
                                                            class="btn btn-sm btn-danger" data-original-title="Remove"><i
                                                                class="fa fa-times"></i></a> &nbsp; &nbsp;
                                                        <a href="#" data-toggle="modal"
                                                            data-target="#edittes<?php echo e($faq->id); ?>"
                                                            class="btn btn-primary btn-sm">Edit</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="edittes<?php echo e($faq->id); ?>" class="modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header ">
                                                            <h4 class="modal-title" style="text-align:center;">Update
                                                                Testimony</h4>
                                                            <button type="button" class="close "
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body ">
                                                            <form action="<?php echo e(route('updatetestimony')); ?>" method="post">
                                                                <?php echo e(csrf_field()); ?>

                                                                <div class="form-group">
                                                                    <h5 class="">Testifier Name</h5>
                                                                    <input type="text" name="testifier"
                                                                        placeholder="Full name"
                                                                        value="<?php echo e($faq->name); ?>"
                                                                        class="form-control  ">
                                                                </div>
                                                                <div class="form-group">
                                                                    <h5 class=" ">Position</h5>
                                                                    <input type="text" name="position"
                                                                        value="<?php echo e($faq->position); ?>"
                                                                        placeholder="System user or anonymus"
                                                                        class="form-control  ">
                                                                </div>
                                                                <div class="form-group">
                                                                    <h5 class=" ">What testifier said</h5>
                                                                    <textarea name="said" class="form-control  " rows="4"><?php echo e($faq->what_is_said); ?></textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <h5 class=" ">Picture</h5>
                                                                    <select name="picture" class="form-control  ">
                                                                        <option value="<?php echo e($faq->picture); ?>">
                                                                            <?php echo e($faq->picture); ?></option>
                                                                        <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option><?php echo e($item->img_path); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>
                                                                <input type="hidden" name="id"
                                                                    value="<?php echo e($faq->id); ?>">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Update</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <div class="col-12">
                                                <div class="card border">
                                                    <div class="card-body text-center">
                                                        <h5>No Data Available</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="tab-pane fade p-3" id="3" role="tabpanel"
                                aria-labelledby="nav-contact-tab">
                                <div class="boxes">
                                    <div class="row">
                                        <?php $__empty_1 = true; $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <div class="p-1 col-md-3">
                                                <div class="card border p-1 ">
                                                    <div class="card-body">
                                                        <h5 class="card-title "><strong><?php echo e($faq->title); ?></strong> </h5>
                                                        <p class="card-text "><?php echo e($faq->description); ?></p>

                                                        <a href="#" data-toggle="modal"
                                                            data-target="#editcont<?php echo e($faq->id); ?>"
                                                            class="btn btn-primary btn-sm">Edit</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="editcont<?php echo e($faq->id); ?>" class="modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header ">
                                                            <h4 class="modal-title" style="text-align:center;">Update
                                                                General Content</h4>
                                                            <button type="button" class="close "
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body ">
                                                            <form action="<?php echo e(route('updatecontents')); ?>" method="post">
                                                                <?php echo e(csrf_field()); ?>

                                                                <div class="form-group">
                                                                    <h5 class=" ">Title of Content</h5>
                                                                    <input type="text" name="title"
                                                                        placeholder="Name of Content"
                                                                        value="<?php echo e($faq->title); ?> "
                                                                        class="form-control  " required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <h5 class="">Content Description</h5>
                                                                    <textarea name="content" placeholder="Describe the content" class="form-control  " rows="2" required><?php echo e($faq->description); ?></textarea>
                                                                </div>
                                                                <input type="hidden" name="id"
                                                                    value="<?php echo e($faq->id); ?>">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Update</button>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <div class="col-12">
                                                <div class="card border">
                                                    <div class="card-body text-center">
                                                        <h5>No Data Available</h5>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            </div>

                            
                            <div class="tab-pane fade p-3" id="4" role="tabpanel"
                                aria-labelledby="nav-about-tab">
                                <div class="boxes">
                                    <div class="row">
                                        <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="p-1 col-md-4">
                                                <div class="card border p-1 ">
                                                    <img src="<?php echo e(asset('storage/app/public/' . $faq->img_path)); ?>"
                                                        class="card-img-top w-50" alt="Image">

                                                    <div class="card-body">
                                                        <h5 class="card-title "><strong><?php echo e($faq->title); ?></strong> </h5>
                                                        <p class="card-text "><?php echo e($faq->description); ?></p>
                                                    </div>
                                                    <div class="card-body">
                                                        <a href="#" data-toggle="modal"
                                                            data-target="#editimg<?php echo e($faq->id); ?>"
                                                            class="btn btn-primary btn-sm">Edit</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="editimg<?php echo e($faq->id); ?>" class="modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header ">
                                                            <h4 class="modal-title" style="text-align:center;">Update
                                                                Image</h4>
                                                            <button type="button" class="close "
                                                                data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <div class="modal-body ">
                                                            <form action="<?php echo e(route('updateimg')); ?>" method="post"
                                                                enctype="multipart/form-data">
                                                                <?php echo e(csrf_field()); ?>

                                                                <div class="form-group">
                                                                    <h5 class="">Title of Image</h5>
                                                                    <input type="text" name="img_title"
                                                                        value="<?php echo e($faq->title); ?>"
                                                                        placeholder="Name of Image"
                                                                        class="form-control  ">
                                                                </div>
                                                                <div class="form-group">
                                                                    <h5 class="">Images Description</h5>
                                                                    <textarea name="img_desc" placeholder="Describe the image" class="form-control  " rows="2"><?php echo e($faq->description); ?></textarea>
                                                                </div>
                                                                <div class="form-group">
                                                                    <h5 class="">Image</h5>
                                                                    <input name="image" class="form-control  "
                                                                        type="file">
                                                                </div>
                                                                <input type="hidden" name="id"
                                                                    value="<?php echo e($faq->id); ?>">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Update</button>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mazibuckler/apps/sites/tradez/resources/views/admin/Settings/FrontendSettings/frontpage.blade.php ENDPATH**/ ?>