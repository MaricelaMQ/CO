<?php
    if($_GET["ed"]??''){  // verifica si variable 'ed: editar' esta definida.
            $editar = $_GET["ed"];
        }else{
            $editar =0;
  }
    if($_GET["d"]??''){ // verifica si variable 'd: duplicar' esta definida.
          $id = $_GET["d"];
          include "libs/consulta.php";
    }else{
          $id=0;
          $datos=0;
          $descripcion=0;
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
    <link rel="stylesheet" href="../assets/css/materialize.min.css" />
    <link rel="stylesheet" href="../assets/css/Estilos.css" />
    <link rel="shortcut icon" href="../assets/logo.ico">
    <script src="../assets/js/vendor/jquery.js"></script>
    <script src="js/main_ms.js"></script>
    <script src="js/validaform.js"></script>

    <script type="text/javascript">
    var id = <?php echo $id;?>;
    var editar = <?php echo $editar;?>;
    var idDelete = [];
    if (id != 0) {
        var detCertificado = <?php echo json_encode($datos);?>;
        var detMercancias = <?php echo json_encode($descripcion);?>;
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
        <div id="estado" class="col l12 m12 s12 center"></div>
        <!-- ****************** -->
        <!-- <form> -->
        <div>
            <!-- FORMULARIO -->
            <section>
                <div class="row">
                    <div class="col l12 cajas">
                        <div class="row">
                            <p>
                                <label for="">DO:</label>
                                <input id="operacion" type="" value="" style="width=:50px;" maxlength="20" required>
                            </p>
                        </div>
                        <div class="row">
                            País Exportador: <input id="paisexp" disabled value="COLOMBIA" type=""> País
                            importador:
                            <input id="paisimp" class="mayusc" value="" type="">
                        </div>
                    </div>
                </div>
            </section>
            <!-- TABLA DESCRIPCION DE LAS MERCANCIAS -->
            <section>
                <div class="row">
                    <div class="col l12 cajas">
                        <div class="row">
                            <table class="center">
                                <thead>
                                    <tr>
                                        <th class="item center oculto">No. de Orden (1)</th>
                                        <th class="center">NALADISA</th>
                                        <th class="center">Denominación de las mercancías</th>
                                        <th class="center">Peso o cantidad</th>
                                        <th class="center">Valor FOB en (US $)</th>
                                        <th class="valorfactura">Normas</th>
                                        <th class="valorfactura"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="oculto">
                                            <input id="varmodificando" type="" class="valorfactura"
                                                style="width:20px!important;" maxlength="3" value="" />
                                        </td>
                                        <td class="center valorfactura">
                                            <input id="naladisa" type="" class="mayusc valorfactura" maxlength="12"
                                                value="" />
                                        </td>
                                        <td class="center denoMerca">
                                            <textarea id="descmercancia" maxlength="300"></textarea>
                                        </td>
                                        <td class="center valorfactura">
                                            <input id="pesocantidad" type="" class="valorfactura" value="" />
                                        </td>
                                        <td class="center valorfactura">
                                            <input id="valorfob" type="" class="valorfactura" value="" />
                                        </td>
                                        <td class="valorfactura">
                                            <select id="normas" name="" class="validate">
                                                <option value="" selected>-</option>
                                                <option value="Anexo IV, artículo 5º, Apéndice 3.1">Anexo IV, artículo 5º, Apéndice 3.1 </option>
                                                <option value="A.C.E. No. 72. Anexo IV, articulo 2°, literal c">A.C.E. No. 72. Anexo IV, articulo 2°, literal c</option>
                                                <option value="Norma 3">Norma 3</option>
                                                <option value="Norma 4">Norma 4</option>
                                                <option value="Norma N">Norma ...</option>
                                            </select>
                                        </td>
                                        <td>
                                            <button title="Agregar nuevo item" href="#" id="agregar"
                                                class="btn waves-effect waves-light"><i class="material-icons">add</i>
                                            </button>
                                            <div title="Aceptar cambios" href="#" id="modificar"
                                                class=" oculto btn blue waves-effect waves-light">
                                                <i class="material-icons">check</i></div>
                                            <div title="Cancelar" href="#" id="cancelar"
                                                class=" oculto btn orange waves-effect waves-light"><i
                                                    class="material-icons">cancel</i></div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <table id="tbldescripcionmercancia" class="highlight responsive-table striped bordered">
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
                        <div class="row">
                            <p class="center"> <b>DECLARACION DE ORIGEN</b></p>
                            <p class="">DECLARAMOS que las mercancias indicadas en el presente formulario,
                                correspondientes
                                a la Factura Comercial No.
                                <input id="nofacturacomercial" type="" class="mayusc valorfactura" value="" /> de
                                fecha  
                                <input id="fechadeclaorigen" class="fechams" type="date" required> cumplen con lo
                                establecido
                                en las normas de origen del presente Acuerdo
                                <input id="acuerdo" disabled type="" class="valorfactura" value="(ACE-72)" /> de
                                conformidad
                                con el siguiente desglose.</p>
                            <br>
                        </div>
                    </div>
                </div>
            </section>
            <!-- NORMAS -->
            <!-- <section>
                <div class="row">
                    <div class="col l12 m12 s12 cajas">
                        <table class="center">
                            <thead>
                                <tr>
                                    <th class="">No. de Orden</th>
                                    <th class="descripcion">NORMAS (2)</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td class="">
                                            <input id="varnorma" type="" class="valorfactura" style="width:20px!important;" maxlength="3" value="" />
                                        </td>                                        
                                        <td class="center descripcion ">
                                            <textarea id="normas" maxlength="160"></textarea>
                                        </td>                                        
                                        <td>
                                            <div title="Agregar nuevo item" href="#" id="agregarnorma"
                                                class="btn waves-effect waves-light"><i class="material-icons">add</i>
                                            </div>
                                            <div title="Aceptar cambios" href="#" id="modificarnorma"
                                            class=" oculto btn blue waves-effect waves-light">
                                            <i class="material-icons">check</i></div>
                                            <div title="Cancelar" href="#" id="cancelarnorma"
                                            class=" oculto btn orange waves-effect waves-light"><i
                                                class="material-icons">cancel</i></div>
                                        </td>
                                    </tr>
                                </tbody>
                        </table>
                    </div>
                </div>
                
            </section> -->
            <!-- EXPORTADOR PRODUCTOR -->
            <section>
                <div class="row">
                    <div class="col l12 cajas">
                        <p><b>EXPORTADOR O PRODUCTOR</b></p>
                        <div class="row">
                            <div class="input-field col l5">
                                <input id="razonsocialexpopro" class="validate" type="text" value="" required>
                                <label for="">Razón social</label>
                            </div>
                            <div class="input-field col l2">
                                <input id="nit" class="validate" type="text" value="" required>
                                <label for="">NIT:</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col l5">
                                <input id="direccionexpopro" class="validate" type="text" value="" required>
                                <label for="">Dirección</label>
                            </div>
                            <div class=" input-field col l4">
                                <span>Fecha   </span>
                                <input id="fechaexpopro" class="fechams" type="date" required>

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
                        <div class="row">
                            <p>

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
                    <a href="principal.php" class="btn waves-effect waves-light">Volver
                        <i class="material-icons right">arrow_back</i>
                    </a>
                    <button class="btn waves-effect orange" type="submit" id="btguardar">Guardar
                        <i class="material-icons right">save</i>
                    </button>
                    <button class="btn light-blue darken-2" type="submit" id="btpublicar">Publicar
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </div>
        <!-- </form> -->
        <div id="resultado"></div>
        <div id="footer" class="cuadrado"></div>
        <script src="../assets/js/materialize.min.js"></script>
</body>

</html>