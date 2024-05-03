<?php $__env->startSection('content'); ?>
<div class="card alturabloque">
    <header class="card-header">
        <p class="card-header-title">
            Edificios y Salones
        </p>
    </header>
    <div class="card-content">

        <div class="column buttons ">
            <a href="<?php echo e(route('home')); ?>" class="button is-danger"><i class="fa-solid fa-arrow-left"></i>Regresar</a>
            <button class="button is-info js-modal-trigger" data-target="modal-nvo-edificio"><i class="fa-solid fa-plus"></i>Nuevo Edificio</button>
            <button class="button is-info js-modal-trigger" data-target="modal-nvo-salon"><i class="fa-solid fa-plus"></i>Nuevo Salon</button>
        </div>

        <?php if(session('Correcto')): ?>
        <div class="notification is-success">
            <button class="delete"></button>
            <?php echo e(session('Correcto')); ?>

        </div>
        <?php endif; ?>
        <?php if(session('Error')): ?>
        <div class="notification is-danger">
            <button class="delete"></button>
            <?php echo e(session('Error')); ?>

        </div>
        <?php endif; ?>

        <div class="columns is-multiline is-mobile">
            <div class="column is-6-desktop is-6-tablet is-12-mobile">
                <!-- Primera card -->
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            Edificios
                        </p>
                    </header>
                    <div class="card-content">
                        <div class="columns is-multiline is-mobile">
                        </div>
                        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                            <thead>
                                <tr class="has-text-centered">
                                    <th>NOMBRE EDIFICIO</th>
                                    <th>DESCRIPCION</th>
                                    <th>OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $edificios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($item->nombre_edificio); ?></td>
                                    <td><?php echo e($item->descripcion); ?></td>

                                    <td>
                                        <div class="field is-grouped">
                                            <button class="button is-success js-modal-trigger" data-target="modal-<?php echo e($item->nombre_edificio); ?>"><i class="fa-solid fa-pen-to-square"></i></button>
                                            <form action="<?php echo e(route('EdificioEliminar', $item->id)); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="button is-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este Edificio?')">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </div>
                                        <div id="modal-<?php echo e($item->nombre_edificio); ?>" class="modal">
                                            <div class="modal-background"></div>
                                            <div class="modal-content">
                                                <div class="box">
                                                    <p class="title is-5 has-text-centered">Modificar Edificio</p>
                                                    <form method="POST" action="<?php echo e(route('EdificioEditar', $item->id)); ?>">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('PATCH'); ?>
                                                        <div class="field is-4">
                                                            <label class="label">Nombre Edificio</label>
                                                            <input class="input" value="<?php echo e($item->nombre_edificio); ?>" name="UpNombreEdificio">
                                                        </div>
                                                        <div class="field is-4">
                                                            <label class="label">Descripcion Edificio</label>
                                                            <input class="input" value="<?php echo e($item->descripcion); ?>" name="UpDescripcionEdificio">
                                                        </div>
                                                        <div class="has-text-centered">
                                                            <button class="button is-primary" type="submit">Modificar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <button class="modal-close is-large" aria-label="close"></button>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="column is-6-desktop is-6-tablet is-12-mobile">
                <!-- Segunda card -->
                <div class="card">
                    <header class="card-header">
                        <p class="card-header-title">
                            Salones
                        </p>
                    </header>
                    <div class="card-content">
                        <div class="columns is-multiline is-mobile">
                        </div>
                        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                            <thead>
                                <tr class="has-text-centered">
                                    <th>NOMBRE SALON</th>
                                    <th>ID EDIFICIO</th>
                                    <th>OPCIONES</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $salones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $salon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($salon->nombre_salon); ?></td>
                                    <td><?php echo e($salon->edificio->nombre_edificio); ?></td>

                                    <td>
                                        <div class="field is-grouped">
                                            <button class="button is-success js-modal-trigger" data-target="modal-<?php echo e($salon->nombre_salon); ?>"><i class="fa-solid fa-pen-to-square"></i></button>
                                            <form action="<?php echo e(route('SalonesEliminar', $salon->id)); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="button is-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este SALON?')">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </form>
                                        </div>
                                        <div id="modal-<?php echo e($salon->nombre_salon); ?>" class="modal">
                                            <div class="modal-background"></div>
                                            <div class="modal-content">
                                                <div class="box">
                                                    <p class="title is-5 has-text-centered">Modificar Salon</p>
                                                    <form method="POST" action="<?php echo e(route('SalonesEditar', $salon->id)); ?>">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('PATCH'); ?>
                                                        <div class="field is-4">
                                                            <label class="label">Nombre Salon</label>
                                                            <input class="input" value="<?php echo e($salon->nombre_salon); ?>" name="UpNombreSalon">
                                                        </div>
                                                        <div class="field is-4">
                                                            <label class="label">Edificio Id</label>
                                                            <input class="input" value="<?php echo e($salon->edificio_id); ?>" name="UpEdificioIdSalon">
                                                        </div>
                                                        <div class="has-text-centered">
                                                            <button class="button is-primary" type="submit">Modificar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <button class="modal-close is-large" aria-label="close"></button>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal crear nuevo edificio -->
        <div id="modal-nvo-edificio" class="modal">
            <div class="modal-background"></div>

            <div class="modal-content">
                <div class="box">
                    <p class="title is-5 has-text-centered">Agregar Edificio</p>
                    <form method="POST" action="<?php echo e(route('EdificioCrear')); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('POST'); ?>
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">Nombre del Edificio:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name="txtNombreEdif" value="<?php echo e(old('txtNombreEdif')); ?>">
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-key"></i>
                                    </span>
                                </div>
                                <?php $__errorArgs = ['txtNombreEdif'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="help is-danger">Ingresa el Nombre del Edificio</p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">Descripción del Edificio:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name="txtDescripcionEdif" value="<?php echo e(old('txtDescripcionEdif')); ?>">
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </span>
                                </div>
                                <?php $__errorArgs = ['txtDescripcionEdif'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="help is-danger">Ingresa la descripción del Edificio</p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="has-text-centered">
                            <button class="button is-primary" type="submit"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Guardar</button>
                        </div>
                    </form>
                </div>
            </div>

            <button class="modal-close is-large" aria-label="close"></button>
        </div>

        <!-- Modal crear nuevo salón -->
        <div id="modal-nvo-salon" class="modal">
            <div class="modal-background"></div>

            <div class="modal-content">
                <div class="box">
                    <p class="title is-5 has-text-centered">Agregar Salón</p>
                    <form method="POST" action="<?php echo e(route('SalonesCrear')); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('POST'); ?>
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">Nombre del Salón:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name="txtNombreSalon" value="<?php echo e(old('txtNombreSalon')); ?>">
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-key"></i>
                                    </span>
                                </div>
                                <?php $__errorArgs = ['txtNombreSalon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="help is-danger">Ingresa el Nombre del Salón</p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">ID Edificio:</label>
                                <div class="control has-icons-left">
                                    <div class="select">
                                        <select name="txtEdificioIdSalon">
                                            <?php $__currentLoopData = $edificios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $edificio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($edificio->id); ?>"><?php echo e($edificio->nombre_edificios); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <?php $__errorArgs = ['txtEdificioIdSalon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="help is-danger">Ingresa el ID del Edificio</p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>
                        <div class="has-text-centered">
                            <button class="button is-primary" type="submit"><i class="fa-solid fa-floppy-disk"></i>&nbsp;Guardar</button>
                        </div>
                    </form>
                </div>
            </div>

            <button class="modal-close is-large" aria-label="close"></button>
        </div>

    </div>

    <?php if($errors->has('txtNombreEdif') || $errors->has('txtDescripcionEdif')): ?>
    <script>
        document.getElementById('modal-nvo-edificio').classList.add('is-active');
    </script>
    <?php endif; ?>

    <?php if($errors->has('txtNombreSalon') || $errors->has('txtEdificioIdSalon')): ?>
    <script>
        document.getElementById('modal-nvo-salon').classList.add('is-active');
    </script>
    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.plantilla', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new_sii-main\resources\views/escolares/edificio.blade.php ENDPATH**/ ?>