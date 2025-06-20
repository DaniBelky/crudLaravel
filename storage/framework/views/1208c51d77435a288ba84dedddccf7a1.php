<h1>Cadastrar Produto</h1>

<?php if($errors->any()): ?>
    <div style="color: red;">
        <ul>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li><?php echo e($error); ?></li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
<?php endif; ?>

<form action="<?php echo e(route('produtos.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <input type="text" name="nome" placeholder="Nome"><br>
    <textarea name="descricao" placeholder="Descrição"></textarea><br>
    <input type="number" name="preco" step="0.01" placeholder="Preço"><br>
    <input type="text" name="categoria" placeholder="Categoria"><br>
    <input type="number" name="estoque" placeholder="Estoque"><br>
    <button type="submit">Salvar</button>
</form>
<?php /**PATH C:\Users\marco\projetoDePHP\projetoPHP\resources\views/produtos/create.blade.php ENDPATH**/ ?>