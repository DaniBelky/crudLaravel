<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>CRUD Laravel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">CRUD Laravel</a>
    </div>
</nav>

<div class="container mt-4">

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    
    <form action="<?php echo e(route('usuarios.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="form-row">
            <div class="col">
                <input type="text" name="email" class="form-control" placeholder="Email" required>
            </div>
            <div class="col">
                <input type="password" name="senha" class="form-control" placeholder="Senha" required>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </div>
    </form>

    <hr>

    
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $usuarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $usuario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($usuario->id); ?></td>
                    <td><?php echo e($usuario->email); ?></td>
                    <td>
                        <!-- Botão Editar (abre modal) -->
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editarModal<?php echo e($usuario->id); ?>">
                            Editar
                        </button>

                        <!-- Form de Excluir -->
                        <form action="<?php echo e(route('usuarios.destroy', $usuario->id)); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Editar -->
                <div class="modal fade" id="editarModal<?php echo e($usuario->id); ?>" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <form action="<?php echo e(route('usuarios.update', $usuario->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Editar Usuário</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <input type="text" name="email" value="<?php echo e($usuario->email); ?>" class="form-control mb-2" required>
                                    <input type="password" name="senha" value="<?php echo e($usuario->senha); ?>" class="form-control mb-2" required>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
<?php /**PATH C:\Users\marco\projetoDePHP\projetoPHP\resources\views/Index.blade.php ENDPATH**/ ?>