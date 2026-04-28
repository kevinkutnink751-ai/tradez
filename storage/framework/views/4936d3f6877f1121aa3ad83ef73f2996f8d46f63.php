<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.topmenu', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="main-panel">
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
                <div class="mt-2 mb-4 d-flex justify-content-between align-items-center">
                    <h1 class="title1 ">Trade Signals</h1>
                    <div>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary btn-sm px-3" data-toggle="modal"
                            data-target="#exampleModal">
                            Add Signal
                        </button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add Signal</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body py-3">
                                        <form action="<?php echo e(route('postsignals')); ?>" method="post">
                                            <?php echo csrf_field(); ?>
                                            <div class="row">
                                                <div class="col-md-6 mt-3">
                                                    <label for="">Trade Direction</label>
                                                    <select name="direction" id=""
                                                        class=" form-control rounded-none py-3" required>
                                                        <option value="Sell">Sell</option>
                                                        <option value="Buy">Buy</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mt-3">
                                                    <label for="">Currency Pair</label>
                                                    <input type="text" name="pair"
                                                        class="form-control rounded-none py-3" placeholder="eg EUR/USD"
                                                        required>
                                                </div>
                                                <div class="col-md-6 mt-3">
                                                    <label for="">Price</label>
                                                    <input type="text" name="price"
                                                        class="form-control rounded-none py-3" placeholder="" required>
                                                </div>
                                                <div class="col-md-6 mt-3">
                                                    <label for="">Take Profit 1</label>
                                                    <input type="text" step="any" name="tp1"
                                                        class="form-control rounded-none py-3" id="" required>
                                                </div>
                                                <div class="col-md-6 mt-3">
                                                    <label for="">Take Profit 2</label>
                                                    <input type="text" step="any" name="tp2"
                                                        class="form-control rounded-none py-3" id="">
                                                </div>
                                                <div class="col-md-6 mt-3">
                                                    <label for="">Stop Loss</label>
                                                    <input type="text" step="any" name="sl1"
                                                        class="form-control rounded-none py-3" id="" required>
                                                </div>
                                                
                                                <div class="col-12 mt-3">
                                                    <button type="submit" class="btn btn-primary px-3">Add Signal</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-5 row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Signals</h5>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="bg-primary text-white">
                                            <th>
                                                Ref
                                            </th>
                                            <th>
                                                Trade Direction
                                            </th>
                                            <th>
                                                Currency Pair
                                            </th>
                                            <th>
                                                Price
                                            </th>
                                            <th>
                                                Take Profit-1
                                            </th>
                                            <th>
                                                Take Profit-2
                                            </th>
                                            <th>
                                                Stop Loss
                                            </th>
                                            
                                            <th>
                                                Result
                                            </th>
                                            <th>
                                                Status
                                            </th>
                                            <th>
                                                Date Added
                                            </th>
                                            <th>
                                            </th>
                                        </thead>
                                        <tbody>
                                            <?php $__empty_1 = true; $__currentLoopData = $signals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $signal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <tr>
                                                    <td>#<?php echo e($signal->reference); ?></td>
                                                    <td>
                                                        <?php if($signal->trade_direction == 'Buy'): ?>
                                                            <i class="fa fa-arrow-up text-success"></i>
                                                        <?php else: ?>
                                                            <i class="fa fa-arrow-down text-danger"></i>
                                                        <?php endif; ?>
                                                        <?php echo e($signal->trade_direction); ?>

                                                    </td>
                                                    <td><?php echo e($signal->currency_pair); ?></td>
                                                    <td><?php echo e($signal->price); ?></td>
                                                    <td><?php echo e($signal->take_profit1); ?></td>
                                                    <td><?php echo e($signal->take_profit2 ? $signal->take_profit2 : '-'); ?></td>
                                                    <td><?php echo e($signal->stop_loss1); ?></td>
                                                    
                                                    <td><?php echo e($signal->result ? $signal->result : '-'); ?></td>
                                                    <td>
                                                        <?php if($signal->status == 'published'): ?>
                                                            <span class="badge badge-success"> <?php echo e($signal->status); ?></span>
                                                        <?php else: ?>
                                                            <span class="badge badge-danger"> <?php echo e($signal->status); ?></span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?php echo e(\Carbon\Carbon::parse($signal->created_at)->addHour()->toDayDateTimeString()); ?>

                                                    </td>
                                                    <td>
                                                        <?php if($signal->status == 'unpublished'): ?>
                                                            <a href="<?php echo e(route('pubsignals', ['signal' => $signal->id])); ?>"
                                                                class="btn btn-info btn-sm m-1">
                                                                Publish
                                                            </a>
                                                        <?php else: ?>
                                                            <a href="#" class="btn btn-secondary btn-sm m-1"
                                                                data-toggle="modal"
                                                                data-target="#resultModal<?php echo e($signal->id); ?>">
                                                                Add Result
                                                            </a>
                                                        <?php endif; ?>

                                                        <a href="<?php echo e(route('delete.signal', ['signal' => $signal->id])); ?>"
                                                            class="btn btn-danger btn-sm m-1">
                                                            Delete
                                                        </a>
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="resultModal<?php echo e($signal->id); ?>"
                                                            tabindex="-1" aria-labelledby="exampleModalLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLabel">
                                                                            Update Signal Result
                                                                        </h5>
                                                                        <button type="button" class="close"
                                                                            data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="<?php echo e(route('updt.result')); ?>"
                                                                            method="post">
                                                                            <?php echo csrf_field(); ?>
                                                                            <?php echo method_field('PUT'); ?>
                                                                            <input type="hidden" name="signalId"
                                                                                value="<?php echo e($signal->id); ?>">
                                                                            <div class="form-group">
                                                                                <label for="">Result</label>
                                                                                <input type="text" name="result"
                                                                                    value="<?php echo e($signal->result); ?>"
                                                                                    class="form-control rounded-none py-3"
                                                                                    id="">
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <button type="submit"
                                                                                    class="btn btn-primary btn-sm">
                                                                                    Publish Result
                                                                                </button>
                                                                                <button type="button"
                                                                                    class="btn btn-danger btn-sm"
                                                                                    data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                    Cancel
                                                                                </button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                    <td colspan="10" class="text-center">
                                                        No Data Available
                                                    </td>
                                                </tr>
                                            <?php endif; ?>

                                        </tbody>
                                    </table>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mazibuckler/apps/sites/tradez/resources/views/admin/signals/tradeSignals.blade.php ENDPATH**/ ?>