<?php $__env->startSection("links"); ?>
    <li><a href="/">Home</a></li>
    <li><a href="/login">Login</a></li>
    <li><a href="/register">Register</a></li>
    
<?php $__env->stopSection(); ?>


<?php $__env->startSection("main"); ?>
    <h1>Hello from index</h1>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("global.base", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/rating_system/app/views/home.blade.php ENDPATH**/ ?>