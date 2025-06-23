<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>CRUD Laravel</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<style>
    /* Estilos gerais */
body {
    background-color: #f8f9fa;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #343a40;
}

/* Barra de navegação */
.navbar {
    padding: 0.8rem 0;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.navbar-brand {
    font-size: 1.5rem;
    letter-spacing: 0.5px;
}

/* Cards */
.card {
    border: none;
    border-radius: 0.5rem;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1) !important;
}

.card-header {
    border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    border-radius: 0.5rem 0.5rem 0 0 !important;
}

/* Formulários */
.form-control {
    border: 1px solid #ced4da;
    padding: 0.75rem 1rem;
    border-radius: 0.375rem !important;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

.form-control:focus {
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}

.input-group-text {
    background-color: #f8f9fa;
    border-right: none;
}

.input-group .form-control {
    border-left: none;
}

/* Botões */
.btn {
    padding: 0.75rem 1.5rem;
    border-radius: 0.375rem;
    font-weight: 500;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
}

.btn-primary {
    background-color: #4e73df;
    border-color: #4e73df;
}

.btn-primary:hover {
    background-color: #3a5ec0;
    border-color: #3a5ec0;
    transform: translateY(-1px);
}

/* Alertas */
.alert {
    border-radius: 0.5rem;
    padding: 1rem 1.5rem;
}

.alert-success {
    background-color: #d4edda;
    border-color: #c3e6cb;
    color: #155724;
}

/* Ícones */
.fas {
    margin-right: 8px;
}

/* Responsividade */
@media (max-width: 768px) {
    .navbar-brand {
        font-size: 1.25rem;
    }
    
    .form-row > .col {
        margin-bottom: 1rem;
    }
    
    .btn-block {
        width: 100%;
    }
}

</style>

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
<?php /**PATH C:\Users\marco\projetoDePHP\projetoPHP\resources\views/cadastro.blade.php ENDPATH**/ ?>