<!DOCTYPE html>
<?php
    if($_GET["op"]??''){// verifica si variable 'op' esta definida.
        $op = $_GET["op"];
    }else{
        $op=0;
    }
?>

<html lang="ES">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/materialize.min.css" />
    <link rel="stylesheet" href="../assets/css/estilos.css">
    
    <link rel="icon" href="../assets/logo.ico">
    <script src="../assets/js/vendor/jquery.js"></script>
    <!-- <script src="js/main.js"></script> -->
    
    <script src="js/cargar_ms.js"></script>
    <script type="text/javascript">
            var op = <?php echo $op;?>;
            if (op == 0) {
                var estado ='TERMINADO';
            }
    </script>
    <title>MS- Terminados</title>
    
</head>
<body>
<div class="row">
        <div class="col l12 cuadrado">
        </div>
    </div>
    <div id="contenedor">

    <div class="row">
                <div class="l12 m12 s12">
                        <a href="../index.html" class="btn waves-effect waves-light pink darken-1" >
                        INICIO<i class="material-icons left ">home</i>
                        </a>
                        <a href="principal.php" class="btn waves-effect waves-light pink darken-1" >
                        Terminados<i class=" material-icons left ">format_indent_increase</i>
                        </a>
                        <a href="guardados.php?op=1" class="btn waves-effect orange darken-2" >
                        Guardados<i class=" material-icons left ">collections_bookmark</i>
                        </a>
                        <a href="mercosur.php" class="btn waves-effect waves-light light-green darken-2" >
                         Nuevo certificado<i class=" material-icons left ">open_in_new</i>
                        </a>
                </div>
    </div> 
    <div class="row">
    <hr>
        <div class="titulodos center" style="background-color: #7eb38e;">Certificados Terminados </div><hr>
    </div>
        <div class="row">
            <div id="resultado" class="center"></div>
        </div>        
    </div>
    <div id="footer" class="cuadrado"></div>
    <script src="../assets/js/materialize.min.js"></script>
</body>
</html>