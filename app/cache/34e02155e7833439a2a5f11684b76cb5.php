<?php $__env->startSection("main"); ?>
    <?php echo $__env->make('global.partials.loginForm', ['data' => $data], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("home", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/Rating-System/app/views/login.blade.php ENDPATH**/ ?>