<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.topmenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="main-panel ">
        <div class="content">
            <div class="page-inner">
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
                <div class="mt-2 mb-4">
                    <h1 class="title1 m-0">Trade Signals Settings</h1>
                    <p>Set trade signal subscription fees</p>
                </div>
                <div class="mb-5 row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-8 offset-lg-2">
                                        <form action="<?php echo e(route('save.settings')); ?>" method="post">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>
                                            <div class="form-group">
                                                <label for="">Monthly Fee (<?php echo e($settings->currency); ?>)</label>
                                                <input type="number" class="form-control"
                                                    value="<?php echo e($signalSettings->signal_monthly_fee); ?>" name="monthly"
                                                    id="">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Quaterly Fee (<?php echo e($settings->currency); ?>)</label>
                                                <input type="number" step="any"
                                                    value="<?php echo e($signalSettings->signal_quartly_fee); ?>" class="form-control"
                                                    name="quaterly">
                                            </div>
                                            <div class="form-group">
                                                <label for="">Yearly Fee (<?php echo e($settings->currency); ?>)</label>
                                                <input type="number" step="any"
                                                    value="<?php echo e($signalSettings->signal_yearly_fee); ?>" class="form-control"
                                                    name="yearly">
                                            </div>
                                            <div class="form-group">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <label for="">Chat ID</label>
                                                    <?php if($signalSettings->chat_id == ''): ?>
                                                        <a href="<?php echo e(route('chat.id')); ?>" class="btn btn-info btn-sm">Get
                                                            ID</a>
                                                    <?php else: ?>
                                                        <a href="<?php echo e(route('delete.id')); ?>"
                                                            class="btn btn-danger btn-sm">Delete
                                                            ID</a>
                                                    <?php endif; ?>
                                                </div>
                                                <input type="text" value="<?php echo e($signalSettings->chat_id); ?>"
                                                    class="form-control" name="chat_id" readonly>
                                                <?php if($signalSettings->chat_id == ''): ?>
                                                    <small>
                                                        Please make sure you have entered your telegram bot api and have
                                                        sent at least one message on your private channel. Also make sure
                                                        you have added the bot as an admin to the private channel, in order
                                                        to retrieve the chat ID.
                                                    </small>
                                                <?php endif; ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="">Telegram Bot Api</label>
                                                <input type="text" value="<?php echo e($signalSettings->telegram_bot_api); ?>"
                                                    class="form-control" name="telegram_bot_api">
                                                <p><a href="https://learn.microsoft.com/en-us/azure/bot-service/bot-service-channel-connect-telegram?view=azure-bot-service-4.0#create-a-new-telegram-bot-with-botfather"
                                                        target="_blank" class="mt-2 text-danger">
                                                        See How <i class="fa fa-link"></i>
                                                    </a> to create your telegram bot</p>
                                            </div>

                                            <div class="form-group">
                                                <button class="btn btn-primary px-4" type="submit">Save</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mazibuckler/apps/sites/tradez/resources/views/admin/signals/signalSettings.blade.php ENDPATH**/ ?>