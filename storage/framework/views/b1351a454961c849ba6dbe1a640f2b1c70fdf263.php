<?php $__env->startSection('title', $title); ?>
<?php $__env->startSection('content'); ?>
<?php $__env->startSection('styles'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('dash/css/stripeglobal.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('dash/css/stripenormalize.css')); ?>">
<?php $__env->stopSection(); ?>

<!-- Page title -->
<div class="page-title">
    <div class="row justify-content-between align-items-center">
        <div class="mb-3 col-md-6 mb-md-0">
            <h5 class="mb-0 text-white h3 font-weight-400">Make Payment</h5>
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
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="p-2 shadow-lg card p-md-4">
                            <div class="alert alert-modern alert-warning">
                                <span class="badge badge-warning badge-pill">
                                    Your payment method
                                </span>
                                <span class="alert-content"><?php echo e($payment_mode->name); ?></span>
                            </div>
                            <div class="card-body">
                                <?php if($title != 'Complete Payment'): ?>
                                    <?php
                                        if ($payment_mode->name == 'Bitcoin') {
                                            $coin = 'BTC';
                                        } elseif ($payment_mode->name == 'Litecoin') {
                                            $coin = 'LTC';
                                        } elseif ($payment_mode->name == 'Ethereum') {
                                            $coin = 'ETH';
                                        } elseif ($payment_mode->name == 'BUSD') {
                                            $coin = 'BUSD';
                                        } else {
                                            $coin = 'USDT.TRC20';
                                        }
                                    ?>
                                    <div>
                                        <h6 class="">You are to make payment of
                                            <strong><?php echo e($settings->currency); ?><?php echo e(number_format($amount)); ?></strong>
                                            using
                                            your selected payment method.
                                        </h6>
                                        <h4>
                                            <?php if(!empty($payment_mode->img_url)): ?>
                                                <img src="<?php echo e($payment_mode->img_url); ?>" alt="" class="w-25">
                                            <?php endif; ?>
                                        </h4>
                                    </div>

                                    <div class="mt-5">
                                        <?php if($settings->deposit_option != 'manual'): ?>
                                            <?php if(
                                                $payment_mode->name == 'Bitcoin' or
                                                    $payment_mode->name == 'Litecoin' or
                                                    $payment_mode->name == 'Ethereum' or
                                                    $payment_mode->name == 'USDT' or
                                                    $payment_mode->name == 'BUSD'): ?>
                                                <?php if(
                                                    $payment_mode->name == 'USDT' and
                                                        $settings->auto_merchant_option == 'Binance' and
                                                        $settings->deposit_option == 'auto'): ?>
                                                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('user.crypto-payment', [])->html();
} elseif ($_instance->childHasBeenRendered('d3KUyKI')) {
    $componentId = $_instance->getRenderedChildComponentId('d3KUyKI');
    $componentTag = $_instance->getRenderedChildComponentTagName('d3KUyKI');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('d3KUyKI');
} else {
    $response = \Livewire\Livewire::mount('user.crypto-payment', []);
    $html = $response->html();
    $_instance->logRenderedChild('d3KUyKI', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                                                <?php else: ?>
                                                    <a href="<?php echo e(url('dashboard/cpay')); ?>/<?php echo e($amount); ?>/<?php echo e($coin); ?>/<?php echo e(Auth::user()->id); ?>/new"
                                                        class="btn btn-primary">Pay Via Coinpayment</a>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <?php if((!empty($payment_mode->barcode) or $payment_mode->barcode != null) and $payment_mode->methodtype != 'currency'): ?>
                                                    <div class="text-center">
                                                        <img src="<?php echo e(asset('storage/' . $payment_mode->barcode)); ?>"
                                                            alt="" class="w-50">
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if($payment_mode->methodtype != 'currency'): ?>
                                            <?php if(
                                                ($payment_mode->name == 'Bitcoin' or
                                                    $payment_mode->name == 'Litecoin' or
                                                    $payment_mode->name == 'Ethereum' or
                                                    $payment_mode->name == 'USDT' or
                                                    $payment_mode->name == 'BUSD') and
                                                    $settings->deposit_option != 'manual'): ?>
                                            <?php else: ?>
                                                <h6 class="mt-4">
                                                    <strong><?php echo e($payment_mode->name); ?> Address:</strong>
                                                </h6>
                                                <div class="mb-3 form-group">
                                                    <input type="text" class="form-control readonly"
                                                        value="<?php echo e($payment_mode->wallet_address); ?>" readonly>
                                                    <small class=""><strong>Network Type:</strong>
                                                        <?php echo e($payment_mode->network); ?>

                                                    </small>
                                                </div>
                                            <?php endif; ?>
                                        <?php else: ?>
                                            <h3 class="">
                                                <strong><?php echo e($payment_mode->name); ?>:</strong>
                                            </h3>
                                            <?php if($payment_mode->defaultpay == 'yes'): ?>
                                                <?php if($payment_mode->name == 'Credit Card' and $settings->credit_card_provider == 'Paystack'): ?>
                                                    <?php $payamount = $amount * 100; ?>
                                                    
                                                    <div id="paystack">
                                                        <form method="POST" action="<?php echo e(route('pay.paystack')); ?>"
                                                            accept-charset="UTF-8" class="form-horizontal"
                                                            role="form">
                                                            <input type="hidden" name="email"
                                                                value="<?php echo e(Auth::user()->email); ?>">
                                                            <input type="hidden" name="amount"
                                                                value="<?php echo e($payamount); ?>">
                                                            <input type="hidden" name="currency"
                                                                value="<?php echo e($settings->s_currency); ?>">
                                                            <input type="hidden" name="metadata"
                                                                value="<?php echo e(json_encode($array = ['key_name' => 'value'])); ?>">
                                                            <input type="hidden" name="reference"
                                                                value="<?php echo e(Paystack::genTranxRef()); ?>">
                                                            <input type="hidden" name="_token"
                                                                value="<?php echo e(csrf_token()); ?>">
                                                            <p>
                                                                <button class="py-2 btn btn-primary" type="submit"
                                                                    value="Pay Now!">
                                                                    <i class="fa fa-credit-card fa-lg"></i> Pay with
                                                                    Card
                                                                </button>
                                                            </p>
                                                        </form>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if($payment_mode->name == 'Credit Card' and $settings->credit_card_provider == 'Flutterwave'): ?>
                                                    <div>
                                                        <form method="POST" action="<?php echo e(route('paybyflutterwave')); ?>">
                                                            <?php echo e(csrf_field()); ?>


                                                            <input type="hidden" name="name"
                                                                value="<?php echo e(Auth::user()->name); ?>" />
                                                            <input name="email" type="hidden"
                                                                value="<?php echo e(Auth::user()->email); ?>" />
                                                            <input name="phone" type="hidden"
                                                                value="<?php echo e(Auth::user()->phone); ?>" />
                                                            <input name="amount" type="hidden"
                                                                value="<?php echo e($amount); ?>" />

                                                            <button class="py-2 btn btn-primary" type="submit">
                                                                <i class="fa fa-credit-card fa-lg"></i>
                                                                Pay with Card
                                                            </button>
                                                        </form>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if($payment_mode->name == 'Credit Card' and $settings->credit_card_provider == 'Stripe'): ?>
                                                    <form id="payment-form" class="sr-payment-form">
                                                        <?php echo csrf_field(); ?>
                                                        <div class="sr-combo-inputs-row">
                                                            <div class="sr-input sr-card-element" id="card-element">
                                                            </div>
                                                        </div>

                                                        <button id="stripesubmit">
                                                            <div class="spinner d-none" id="spinner"></div>
                                                            <span id="buttontext" class="">Pay</span>
                                                        </button>
                                                    </form>

                                                    <div class="hidden row" id="stripesuccess">
                                                        <div class="col-lg-12">
                                                            <span>Payment Completed, redirecting.....</span>
                                                        </div>
                                                    </div>

                                                    <form id="selectform" method="POST" action="javascript:void(0)">
                                                        <?php echo csrf_field(); ?>
                                                        <input type="hidden" name="amount"
                                                            value="<?php echo e($amount); ?>">
                                                    </form>
                                                <?php endif; ?>
                                                <?php if($payment_mode->name == 'Paypal'): ?>
                                                    <div>
                                                        <?php echo $__env->make('includes.paypal', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if($payment_mode->name == 'Bank Transfer'): ?>
                                                    <?php if(!empty($payment_mode->bankname)): ?>
                                                        <div class="d-block">
                                                            <h5 class="">Bank Name</h5>
                                                        </div>
                                                        <div class="mb-3 input-group">
                                                            <input type="text" class="form-control readonly "
                                                                value="<?php echo e($payment_mode->bankname); ?>" readonly>
                                                            <div class="input-group-append">
                                                                <button class="btn btn-outline-secondary"
                                                                    onclick="myFunction()" type="button"
                                                                    id="button-addon2" disabled><i
                                                                        class="fas fa-copy"></i></button>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if(!empty($payment_mode->account_name)): ?>
                                                        <div class="d-block">
                                                            <h5 class="">Account Name</h5>
                                                        </div>
                                                        <div class="mb-3 input-group">
                                                            <input type="text" class="form-control readonly "
                                                                value="<?php echo e($payment_mode->account_name); ?>" readonly>
                                                            <div class="input-group-append">
                                                                <button class="btn btn-outline-secondary"
                                                                    onclick="myFunction()" type="button"
                                                                    id="button-addon2" disabled><i
                                                                        class="fas fa-copy"></i></button>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if(!empty($payment_mode->account_number)): ?>
                                                        <div class="d-block">
                                                            <h5 class="">Account Number</h5>
                                                        </div>
                                                        <div class="mb-3 input-group">
                                                            <input type="text" class="form-control readonly "
                                                                value="<?php echo e($payment_mode->account_number); ?>" readonly>
                                                            <div class="input-group-append">
                                                                <button class="btn btn-outline-secondary"
                                                                    onclick="myFunction()" type="button"
                                                                    id="button-addon2" disabled><i
                                                                        class="fas fa-copy"></i></button>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if(!empty($payment_mode->swift_code)): ?>
                                                        <div class="d-block">
                                                            <h5 class="">Swift Code</h5>
                                                        </div>
                                                        <div class="mb-3 input-group">
                                                            <input type="text" class="form-control readonly "
                                                                value="<?php echo e($payment_mode->swift_code); ?>" readonly>
                                                            <div class="input-group-append">
                                                                <button class="btn btn-outline-secondary"
                                                                    onclick="myFunction()" type="button"
                                                                    id="button-addon2" disabled><i
                                                                        class="fas fa-copy"></i></button>
                                                            </div>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <?php if(!empty($payment_mode->bankname)): ?>
                                                    <div class="d-block">
                                                        <h5 class="">Bank Name</h5>
                                                    </div>
                                                    <div class="mb-3 input-group">
                                                        <input type="text" class="form-control readonly "
                                                            value="<?php echo e($payment_mode->bankname); ?>" readonly>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-secondary"
                                                                onclick="myFunction()" type="button"
                                                                id="button-addon2" disabled><i
                                                                    class="fas fa-copy"></i></button>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if(!empty($payment_mode->account_name)): ?>
                                                    <div class="d-block">
                                                        <h5 class="">Account Name</h5>
                                                    </div>
                                                    <div class="mb-3 input-group">
                                                        <input type="text" class="form-control readonly "
                                                            value="<?php echo e($payment_mode->account_name); ?>" readonly>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-secondary"
                                                                onclick="myFunction()" type="button"
                                                                id="button-addon2" disabled><i
                                                                    class="fas fa-copy"></i></button>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if(!empty($payment_mode->account_number)): ?>
                                                    <div class="d-block">
                                                        <h5 class="">Account Number</h5>
                                                    </div>
                                                    <div class="mb-3 input-group">
                                                        <input type="text" class="form-control readonly "
                                                            value="<?php echo e($payment_mode->account_number); ?>" readonly>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-secondary"
                                                                onclick="myFunction()" type="button"
                                                                id="button-addon2" disabled><i
                                                                    class="fas fa-copy"></i></button>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if(!empty($payment_mode->swift_code)): ?>
                                                    <div class="d-block">
                                                        <h5 class="">Swift Code</h5>
                                                    </div>
                                                    <div class="mb-3 input-group">
                                                        <input type="text" class="form-control readonly "
                                                            value="<?php echo e($payment_mode->swift_code); ?>" readonly>
                                                        <div class="input-group-append">
                                                            <button class="btn btn-outline-secondary"
                                                                onclick="myFunction()" type="button"
                                                                id="button-addon2" disabled><i
                                                                    class="fas fa-copy"></i></button>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                    <?php if(
                                        $settings->deposit_option == 'auto' and $payment_mode->name == 'Bank Transfer' or
                                            $settings->deposit_option == 'auto' and $payment_mode->defaultpay != 'yes'): ?>
                                        <div>
                                            <form method="post" action="<?php echo e(route('savedeposit')); ?>"
                                                enctype="multipart/form-data">
                                                <?php echo csrf_field(); ?>
                                                <div class="form-group">
                                                    <p class="">Upload Payment proof after payment.</p>
                                                    <input type="file" name="proof"
                                                        class="form-control col-lg-8 " required>
                                                </div>
                                                <input type="hidden" name="amount" value="<?php echo e($amount); ?>">
                                                <input type="hidden" name="paymethd_method"
                                                    value="<?php echo e($payment_mode->name); ?>">

                                                <div class="form-group">
                                                    <input type="submit" class="btn btn-primary"
                                                        value="Submit Payment">
                                                </div>
                                            </form>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($settings->deposit_option == 'manual' and $payment_mode->name != 'Credit Card' and $payment_mode->name != 'Paypal'): ?>
                                        <div>
                                            <form method="post" action="<?php echo e(route('savedeposit')); ?>"
                                                enctype="multipart/form-data">
                                                <?php echo csrf_field(); ?>
                                                <div class="form-group">
                                                    <p class="">Upload Payment proof after payment.</p>
                                                    <input type="file" name="proof"
                                                        class="form-control col-lg-8 " required>
                                                </div>
                                                <input type="hidden" name="amount" value="<?php echo e($amount); ?>">
                                                <input type="hidden" name="paymethd_method"
                                                    value="<?php echo e($payment_mode->name); ?>">

                                                <div class="form-group">
                                                    <input type="submit" class="btn btn-primary"
                                                        value="Submit Payment">
                                                </div>
                                            </form>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                                
                                <?php if($title == 'Complete Payment'): ?>
                                    <div class="p-2 text-center p-md-5">
                                        <h4 class="">Send <?php echo e($amount); ?> to the below address or
                                            scan the <?php echo e($coin); ?> QR code to complete payment.</h4>
                                        <h4 class=""><strong><?php echo e($p_address); ?></strong></h4>
                                        <div>
                                            <img width="220" height="220" alt="Payment QR code"
                                                src="<?php echo e($p_qrcode); ?>">
                                        </div>
                                        <div class="mt-3">
                                            <small>you can exit this page after scanning and completed payment, the
                                                system will keep track of your payment and update your account
                                                accordingly </small>
                                        </div>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var stripe = Stripe("<?php echo e($settings->s_p_k); ?>");
    var elements = stripe.elements();
    var style = {
        base: {
            color: "#32325d",
        }
    };
    const paybtn = document.querySelector('#stripesubmit');
    console.log(paybtn);
    paybtn.disabled = true;

    var card = elements.create("card", {
        style: style
    });
    card.mount("#card-element");

    function checkcardforerrors() {
        card.on('change', function(event) {
            if (event.error) {
                swal("Error", event.error.message, "error");
                paybtn.disabled = true;
            } else {
                paybtn.disabled = false;
            }
        });
    }
    checkcardforerrors();

    var form = document.getElementById('payment-form');

    form.addEventListener('submit', function(ev) {
        paybtn.disabled = true;
        ev.preventDefault();
        checkcardforerrors();
        document.getElementById('spinner').classList.remove('d-none');
        document.getElementById('buttontext').classList.add('d-none');

        // If the client secret was rendered server-side as a data-secret attribute
        // on the <form> element, you can retrieve it here by calling `form.dataset.secret`
        var clientSecret = "<?php echo e($intent); ?>";
        stripe.confirmCardPayment(clientSecret, {
            payment_method: {
                card: card,
                billing_details: {
                    name: "<?php echo e(Auth::user()->name); ?>"
                }
            }
        }).then(function(result) {
            if (result.error) {
                swal("Error",
                    'There was an error processing your payment, Please try deposit again from deposit page',
                    "error");
                console.log(result.error.message);
            } else {
                // The payment has been processed!
                if (result.paymentIntent.status === 'succeeded') {
                    $.ajax({
                        url: "<?php echo e(url('/dashboard/submit-stripe-payment')); ?>",
                        type: 'POST',
                        data: $('#selectform').serialize(),
                        success: function(data) {
                            swal("Success", data.success, "success");
                            setTimeout(function() {
                                window.location.replace(
                                    "<?php echo e(route('accounthistory')); ?>");
                            }, 3000);
                        },
                        error: function(error) {
                            alert('Error Submiting Payment Data');
                            console.log(error);
                        },
                    });
                }
            }
        });

    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.dash', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/macbookair/Documents/Brynamics/OnlineTraderSoftware/onlinetrader/resources/views/user/payment.blade.php ENDPATH**/ ?>