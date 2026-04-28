 
 <div id="content" class="modal fade" role="dialog">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header ">
                 <h4 class="modal-title" style="text-align:center;">Add General Content</h4>
                 <button type="button" class="close " data-dismiss="modal">&times;</button>
             </div>
             <div class="modal-body ">
                 <form action="<?php echo e(route('savecontents')); ?>" method="post">
                     <?php echo e(csrf_field()); ?>

                     <div class="form-group">
                         <h5 class=" ">Title of Content</h5>
                         <input type="text" name="title" placeholder="Name of Content" class="form-control  "
                             required>
                     </div>
                     <div class="form-group">
                         <h5 class="">Content Description</h5>
                         <textarea name="content" placeholder="Describe the content" class="form-control  " rows="2" required></textarea>
                     </div>
                     <button type="submit" class="btn btn-primary">Save</button>
                 </form>

             </div>
         </div>
     </div>
 </div>
<?php /**PATH /Users/mazibuckler/apps/sites/tradez/resources/views/admin/Settings/FrontendSettings/content.blade.php ENDPATH**/ ?>