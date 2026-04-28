<!-- Renew Master account Modal -->
<div class="modal fade" id="renewModal<?php echo e($item->id); ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Renew
                    Master Account
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <h3>You will be charged $<?php echo e($amountPerSlot); ?> for
                    renewal.</h3>
                <form action="<?php echo e(route('renew.master')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="account_id" value="<?php echo e($item->id); ?>">
                    <button type="submit" class="btn btn-primary">
                        Yes Proceed
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Strategy Modal -->
<div class="modal fade" id="strategyModal<?php echo e($item->id); ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    Update Your strategy
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-left">
                <form action="<?php echo e(route('updatestrategy')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label>Strategy Name</label>
                        <input type="text" name="name" value="<?php echo e($item->strategy_name); ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Short Description</label>
                        <input type="text" name="desc" value="<?php echo e($item->strategy_description); ?>"
                            class="form-control">
                    </div>
                    <div class="form-group ">
                        <label for="">Trade Size Mode</label>
                        <select name="trademode" class="form-control py-2" id="trademode" required>
                            <option><?php echo e($item->strategy_mode); ?>

                            </option>
                            <option>none</option>
                            <option>contractSize</option>
                            <option>balance</option>
                            <option>equity</option>
                            <option>fixedVolume</option>
                            <option>fixedRisk</option>
                            <option>expression</option>
                        </select>
                    </div>
                    <div class=" form-group">
                        <textarea id="msgbox" cols="4" class="form-control" readonly></textarea>
                    </div>
                    <div class="form-group" id="optionSelected">
                        <label for="" id="optionTitle"></label>
                        <input type="text" name="modecompliment" value="<?php echo e($item->stra_com); ?>" class="form-control"
                            id="optionInput">
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="account_id" value="<?php echo e($item->id); ?>">
                        <button type="submit" class="btn btn-primary px-3">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /Users/mazibuckler/apps/sites/tradez/resources/views/admin/subscription/master/renew-master.blade.php ENDPATH**/ ?>