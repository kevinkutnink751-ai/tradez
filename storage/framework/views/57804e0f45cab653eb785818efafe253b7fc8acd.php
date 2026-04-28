<form method="post" action="javascript:void(0)" id="updatewithdrawalinfo">
    <?php echo csrf_field(); ?>
    <?php echo method_field('PUT'); ?>
    <?php if($methods[3]->status == 'enabled'): ?>
        <fieldset>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="">Bank Name</label>
                    <input type="text" name="bank_name" value="<?php echo e(Auth::user()->bank_name); ?>" class="form-control "
                        placeholder="Enter bank name">
                </div>
                <div class="form-group col-md-6">
                    <label class="">Account Name</label>
                    <input type="text" name="account_name" value="<?php echo e(Auth::user()->account_name); ?>"
                        class="form-control " placeholder="Enter Account name">
                </div>
                <div class="form-group col-md-6">
                    <label class="">Account Number</label>
                    <input type="text" name="account_no" value="<?php echo e(Auth::user()->account_number); ?>"
                        class="form-control " placeholder="Enter Account Number">
                </div>
                <div class="form-group col-md-6">
                    <label class="">Swift Code</label>
                    <input type="text" name="swiftcode" value="<?php echo e(Auth::user()->swift_code); ?>" class="form-control "
                        placeholder="Enter Swift Code">
                </div>
            </div>
        </fieldset>
    <?php endif; ?>

    <fieldset class="mt-2">
        <div class="form-row">
            <?php if($methods[0]->status == 'enabled'): ?>
                <div class="form-group col-md-6">
                    <label class="">Bitcoin</label>
                    <input type="text" name="btc_address" value="<?php echo e(Auth::user()->btc_address); ?>"
                        class="form-control " placeholder="Enter Bitcoin Address">
                    <small class="">Enter your Bitcoin Address that will be used to withdraw your funds</small>
                </div>
            <?php endif; ?>
            <?php if($methods[1]->status == 'enabled'): ?>
                <div class="form-group col-md-6">
                    <label class="">Ethereum</label>
                    <input type="text" name="eth_address" value="<?php echo e(Auth::user()->eth_address); ?>"
                        class="form-control " placeholder="Enter Etherium Address">
                    <small class="">Enter your Ethereum Address that will be used to withdraw your funds</small>
                </div>
            <?php endif; ?>
            <?php if($methods[2]->status == 'enabled'): ?>
                <div class="form-group col-md-6">
                    <label class="">Litecoin</label>
                    <input type="text" name="ltc_address" value="<?php echo e(Auth::user()->ltc_address); ?>"
                        class="form-control " placeholder="Enter Litcoin Address">
                    <small class="">Enter your Litecoin Address that will be used to withdraw your funds</small>
                </div>
            <?php endif; ?>
            <?php if($methods[4]->status == 'enabled'): ?>
                <div class="form-group col-md-6">
                    <label>USDT.TRC20</label>
                    <input type="text" name="usdt_address" value="<?php echo e(Auth::user()->usdt_address); ?>"
                        class="form-control" placeholder="Enter USDT.TRC20 Address">
                    <small class="">Enter your USDT.TRC20 wallet Address that will be used to withdraw your
                        funds</small>
                </div>
            <?php endif; ?>
        </div>
    </fieldset>
    <button type="submit" class="px-5 btn btn-primary">Save</button>
</form>



<script>
    document.getElementById('updatewithdrawalinfo').addEventListener('submit', function() {
        // alert('love');
        $.ajax({
            url: "<?php echo e(route('updateacount')); ?>",
            type: 'POST',
            data: $('#updatewithdrawalinfo').serialize(),
            success: function(response) {
                if (response.status === 200) {
                    $.notify({
                        // options
                        icon: 'flaticon-alarm-1',
                        title: 'Success',
                        message: response.success,
                    }, {
                        // settings
                        type: 'success',
                        allow_dismiss: true,
                        newest_on_top: false,
                        showProgressbar: true,
                        placement: {
                            from: "top",
                            align: "right"
                        },
                        offset: 20,
                        spacing: 10,
                        z_index: 1031,
                        delay: 5000,
                        timer: 1000,
                        url_target: '_blank',
                        mouse_over: null,
                        animate: {
                            enter: 'animated fadeInDown',
                            exit: 'animated fadeOutUp'
                        },

                    });
                } else {

                }
            },
            error: function(data) {
                console.log(data);
            },

        });
    });
</script>
<?php /**PATH /Users/macbookair/Documents/Brynamics/OnlineTraderSoftware/onlinetrader/resources/views/profile/update-withdrawal-method.blade.php ENDPATH**/ ?>