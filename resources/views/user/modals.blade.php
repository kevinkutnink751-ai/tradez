<!-- Submit MT4 MODAL modal -->
<div id="submitmt4modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header ">
                <h4 class="modal-title ">Subscribe to subscription Trading</h4>
                <button type="button" class="close " data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body ">
                <form role="form" method="post" action="{{ route('savemt4details') }}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="">Subscription Duration</label>
                            <select class="form-control  " onchange="calcAmount(this)" name="duration" class="duration"
                                id="duratn">
                                <option value="default">Select duration</option>
                                <option>Monthly</option>
                                <option>Quaterly</option>
                                <option>Yearly</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="">Amount to Pay</label>
                            <input class="form-control subamount  " type="text" id="amount" disabled><br />

                        </div>
                        <div class="form-group col-md-6">
                            <label class=" ">Login*:</label>
                            <input class="form-control  " type="text" name="userid" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class=" ">Account Password*:</label>
                            <input class="form-control  " type="text" name="pswrd" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class=" ">Account Name*:</label>
                            <input class="form-control  " type="text" name="name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class=" ">Account Type:</label>
                            <input class="form-control  " Placeholder="E.g. Standard" type="text" name="acntype"
                                required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class=" ">Currency*:</label>
                            <input class="form-control  " Placeholder="E.g. USD" type="text" name="currency"
                                required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class=" ">Leverage*:</label>
                            <input class="form-control  " Placeholder="E.g. 1:500" type="text" name="leverage"
                                required>
                        </div>
                        <div class="form-group col-md-6">
                            <label class=" ">Server*:</label>
                            <input class="form-control  " Placeholder="E.g. HantecGlobal-live" type="text"
                                name="server" required>
                        </div>
                        <div class="form-group col-12">
                            <small class="">Amount will be deducted from your Account
                                balance</small>
                        </div>
                        <div class="form-group col-md-6">
                            <input id="amountpay" type="hidden" name="amount">
                            <input type="submit" class="btn btn-primary" value="Subscribe Now">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /plans Modal -->
<script type="text/javascript">
    function calcAmount(sub) {
        if (sub.value == "Quaterly") {
            var amount = document.getElementById('amount');
            var amountpay = document.getElementById('amountpay');
            amount.value = '<?php echo $settings->currency . $settings->quarterlyfee; ?>';
            amountpay.value = '<?php echo $settings->quarterlyfee; ?>';
        }
        if (sub.value == "Yearly") {
            var amount = document.getElementById('amount');
            var amountpay = document.getElementById('amountpay');
            amount.value = '<?php echo $settings->currency . $settings->yearlyfee; ?>';
            amountpay.value = '<?php echo $settings->yearlyfee; ?>';
        }
        if (sub.value == "Monthly") {
            var amount = document.getElementById('amount');
            var amountpay = document.getElementById('amountpay');
            amount.value = '<?php echo $settings->currency . $settings->monthlyfee; ?>';
            amountpay.value = '<?php echo $settings->monthlyfee; ?>';
        }
    }
</script>

<!-- Transfer Modal -->
<div id="transferModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: #11151d; border: 1px solid rgba(255,255,255,0.05);">
            <div class="modal-header border-bottom border-white-10">
                <h5 class="modal-title text-white font-weight-bold">Internal Transfer</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body p-4">
                <form id="internalTransferForm">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="form-group mb-3">
                        <label class="text-muted small">From</label>
                        <select name="from" class="form-control bg-dark border-secondary text-white">
                            <option value="account_bal">Funding Wallet</option>
                            <option value="spot_bal">Spot Wallet</option>
                            <option value="future_bal">Futures Wallet</option>
                        </select>
                    </div>
                    <div class="form-group mb-3 text-center">
                        <i class="fas fa-exchange-alt fa-2x text-primary" style="transform: rotate(90deg);"></i>
                    </div>
                    <div class="form-group mb-4">
                        <label class="text-muted small">To</label>
                        <select name="to" class="form-control bg-dark border-secondary text-white">
                            <option value="future_bal">Futures Wallet</option>
                            <option value="spot_bal">Spot Wallet</option>
                            <option value="account_bal">Funding Wallet</option>
                        </select>
                    </div>
                    <div class="form-group mb-4">
                        <label class="text-muted small">Amount (USDT)</label>
                        <div class="input-group bg-dark border-secondary rounded">
                            <input type="number" name="amount" class="form-control bg-transparent border-0 text-white" placeholder="0.00" step="any" required>
                            <div class="input-group-append">
                                <span class="input-group-text bg-transparent border-0 text-muted">USDT</span>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block py-3 font-weight-bold">CONFIRM TRANSFER</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('internalTransferForm')?.addEventListener('submit', function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        
        fetch("{{ route('internal.transfer') }}", {
            method: "POST",
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 200) {
                $.notify({
                    icon: 'fas fa-check-circle',
                    message: data.message
                }, {
                    type: 'success',
                    placement: { from: "top", align: "right" }
                });
                setTimeout(() => location.reload(), 1500);
            } else {
                $.notify({
                    icon: 'fas fa-exclamation-triangle',
                    message: data.message
                }, {
                    type: 'danger',
                    placement: { from: "top", align: "right" }
                });
            }
        });
    });
</script>
