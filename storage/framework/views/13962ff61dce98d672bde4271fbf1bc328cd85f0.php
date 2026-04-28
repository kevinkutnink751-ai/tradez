<?php $__env->startSection('title', 'Create an Account'); ?>

<?php $__env->startSection('content'); ?>
    <section style="height: auto;" class="d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row p-md-5 py-5">
                <div class="col-lg-12">
                    <div class="card rounded login-page">
                        <div class="card-body">
                            <div class="row pl-md-3">
                                <div
                                    class="col-md-5 d-none d-lg-flex align-items-center justify-content-center bg-primary rounded">
                                    <div class="text-center">
                                        <h2 class="text-white mb-0">Let's get you set up</h2>
                                        <p class="text-white p-2">It should only take a couple of minute to create your
                                            account.</p>
                                        <img src="<?php echo e(asset('themes/purposeTheme/assets/img/account.webp')); ?>" alt=""
                                            class="w-75">
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="text-center">
                                        <a href="/">
                                            <img src="<?php echo e(asset('storage/app/public/' . $settings->logo)); ?>" alt="Logo"
                                                class="w-50">
                                        </a>
                                    </div>
                                    <div>
                                        <?php if(Session::has('status')): ?>
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <?php echo e(session('status')); ?>

                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        <?php endif; ?>

                                    </div>
                                    <form method="POST" action="<?php echo e(route('register')); ?>" class="mt-4 login-form">
                                        <?php echo csrf_field(); ?>
                                        <div class="form-row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Username <span class="text-danger">*</span></label>
                                                    <div class="position-relative">
                                                        <i data-feather="user" class="fea icon-sm icons"></i>
                                                        <input type="text" id="input1" class="pl-5 form-control"
                                                            name="username" id="input1"
                                                            placeholder="Enter Unique Username" required>
                                                        <?php if($errors->has('username')): ?>
                                                            <small
                                                                class="text-danger"><?php echo e($errors->first('username')); ?></small>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Full Name <span class="text-danger">*</span></label>
                                                    <div class="position-relative">
                                                        <i data-feather="user-check" class="fea icon-sm icons"></i>
                                                        <input type="text" class="pl-5 form-control" name="name"
                                                            value="<?php echo e(old('name')); ?>" id="f_name"
                                                            placeholder="Enter FullName" required>

                                                        <?php if($errors->has('name')): ?>
                                                            <small class="text-danger"><?php echo e($errors->first('name')); ?></small>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Email Address <span class="text-danger">*</span></label>
                                                    <div class="position-relative">
                                                        <i data-feather="mail" class="fea icon-sm icons"></i>
                                                        <input type="email" class="pl-5 form-control" name="email"
                                                            value="<?php echo e(old('email')); ?>" id="email"
                                                            placeholder="name@example.com" required>
                                                        <?php if($errors->has('email')): ?>
                                                            <small class="text-danger"><?php echo e($errors->first('email')); ?></small>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Phone Number <span class="text-danger">*</span></label>
                                                    <div class="position-relative">
                                                        <i data-feather="phone" class="fea icon-sm icons"></i>
                                                        <input type="phone" class="pl-5 form-control" name="phone"
                                                            value="<?php echo e(old('phone')); ?>" id="phone"
                                                            placeholder="Enter Phone number" required>
                                                        <?php if($errors->has('phone')): ?>
                                                            <small
                                                                class="text-danger"><?php echo e($errors->first('phone')); ?></small>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Password <span class="text-danger">*</span></label>
                                                    <div class="position-relative">
                                                        <i data-feather="key" class="fea icon-sm icons"></i>
                                                        <input type="password" class="pl-5 form-control" name="password"
                                                            id="password" placeholder="Enter Password" required>
                                                        <?php if($errors->has('password')): ?>
                                                            <small
                                                                class="text-danger"><?php echo e($errors->first('password')); ?></small>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Confirm Password <span class="text-danger">*</span></label>
                                                    <div class="position-relative">
                                                        <i data-feather="key" class="fea icon-sm icons"></i>
                                                        <input type="password" class="pl-5 form-control"
                                                            name="password_confirmation"
                                                            value="<?php echo e(old('password_confirmation')); ?>"
                                                            id="confirm-password" placeholder="Confirm Password" required>
                                                        <?php if($errors->has('password')): ?>
                                                            <small
                                                                class="text-danger"><?php echo e($errors->first('password')); ?></small>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Country <span class="text-danger">*</span></label>
                                                    <div class="position-relative">
                                                        <i data-feather="map-pin" class="fea icon-sm icons"></i>
                                                        <select
                                                            class="pl-5 d-block w-100 px-2 py-2 border border-light rounded-right"
                                                            name="country" id="country" required>
                                                            <option selected disabled>Choose Country</option>
                                                            <?php echo $__env->make('auth.countries', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                                                        </select>
                                                    </div>
                                                    <?php if($errors->has('country')): ?>
                                                        <small class="text-danger"><?php echo e($errors->first('country')); ?></small>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <?php if(Session::has('ref_by')): ?>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Referral ID <span class="text-danger">*</span></label>
                                                        <div class="position-relative">
                                                            <i data-feather="user" class="fea icon-sm icons"></i>
                                                            <input type="text" class="pl-5 form-control"
                                                                value="<?php echo e(session('ref_by')); ?>" name="ref_by"
                                                                placeholder="Optional referral id" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Referral ID</label>
                                                        <div class="position-relative">
                                                            <i data-feather="user" class="fea icon-sm icons"></i>
                                                            <input type="text" class="pl-5 form-control"
                                                                name="ref_by" placeholder="Optional referral id">
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>

                                            <?php if($settings->captcha == 'true'): ?>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <div
                                                            class="<?php echo e($errors->has('g-recaptcha-response') ? ' has-error' : ''); ?>">
                                                            <label>Captcha<span class="text-danger">*</span></label>
                                                            <div class="position-relative">
                                                                <?php echo NoCaptcha::display(); ?>

                                                                <?php if($errors->has('g-recaptcha-response')): ?>
                                                                    <span class="help-block">
                                                                        <strong><?php echo e($errors->first('g-recaptcha-response')); ?></strong>
                                                                    </span>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <?php if($terms->useterms == 'yes'): ?>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input"
                                                                id="customCheck1" required>
                                                            <label class="custom-control-label" for="customCheck1">I
                                                                Accept the <a href="<?php echo e(route('privacy')); ?>"
                                                                    class="text-primary">Terms And Privacy Policy</a>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>

                                            <!--end col-->

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <button class="btn btn-primary btn-block pad"
                                                        type="submit">Register</button>
                                                </div>
                                            </div>
                                            <?php if($settings->enable_social_login == 'yes'): ?>
                                                <div class="my-2 text-center col-lg-12">

                                                    <small>Or</small>
                                                    <div class="row">
                                                        <!--end col-->
                                                        <div class="col-12 my-3">
                                                            <a href="<?php echo e(route('social.redirect', ['social' => 'google'])); ?>"
                                                                class="login-with-google-btn">
                                                                <i class="mdi mdi-google text-danger"></i> Sign in with
                                                                Google</a>
                                                        </div>
                                                        <!--end col-->
                                                    </div>
                                                </div>
                                            <?php endif; ?>

                                            <div class="text-center col-12">
                                                <p class="mb-0"><small class="mr-2 text-dark">Already have an account
                                                    </small> <a href="<?php echo e(route('login')); ?>"
                                                        class="text-dark font-weight-bold">Login</a></p>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </form>
                                    <div class="text-center">
                                        <small class="text-dark" style="font-size: 11px">
                                            &copy; Copyright <?php echo e(date('Y')); ?> &nbsp; <?php echo e($settings->site_name); ?>

                                            &nbsp;
                                            All Rights Reserved.
                                        </small>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!---->
                </div>
                <!--end col-->
            </div>
            <!--end row-->
        </div>
        <!--end container-->
    </section>
    <!--end section-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('scripts'); ?>
    <script>
        $('#input1').on('keypress', function(e) {
            return e.which !== 32;
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mazibuckler/apps/sites/tradez/resources/views/auth/register.blade.php ENDPATH**/ ?>