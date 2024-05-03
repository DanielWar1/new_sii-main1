<?php $__env->startSection('content'); ?>
<div class="card alturabloque">
    <header class="card-header">
        <p class="card-header-title">
            Docentes
        </p>
    </header>
    <div class="card-content">
        <div class="columns is-multiline is-mobile">
            <div class="column buttons ">
                <a href="<?php echo e(route('home')); ?>" class="button is-danger"><i class="fa-solid fa-arrow-left"></i>Regresar</a>
                <buttom class="button is-info js-modal-trigger" data-target="modal-nvo-docente"><i class="fa-solid fa-plus"></i>Nuevo Docente</a>
            </div>
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
        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
            <thead>
            <tr class="has-text-centered">
                <th>RFC</th>
                <th>NOMBRE</th>
                <th class="is-hidden-mobile">A. PATERNO</th>
                <th class="is-hidden-mobile">A. MATERNO</th>
                <th class="is-hidden-mobile">CURP</th>
                <th class="is-hidden-mobile">EMAIL</th>
                <th>OPCIONES</th>
            </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $docentes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e($item->rfc); ?></td>
                    <td><?php echo e($item->nombre); ?></td>
                    <td class="is-hidden-mobile"><?php echo e($item->ap_paterno); ?></td>
                    <td class="is-hidden-mobile"><?php echo e($item->ap_materno); ?></td>
                    <td class="is-hidden-mobile"><?php echo e($item->curp); ?></td>
                    <td class="is-hidden-mobile"><?php echo e($item->email); ?></td>

                    <td>
                    <div class="field is-grouped">
                        <button class="button is-success js-modal-trigger" data-target="modal-<?php echo e($item->rfc); ?>"><i class="fa-solid fa-pen-to-square"></i></button>
                        <form action="<?php echo e(route('Docenteliminar', $item->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="button is-danger" onclick="return confirm('¿Estás seguro de que quieres eliminar este Docente?')">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </form>
                    </div>
                    <div id="modal-<?php echo e($item->rfc); ?>" class="modal">
                        <div class="modal-background"></div>
                        <div class="modal-content">
                        <div class="box">
                            <p class="title is-5 has-text-centered">Modificar Docente</p>
                            <form method="POST" action="<?php echo e(route('DocenteEditar', $item->id)); ?>"> 
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>
                                <div class="field is-4">
                                    <label class="label">RFC</label>
                                    <input class="input" value="<?php echo e($item->rfc); ?>" name="UpRFCDocente">
                                </div>
                                <div class="field is-4">
                                    <label class="label">Nombre de Docente</label>
                                    <input class="input" value="<?php echo e($item->nombre); ?>" name="UpNombreDocente">
                                </div>
                                <div class="field is-4">
                                    <label class="label">Apellido Materno Docente</label>
                                    <input class="input" value="<?php echo e($item->ap_paterno); ?>" name="UpApPaternoDocente">
                                </div>
                                <div class="field is-4">
                                    <label class="label">Apellido Paterno Docente</label>
                                    <input class="input" value="<?php echo e($item->ap_materno); ?>" name="UpApMaternoDocente">
                                </div>
                                <div class="field is-4">
                                    <label class="label">CURP Docente</label>
                                    <input class="input" value="<?php echo e($item->curp); ?>" name="UpCurpDocente">
                                </div>
                                <div class="field is-4">
                                    <label class="label">Email Docente</label>
                                    <input class="input" value="<?php echo e($item->email); ?>" name="UpEmailDocente">
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
                    <!-- Modal crear  -->
        <div id="modal-nvo-docente" class="modal">
            <div class="modal-background"></div>
        
            <div class="modal-content">
                <div class="box">
                    <p class="title is-5 has-text-centered">Agregar Docente</p>
                    <form method="POST" action="<?php echo e(route('DocenteCrear')); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('POST'); ?>
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">RFC del Docente:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name = "txtRFCDoc" value="<?php echo e(old('txtRFCDoc')); ?>">
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-key"></i>
                                    </span>
                                </div>
                            </div>
                            <?php $__errorArgs = ['txtRFCDoc'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="help is-danger">Ingresa el RFC del Docente</p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">Nombre del Docente:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name = "txtNombreDoc" value="<?php echo e(old('txtNombreDoc')); ?>">
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </span>
                                </div>
                            </div>
                            <?php $__errorArgs = ['txtNombreDoc'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="help is-danger">Ingresa el Nombre del Docente</p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">Apellido Paterno del Docente:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name = "txtApPaternoDoc" value="<?php echo e(old('txtApPaternoDoc')); ?>">
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </span>
                                </div>
                            </div>
                            <?php $__errorArgs = ['txtApPaternoDoc'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="help is-danger">Ingresa el Apellido Paterno del Docente</p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">Apellido Materno del Docente:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name = "txtApMaternoDoc" value="<?php echo e(old('txtApMaternoDoc')); ?>">
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </span>
                                </div>
                            </div>
                            <?php $__errorArgs = ['txtApMaternoDoc'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="help is-danger">Ingresa el Apellido Materno del Docente</p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">CURP del Docente:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="text" name = "txtCURPDoc" value="<?php echo e(old('txtCURPDoc')); ?>">
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </span>
                                </div>
                            </div>
                            <?php $__errorArgs = ['txtCURPDoc'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="help is-danger">Ingresa el Apellido Materno del Docente</p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="field">
                            <div class="control has-icons-left">
                                <label class="label">Email del Docente:</label>
                                <div class="control has-icons-left">
                                    <input class="input" type="email" name = "txtEmailDoc" value="<?php echo e(old('txtEmailDoc')); ?>">
                                    <span class="icon is-small is-left">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </span>
                                </div>
                            </div>
                            <?php $__errorArgs = ['txtEmailDoc'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="help is-danger">Ingresa el Email del Docente</p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="has-text-centered">
                            <button class="button is-primary" type="submit"><i
                                    class="fa-solid fa-floppy-disk"></i>&nbsp;Guardar</a>
                        </div>
                    </form>
                    <!-- Your content -->
                </div>
            </div>
        
            <button class="modal-close is-large" aria-label="close"></button>
        </div>

    </div>
    
    <?php if($errors->has('txtRFCDoc')
    ||$errors->has('txtNombreDoc')
    ||$errors->has('txtApPaternoDoc')
    ||$errors->has('txtApMaternoDoc')
    ||$errors->has('txtCURPDoc')
    ||$errors->has('txtEmailDoc')
    ): ?>
    <script>
        document.getElementByid('modal-nvo-docente').classList.add('is-active');
    </script>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.plantilla', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\new_sii-main\resources\views/escolares/docente.blade.php ENDPATH**/ ?>