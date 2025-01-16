

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Your Tasks</h1>

    <form method="GET" action="<?php echo e(route('tasks.index')); ?>" class="mb-3">
    <div class="row">
        <!-- Filter by Completion Status -->
        <div class="col-md-4">
            <select name="status" class="form-select">
                <option value="1,0" <?php echo e(request('status') == '1,0' ? 'selected' : ''); ?>>All Statuses</option>
                <option value="1" <?php echo e(request('status') == '1' ? 'selected' : ''); ?>>Complete</option>
                <option value="0" <?php echo e(request('status') == '0' ? 'selected' : ''); ?>>Incomplete</option>
            </select>
        </div>

        <!-- Sort by Due Date -->
        <div class="col-md-4">
            <select name="sort_by" class="form-select">
                <option value="due_date_asc" <?php echo e(request('sort_by') == 'due_date_asc' ? 'selected' : ''); ?>>Sort by Due Date (Ascending)</option>
                <option value="due_date_desc" <?php echo e(request('sort_by') == 'due_date_desc' ? 'selected' : ''); ?>>Sort by Due Date (Descending)</option>
            </select>
        </div>

        <div class="col-md-4">
            <button type="submit" class="btn btn-primary">Apply Filters</button>
        </div>
    </div>
</form>




    <!-- Create Task Button -->
    <a href="<?php echo e(route('tasks.create')); ?>" class="btn btn-success mb-3">Create New Task</a>

    <?php if($tasks->isEmpty()): ?>
        <p>No tasks found. You can <a href="<?php echo e(route('tasks.create')); ?>">create a new task</a>.</p>
    <?php else: ?>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Due Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($loop->iteration); ?></td>
                    <td><?php echo e($task->title); ?></td>
                    <td><?php echo e($task->description); ?></td>
                    <td><?php echo e($task->due_date); ?></td>
                    <td><?php echo e($task->status ? 'Complete' : 'Incomplete'); ?></td>
                    <td>
                        <a href="<?php echo e(route('tasks.edit', $task->id)); ?>" class="btn btn-sm btn-warning">Edit</a>
                        <form action="<?php echo e(route('tasks.destroy', $task->id)); ?>" method="POST" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DPK\task-manager\resources\views/tasks/index.blade.php ENDPATH**/ ?>