<?php
/* variable que define el root de la app, esto para cambios agiles entre SX, SO y PL */
$root='/';
#urls para generar el active en los links del Navbar
$urlactual=$_SERVER['REQUEST_URI'];
$principal=$root."views/";
$index= $root."views/index.php";
$cultura=$root."views/cultura.php";
?>

<!-- Cuerpo del Navbar, en cada li se condiciona con un if el active del mismo -->
<nav class="navbar navbar-expand-md navbar-dark" style="background-color: #000000">
    <div class="container-fluid">
        <button type="button" name="button" class="navbar-toggler navbar-toggler-left" data-toggle="collapse" data-target="#navb">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="" >
            <a class="logo" href="#">
                <img  class="logo img-responsive" src="../media/img/Logo.png">
            </a>
        </div>
    <div id="navb" class="navbar-collapse collapse hide">
        <ul class="nav navbar-nav center ml-auto">
            <li class="navbar-item <?php if(strcmp($urlactual, $index)==0 || strcmp($urlactual, $principal)==0){ echo "active"; } ?>">
                <a href="index.php" class="nav-link ">
                    <span class="fas fa-pencil-alt" ></span>
                    Educación Continua </a>
            </li>
            <li class="navbar-item <?php if(strcmp($urlactual, $cultura)==0){ echo "active"; } ?>">
                <a href="cultura.php  " class="nav-link ">
                    <span class="fas fa-theater-masks" ></span>
                    Cultura </a>
            </li>
        </ul>
    </div>
    </div>
</nav>