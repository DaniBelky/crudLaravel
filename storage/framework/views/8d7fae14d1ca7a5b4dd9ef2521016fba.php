<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
</head>
<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f0f0f0;
        font-family: Arial, sans-serif;
        background-size: cover;
        backgound-position: center;
    }

    h1 {
        text-align: center;
        color: #493665
    }

    .container {
        width: 420px;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        text-align: center;
        box-shadow: 0 0 10px rgba(0, 0, 0, .2);
    }

    .input-group {
        position: relative;
        width: 100%;
        height: 50px;
        margin: 30px 0;
    }

    .input-group input {
        width: 90%;
        height: 100%;
        margin-left: 20px;
        background-color: transparent;
        border: 2px solid rgba(64, 62, 62, 0.2);
        border-radius: 40px;
        outline: none;
        font-size: 16px;
        color: black;
        padding: relative;

    }

    .input-group input::placeholder {
        color: rgb(201, 168, 222);
        padding-left: 10px;

    }


    .btn {
        width: 60%;
        height: 50px;
        background-color: #9260c5;
        border: none;
        border-radius: 40px;
        cursor: pointer;
        font-size: 16px;
        color: white;
        font-weight: 600;
        box-shadow: 0 0 20 rgba(0, 0, 0, .1);
        margin-top: 20px;
    }

    .btn:hover {
        background: transparent;
        border: 2px solid rgba(84, 84, 84, 0.2);
        color: #876b90;
        transition: 0.3s;
    }
</style>

<body>



    <div class="container">
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
            <div class="input-group">
                <input type="email" class="email" name="email" placeholder="Email"><br><br>
            </div>

            <div class="input-group">
                <input type="password" class="senha" name="senha" placeholder="Senha"><br><br>
            </div>
            <button type="submit" class="btn">Entrar</button>
        </form>
    </div>
</body>

</html><?php /**PATH C:\Users\marco\projetoDePHP\projetoPHP\resources\views/login.blade.php ENDPATH**/ ?>