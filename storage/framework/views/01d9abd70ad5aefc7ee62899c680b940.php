<!DOCTYPE html>
<html lang="es" class="theme-light">

<head>
    <title>CETECH v2</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.0/css/bulma.min.css">
    
    <link rel="stylesheet" href='/css/miestilo.css'>
    <script src="https://kit.fontawesome.com/ee9903c79f.js" crossorigin="anonymous"></script>
    <script src="/js/main.js"></script>
</head>

<body>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="">
                <figure class="image is-24x24">
                    <img src="/img/itsjr.png" />
                </figure>&nbsp;&nbsp;
                <p>Tec San Juan</p>
            </a>

            <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false"
                data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="<?php echo e(route('home')); ?>">
                    Inicio
                </a>

            </div>
            <div class="navbar-end">
            <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                        
                    </a>

                    <div class="navbar-dropdown is-right">
                        <a class="navbar-item">
                            <i class="fas fa-key"></i>&nbsp;
                            Cambiar contraseña
                        </a>
                        <a class="navbar-item" 
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                            <i class="fas fa-power-off"></i>&nbsp;
                            Salir
                        </a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </nav>

    
    
    <div class="container is-fluid">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
</body>

</html>
<?php /**PATH C:\xampp\htdocs\new_sii-main\resources\views/layouts/plantilla.blade.php ENDPATH**/ ?>