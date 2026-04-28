<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e($settings->site_name); ?> | <?php echo $__env->yieldContent('title'); ?></title>

    <link rel="icon" href="<?php echo e(asset('storage/app/public/' . $settings->favicon)); ?>" type="image/png" />
    <?php $__env->startSection('styles'); ?>

        <link href="<?php echo e(asset('themes/purposeTheme/temp/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />
        <!-- Icons -->
        <link href="<?php echo e(asset('themes/purposeTheme/temp/css/materialdesignicons.min.css')); ?>" rel="stylesheet"
            type="text/css" />

        <link rel="stylesheet" href="<?php echo e(asset('themes/purposeTheme/temp/css/line.css')); ?>">
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <!-- Main Css -->
        <?php
            $theme = $settings->website_theme == 'purpose.css' ? 'default.css' : $settings->website_theme;
        ?>
        <link href="<?php echo e(asset('themes/purposeTheme/temp/css/style.css')); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo e(asset('themes/purposeTheme/temp/css/colors/' . $theme)); ?>" rel="stylesheet">
    <?php echo $__env->yieldSection(); ?>
</head>

<body class="bg-soft-primary">
    <?php echo $__env->yieldContent('content'); ?>

    <?php $__env->startSection('scripts'); ?>
        <script src="<?php echo e(asset('themes/purposeTheme/temp/js/jquery-3.5.1.min.js')); ?>"></script>
        <script src="<?php echo e(asset('themes/purposeTheme/temp/js/bootstrap.bundle.min.js')); ?>"></script>

        <!-- SLIDER -->
        <script src="<?php echo e(asset('themes/purposeTheme/temp/js/owl.carousel.min.js')); ?>"></script>
        <script src="<?php echo e(asset('themes/purposeTheme/temp/js/owl.init.js')); ?>"></script>
        <!-- Icons -->
        <script src="<?php echo e(asset('themes/purposeTheme/temp/js/feather.min.js')); ?>"></script>
        <script src="<?php echo e(asset('themes/purposeTheme/temp/js/bundle.js')); ?>"></script>

        <script src="<?php echo e(asset('themes/purposeTheme/temp/js/app.js')); ?>"></script>
        <script src="<?php echo e(asset('themes/purposeTheme/temp/js/widget.js')); ?>"></script>
    <?php echo $__env->yieldSection(); ?>
    <?php echo \Livewire\Livewire::scripts(); ?>

    <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.4/dist/livewire-turbolinks.js"
        data-turbolinks-eval="false" data-turbo-eval="false"></script>
</body>

</html>
<?php /**PATH /Users/macbookair/Documents/Brynamics/OnlineTraderSoftware/onlinetrader/resources/views/layouts/guest.blade.php ENDPATH**/ ?>