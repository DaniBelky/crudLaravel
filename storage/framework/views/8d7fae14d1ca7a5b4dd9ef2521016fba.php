<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>

    <?php if($errors->any()): ?>
        <div style="color:red;">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p><?php echo e($error); ?></p>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="<?php echo e(route('login')); ?>">
        <?php echo csrf_field(); ?>
        <input type="email" name="email" placeholder="Email"><br><br>
        <input type="password" name="senha" placeholder="Senha"><br><br>
        <button type="submit">Entrar</button>
    </form>
</body>
</html>
<?php /**PATH C:\Users\marco\projetoDePHP\projetoPHP\resources\views/login.blade.php ENDPATH**/ ?>