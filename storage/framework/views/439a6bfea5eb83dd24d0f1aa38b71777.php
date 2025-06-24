<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>CRUD Laravel - Produtos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

<nav class="navbar navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">CRUD Laravel - Produtos</a>
    </div>
</nav>

<div class="container mt-4">

    <?php if(session('success')): ?>
        <div class="alert alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
    <form action="<?php echo e(route('produtos.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="form-row">
            <div class="col">
                <input type="text" name="nome" class="form-control" placeholder="Nome do Produto" required>
            </div>
            <div class="col">
                <input type="text" name="descricao" class="form-control" placeholder="Descrição do Produto">
            </div>
            <div class="col">
                <input type="number" name="quantidade_estoque" class="form-control" placeholder="Quantidade em Estoque" required>
            </div>
            <div class="col">
                <input type="number" name="preco" class="form-control" step="0.01" placeholder="Preço (R$)" required>
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
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Quantidade em Estoque</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $produtos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($produto->id); ?></td>
                    <td><?php echo e($produto->nome); ?></td>
                    <td><?php echo e($produto->descricao); ?></td>
                    <td><?php echo e($produto->quantidade_estoque); ?></td>
                    <td>R$ <?php echo e(number_format($produto->preco, 2, ',', '.')); ?></td>
                    <td>
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editarModal<?php echo e($produto->id); ?>">
                            Editar
                        </button>

                        <form action="<?php echo e(route('produtos.destroy', $produto->id)); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Confirma exclusão?')">Excluir</button>
                        </form>
                    </td>
                </tr>

                <div class="modal fade" id="editarModal<?php echo e($produto->id); ?>" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <form action="<?php echo e(route('produtos.update', $produto->id)); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Editar Produto</h5>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <input type="text" name="nome" value="<?php echo e($produto->nome); ?>" class="form-control mb-2" required>
                                    <input type="text" name="descricao" value="<?php echo e($produto->descricao); ?>" class="form-control mb-2">
                                    <input type="number" name="quantidade_estoque" value="<?php echo e($produto->quantidade_estoque); ?>" class="form-control mb-2" required>
                                    <input type="number" name="preco" value="<?php echo e($produto->preco); ?>" step="0.01" class="form-control mb-2" required>
                                </div>
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
<?php /**PATH C:\Users\belch\Downloads\projetoDePHP\projetoPHP\resources\views/produto.blade.php ENDPATH**/ ?>