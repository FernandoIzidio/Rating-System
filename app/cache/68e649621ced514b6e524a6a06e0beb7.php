<?php $__env->startSection("links"); ?>
    <li><a href="/dashboard">Home</a></li>
    <li><a href="/dashboard/profile">Perfil</a></li>
    <li><a href="/dashboard/assessments">Avaliações</a></li>
    <li><a href="/dashboard/requests">Requisições</a></li>
<?php $__env->stopSection(); ?>


<?php echo $__env->make("global.base", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/Rating-System/app/views/Dashboard/dashboard.blade.php ENDPATH**/ ?>