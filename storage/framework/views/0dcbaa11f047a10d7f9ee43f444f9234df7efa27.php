<a href="#" data-toggle="modal" data-target="#testi" class="btn btn-primary"><i class="fa fa-plus"></i>
    Add Tesimonial</a>
<div id="testi" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header ">
                <h4 class="modal-title" style="text-align:center;">Add Testimony</h4>
                <button type="button" class="close " data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body ">
                <form action="<?php echo e(route('savetestimony')); ?>" method="post">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group">
                        <h5 class="">Testifier Name</h5>
                        <input type="text" name="testifier" placeholder="Full name" class="form-control  ">
                    </div>
                    <div class="form-group">
                        <h5 class=" ">Position</h5>
                        <input type="text" name="position" placeholder="System user or anonymus"
                            class="form-control  ">
                    </div>
                    <div class="form-group">
                        <h5 class=" ">What testifier said</h5>
                        <textarea name="said" class="form-control  " rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <h5 class=" ">Picture</h5>

                        <select name="picture" class="form-control  ">
                            <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option><?php echo e($item->img_path); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /Users/mazibuckler/apps/sites/tradez/resources/views/admin/Settings/FrontendSettings/testimony.blade.php ENDPATH**/ ?>