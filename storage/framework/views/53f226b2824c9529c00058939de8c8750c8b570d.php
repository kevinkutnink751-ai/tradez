<div>
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between mb-3">
                <div>
                    <h3>Upload new theme (zip file)</h3>
                    <p>Your new theme will be applied to users dashboard upon upload success.</p>
                </div>
                <div>
                    <button class="btn btn-outline-danger btn-sm" wire:click='clearCache'>
                        Clear Cache
                    </button>
                </div>

            </div>
            <div class="text-center">
                <form wire:submit.prevent='saveTheme'>
                    <input type="file" wire:model='theme' required>
                    <button type="submit" class="px-4 btn btn-primary btn-sm">Save</button>
                    <?php $__errorArgs = ['theme'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <span class="text-danger d-block mt-2"><?php echo e($message); ?></span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <?php if(session()->has('error')): ?>
                        <span class="text-danger d-block mt-2"><?php echo e(session('error')); ?></span>
                    <?php endif; ?>
                </form>
            </div>

        </div>
        <div class="mt-2" wire:loading wire:target='saveTheme'>
            <progress max="100"></progress>
            <p>Please wait while the theme is being uploaded, do not refresh this...</p>
        </div>
    </div>
    
    <?php if($settings->theme == 'purposeTheme'): ?>
        <hr>
        <div class="form-row mt-4">
            <div class="col-12">
                <h5 class="">Website theme colour. Double click to save.
                    Current theme colour have a blue border</h5>
            </div>
            <div class="col-md-4 p-2">
                <div class="flex-wrap btn-group-toggle d-flex justify-content-around" data-toggle="buttons">
                    <label
                        class="mb-2 shadow btn <?php echo e($settings->website_theme == 'purpose.css' ? 'active border border-primary rounded-lg' : ''); ?>"
                        wire:click="setTheme('purpose.css')">
                        <img src="<?php echo e(asset('dash/images/purpose.png')); ?>" alt="" class="img-fluid">
                        <input type="radio" name="theme" value="purpose.css" autocomplete="off">
                    </label>
                </div>
            </div>
            <div class="col-md-4 p-2">
                <div class="flex-wrap btn-group-toggle d-flex justify-content-around" data-toggle="buttons">
                    <label
                        class="mb-2 shadow btn <?php echo e($settings->website_theme == 'blue.css' ? 'active border border-primary' : ''); ?>"
                        wire:click="setTheme('blue.css')">
                        <img src="<?php echo e(asset('dash/images/blue.png')); ?>" class="img-fluid">
                        <input type="radio" name="theme" value="blue.css" autocomplete="off">
                    </label>
                </div>
            </div>
            <div class="col-md-4 p-2">
                <div class="flex-wrap btn-group-toggle d-flex justify-content-around" data-toggle="buttons">
                    <label
                        class="mb-2 shadow btn <?php echo e($settings->website_theme == 'green.css' ? 'active border border-primary' : ''); ?>"
                        wire:click="setTheme('green.css')">
                        <img src="<?php echo e(asset('dash/images/green.png')); ?>" class="img-fluid">
                        <input type="radio" name="theme" value="green.css" autocomplete="off">
                    </label>
                </div>
            </div>
            <div class="col-md-4 p-2">
                <div class="flex-wrap btn-group-toggle d-flex justify-content-around" data-toggle="buttons">
                    <label
                        class="mb-2 shadow btn <?php echo e($settings->website_theme == 'brown.css' ? 'active border border-primary' : ''); ?>"
                        wire:click="setTheme('brown.css')">
                        <img src="<?php echo e(asset('dash/images/brown.png')); ?>" class="img-fluid">
                        <input type="radio" name="theme" value="brown.css" autocomplete="off">
                    </label>
                </div>
            </div>
            <div class="col-md-4 p-2">
                <div class="flex-wrap btn-group-toggle d-flex justify-content-around" data-toggle="buttons">
                    <label
                        class="mb-2 shadow btn <?php echo e($settings->website_theme == 'dark.css' ? 'active border border-primary' : ''); ?>"
                        wire:click="setTheme('dark.css')">
                        <img src="<?php echo e(asset('dash/images/dark.png')); ?>" class="img-fluid">
                        <input type="radio" name="theme" value="dark.css" autocomplete="off">
                    </label>
                </div>
            </div>
        </div>
    <?php endif; ?>


</div>
<?php /**PATH /Users/macbookair/Documents/Brynamics/OnlineTraderSoftware/onlinetrader/resources/views/livewire/admin/theme-display.blade.php ENDPATH**/ ?>