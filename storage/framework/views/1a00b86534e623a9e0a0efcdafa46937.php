

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Edit Task</h1>
    <form action="<?php echo e(route('tasks.update', $task->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo e($task->title); ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" placeholder="Enter task description"><?php echo e($task->description); ?></textarea>
        </div>
        <div class="mb-3">
            <label for="due_date" class="form-label">Due Date</label>
            <input type="date" class="form-control" id="due_date" name="due_date" value="<?php echo e($task->due_date); ?>" required>
        </div>
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="status" name="status" value="1" <?php echo e($task->status ? 'checked' : ''); ?>>
            <label class="form-check-label" for="status">Mark as Complete</label>
        </div>
        <button type="submit" class="btn btn-success">Update Task</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DPK\task-manager\resources\views/tasks/edit.blade.php ENDPATH**/ ?>