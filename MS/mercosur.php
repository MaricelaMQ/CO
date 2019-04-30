<?php
    if($_GET["p"]??''){
          $id = $_GET["p"];
          include "libs/consulta.php";
//          var_dump($id);
    }else{
          $id=0;
          $datos=0;          
    }
?>
<!DOCTYPE html>
<html lang="ES">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CO - Mercosur</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../css/materialize.min.css" />
    <link rel="stylesheet" href="../css/Estilos.css" />
    <link rel="icon" href="../assets/logo.ico">
    <script src="../js/vendor/jquery.js"></script>
    <script src="../js/main.js"></script>
    <script src="../js/validaform.js"></script>

    <script type="text/javascript">
    var id = <?php echo $id;?>;
    if (id != 0) {
        var detCertificado = <?php echo json_encode($datos);?>;
    }
    </script>
</head>

<body>
    <div class="row">
        <div class="col l12 cuadrado">
        </div>
    </div>
    <div id="contenedor">
        <div class="row">
            <div class="l12 m12 s12">
                <a href="../index.html" class="btn waves-effect waves-light pink darken-1">
                    INICIO<i class=" material-icons left ">home</i>
                </a>
                <a href="principal.php" class="btn waves-effect waves-light pink darken-1">
                    Lista Certificados<i class=" material-icons left ">format_indent_increase</i>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col l12 m12 s12 green darken-3  center titulo">Certificado de Origen MERCOSUR</div>
        </div>
        <!-- ****************** -->
        <form>
            <div>
                <!-- FORMULARIO -->
                <section>
                    <div class="row">
                        <div class="col l12 cajas">
                            <div class="row"><p>                                
                                    <label for="">DO:</label>
                                    <input id="operacion" type="" value="" style="width=:50px;" maxlength="20" required>
                            </p>
                            </div>
                            <div class="row">
                                País Exportador: <input id="paisexp" disabled value="PAIS EXPORTADOR" type=""> País
                                importador:
                                <input id="paisexp" value="" type="">
                            </div>
                        </div>
                    </div>
                </section>
                <!-- TABLA DENOMINACION DE LAS MERCANCIAS -->
                <section>
                    <div class="row">
                        <div class="col l12 cajas">
                            <table class="center">
                                <thead>
                                    <tr>
                                        <th class="item">No. de Orden (1)</th>
                                        <th class="valorfactura">NALADISA</th>
                                        <th class="descripcion">Denominación de las mercancías</th>
                                        <th class="valorfactura">Peso o cantidad</th>
                                        <th class="valorfactura">Valor FOB en (US $)</th>
                                        <th class="valorfactura"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="valorfactura">
                                            <input id="orden" type="" class="valorfactura" maxlength="8" value="" />
                                        </td>
                                        <td class="center valorfactura">
                                            <input id="naladisa" type="" class="valorfactura" maxlength="10" value="" />
                                        </td>
                                        <td class="center descripcion">
                                            <textarea id="descmercancia" maxlength="160"></textarea>
                                        </td>
                                        <td class="center valorfactura">
                                            <input id="pesocantidad" type="" class="valorfactura" value="" />
                                        </td>
                                        <td class="center">
                                            <input id="valorfob" type="" class="valorfactura" value="" />
                                        </td>
                                        <td>
                                            <div href="#" id="agregar" class="btn waves-effect waves-light">Agregar<i
                                                    class="material-icons left">add</i>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="row">
                                <table id="descripcionmercancia" class="highlight responsive-table striped bordered">
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- DECLARACION DE ORIGEN -->
                <section>
                    <div class="row">
                        <div class="col l12 cajas">
                            <p class="center"> <b>DECLARACION DE ORIGEN</b></p>
                            <p class="">DECLARAMOS que las mercancias indicadas en el presente formulario,
                                correspondientes
                                a la Factura Comercial No.
                                <input id="nofacturacomercial" type="" class="valorfactura" value="" /> de fecha  
                                <input id="fechadecorigen" class="fechams" type="date" required> cumplen con lo
                                establecido
                                en las normas de origen del presente Acuerdo
                                <input id="acuerdo" disabled type="" class="valorfactura" value="(ACE-72)" /> de
                                conformidad
                                con el siguiente desglose.</p>
                                <br>
                        </div>
                    </div>
                </section>
                <!-- NORMAS -->
                <section>
                    <div class="row">
                        <div class="col l12 m12 s12 cajas">
                            <table id="normas" class="center">
                                <thead>
                                    <tr>
                                        <th class="item">No. de Orden</th>
                                        <th class="descripcion">NORMAS (2)</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </section>
                <!-- EXPORTADOR PRODUCTOR -->
                <section>
                    <div class="row">
                        <div class="col l12 cajas">
                            <p><b>EXPORTADOR O PRODUCTOR</b></p>
                            <div class="row">
                                <div class="input-field col l4">
                                    <input id="razonsocialexpopro" class="validate" type="text" value="" required>
                                    <label for="">Razón social</label>
                                </div>
                                <div class="input-field col l4">
                                    <input id="direccionexpopro" class="validate" type="text" value="" required>
                                    <label for="">Dirección</label>
                                </div>
                                <div class=" input-field col l4">
                                    <span>Fecha   </span>
                                    <input id="fechaexpopro" style="width: 130px!important;" type="date" required>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- IMPORTADOR -->
                <section>
                    <div class="row">
                        <div class="col l12 cajas">
                            <p><b>IMPORTADOR</b></p>
                            <div class="row">
                                <div class="input-field col l6 m4 s12">
                                    <input id="razonsocialimp" class="validate" type="text" value="" required>
                                    <label for="">Razón social</label>
                                </div>
                                <div class="input-field col l6 m4 s12">
                                    <input id="direccionimp" class="validate" type="text" value="" required>
                                    <label for="">Dirección</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- TRANSPORTE/ EMBARQUE -->
                <section>
                    <div class="row">
                        <div class="col l12 cajas">
                            <div class="row"><p>
                                
                                    <div class="input-field col l6 m4 s12">
                                        <input id="mediotransporte" class="validate" type="text" value="" required>
                                        <label for="">Medio de transporte</label>
                                    </div>
                                    <div class="input-field col l6 m4 s12">
                                        <input id="puertoembarque" class="validate" type="text" value="" required>
                                        <label for="">Puerto o lugar de embarque</label>
                                    </div>
                            </p>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- OBSERVACIONES -->
                <section>
                    <div class="row">
                        <div class="cajas col l12 m12 s12">
                            <div class="input-field ">
                                <textarea id="observaciones" type="" class="materialize-textarea"> </textarea>
                                <label for="">Observaciones</label>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- ######################################################################################################## -->       
                <div class="row">
                    <div class="col l12 center seccionboton">
                        <a href="../index.html" class="btn waves-effect waves-light">Volver
                            <i class="material-icons right">arrow_back</i>
                        </a>
                        <button class="btn waves-effect orange" type="submit" id="btguardar">Guardar
                            <i class="material-icons right">save</i>
                        </button>
                    </div>
                </div>
            </div>
        </form>
        <div id="resultado"></div>
        <div id="footer" class="cuadrado"></div>
        <script src="../js/materialize.min.js"></script>
</body>

</html>