<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Welcome, <?php echo e(Auth::user()->name); ?>!</h1>
    <p>You are logged in.</p>

    <a href="<?php echo e(route('tasks.index')); ?>" class="btn btn-primary">View Your Tasks</a>

    <form method="POST" action="<?php echo e(route('logout')); ?>" class="mt-3">
        <?php echo csrf_field(); ?>
        <button type="submit" class="btn btn-danger">Logout</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\DPK\task-manager\resources\views/dashboard.blade.php ENDPATH**/ ?>