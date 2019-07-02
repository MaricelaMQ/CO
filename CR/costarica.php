<!DOCTYPE html>
<?php
ob_start();
//header("Cache-Control: no-cache, must-revalidate"); 
//header("Expires: Sat, 1 Jul 2000 05:00:00 GMT");
    if($_GET["ed"]??''){ // verifica si variable 'ed: editar' esta definida.
            $editar = $_GET["ed"];
            //include "libs/consulta.php";
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
    ob_flush();
?>
<html lang="ES">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>CO - Costa Rica</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" >
    <link rel="stylesheet" href="../assets/css/materialize.min.css" />
    <link rel="stylesheet" href="../assets/css/Estilos.css" />
    
    
    <link rel="shortcut icon" href="../assets/logo.ico">
    
    <script src="../assets/js/vendor/jquery.js"></script>
    <script src="js/main.js"></script>
    <script src="js/validaform.js"></script>
    <script type="text/javascript">
    var id = <?php echo $id;?>;    
    var editar = <?php echo $editar;?>;
    var idDelete = [];
    //console.log("valor id: "+ id);
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
            <div class="col l12 m12 s12 light-blue lighten-1 center titulo">Certificado de Origen COSTA RICA</div>
        </div>
        <!-- <div class="row "> -->
            <div id="estado" class="col l12 m12 s12 center"></div>
        <!-- </div> -->
        <!-- ****************** -->
        <!-- <form> -->
        <div>
            <!-- FORMULARIO -->
            <div class="row">
                <div class="">                
                    <label for="">DO:</label>
                    <input id="operacion" type="" value="" style="width=:50px;" maxlength="20" required>
                </div>
            </div>
            <!-- SECCION EXPORTADOR -->
            <div class="row ">
                <div class=" col l6 s12 cuadro ">
                    <div class="row">
                        <div class="input-field">
                            <input id="nombreexp" class="validate" type="text" value="" required>
                            <label for="">1. Nombre del Exportador</label>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="input-field">
                            <input id="direccionexp" class="validate" type="text" value="" maxlength="60" required>
                            <label for="">Dirección</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col l6 s6">
                            <input id="telefonoexp" type="text" class="validate" value="" required>
                            <label for="">Teléfono</label>
                        </div>
                        <div class="input-field col l6 s6">
                            <input id="faxexp" type="text" class="validate" value="" required>
                            <label for="">Fax</label>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="input-field col l6 s6">
                            <input id="correoexp" type="text" class="minusc validate" value="" required>
                            <label for="">Correo electrónico:</label>
                        </div>

                        <div class="input-field col l6 s6">
                            <input id="numregfiscalexp" type="text" class="validate" value="" required>
                            <label for="">No. Registro Fiscal</label>
                        </div>
                    </div>
                </div>
                <div class="hide-on-small-only hide-on-med-only col l6 colder">
                    <h4>
                        Tratado de Libre Comercio entre Colombia y Costa Rica
                    </h4>

                </div>
            </div>


            <!-- SECCION PRODUCTOR -->
            <div class="row ">
                <div class=" col l6 s12 m12 cuadro">
                    <div class="row">
                        <div class="input-field">
                            <input id="nombrepro" type="text" class="validate" value="" required>
                            <label for="">2. Nombre del Productor</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field">
                            <input id="direccionpro" type="text" class="validate" value="" required>
                            <label for="">Dirección</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col l6 s6">
                            <input id="telefonopro" type="text" class="validate" value="" required>
                            <label for="">Teléfono</label>
                        </div>
                        <div class="input-field col l6 s6">
                            <input id="faxpro" type="text" class="validate" value="" required>
                            <label for="">Fax</label>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="input-field col l6 s6">
                            <input id="correopro" type="text" class="minusc validate" value="" required>
                            <label for="">Correo electrónico:</label>
                        </div>

                        <div class="input-field col l6 s6">
                            <input id="numregfiscalpro" type="text" class="validate" value="" required>
                            <label for="">No. Registro Fiscal</label>
                        </div>
                    </div>
                </div>
                <!-- SECCION IMPORTADOR -->
                <div class="cuadro col l6 m12 s12">
                    <div class="row">
                        <div class="input-field">
                            <input id="nombreimp" type="text" class="validate" value="" required>
                            <label for="">3. Nombre del Importador</label>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="input-field">
                            <input id="direccionimp" type="text" class="validate" value="" required>
                            <label for="">Dirección</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col l6 s6">
                            <input id="telefonoimp" type="text" class="validate" value="" required>
                            <label for="">Teléfono</label>
                        </div>
                        <div class="input-field col l6 s6">
                            <input id="faximp" type="text" class="validate" value="" required>
                            <label for="">Fax</label>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="input-field col l6 s6">
                            <input id="correoimp" type="text" class="minusc validate" value="" required>
                            <label for="">Correo electrónico:</label>
                        </div>

                        <div class="input-field col l6 s6">
                            <input id="numregfiscalimp" type="text" class="validate" value="" required>
                            <label for="">No. registro fiscal</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class=" col l12 cuadro">

                    <div class="row ">
                        <table class="center">
                            <thead>
                                <tr>
                                    <th class="descripcion">5. Descripción de las mercancias</th>
                                    <th class="valorfactura">6. Clasificación Arancelaria</th>
                                    <th class="valorfactura">7. No. Factura</th>
                                    <th class="valorfactura">8. Valor en Factura</th>
                                    <th class="valorfactura">9. Criterio de Origen</th>
                                    <th class="valorfactura"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="descripcion">
                                        <input id="varmodificando" type="" class="oculto" maxlength="3" value=""
                                            style="width:20px!important;" /><textarea id="descmercancia"
                                            maxlength="200"></textarea>
                                    </td>
                                    <td class="center valorfactura"><input id="clasiarancelaria" type=""
                                            class="valorfactura" maxlength="8" value="" />
                                    </td>
                                    <td class="center valorfactura"><input id="nofactura" type="" class="valorfactura"
                                            maxlength="10" value="" />
                                    </td>
                                    <td class="center valorfactura"><input id="valorfactura" type=""
                                            class="valorfactura" value="" /></td>
                                    <td class="center">
                                        <select id="criterorigen" name="" class="criterorigen validate">
                                            <option value="A" selected>A</option>
                                            <option value="B">B</option>
                                            <option value="C">C</option>
                                        </select>

                                        <!-- <input id="ccriterorigen" class="item" type="" maxlength="1" value="A" /> -->
                                    </td>
                                    <td>
                                        <button title="Agregar nuevo item" href="#" id="agregar"
                                            class="btn waves-effect waves-light"><i class="material-icons">add</i></button>
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
                    </div>

                    <!-- ************** TABLA DESCRIPCION MERCANCIAS*************-->
                    <div class="row">
                        <table id="descripcionmercancia" class="highlight responsive-table striped bordered">
                            <!-- <thead>
                                    <tr>
                                        <th>4. Item</th> 
                                        <th>5. Descripción de las mercancias</th>
                                        <th>6. Clasificación Arancelaria</th>
                                        <th>7. No. Factura</th>
                                        <th>8. Valor en Factura</th>
                                        <th>9. Criterio de Origen</th>
                                    </tr>
                                </thead> -->
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!--  OBSERVACIONES -->
            <div class="row ">
                <div class="col l12  m12 s12 cuadro ">
                    <div class="input-field">
                        <textarea id="observaciones" type="" class="materialize-textarea"> </textarea>
                        <label for="">10. Observaciones</label>
                    </div>
                </div>
            </div>
            <!-- SECCION 11-->
            <div class="row">
                <div class=" col l6 s12 m12 cuadro secc11">
                    <div class="row">
                        <p>11. Declaración del exportador:</p>
                        <p>El abajo firmante declara bajo juramento que la información consignada en este
                            certificado de
                            origen es correcta y verdadera y que las mercancías fueron producidas en:
                        </p>
                    </div>
                    <div class="row ">
                        <p>
                            País: <input id="paisexp" disabled value="COLOMBIA" type="">
                        </p>
                        <p>y cumplen con las disposiciones del Capitulo 3 (Reglas de Origen y Procedimientos de
                            Origen)
                            establecidas en el Tratado de Libre Comercio entre la República de Colombia y la
                            República
                            de
                            Costa Rica y exportadas a:</p>
                        País de importación: <input id="paisimp" disabled value="COSTA RICA" type="">
                    </div>

                    <div class="row">
                        <div class=" col l4 s4">
                            <label for="">Lugar</label>
                            <input id="lugarexp" type="text" class="validate" value="" required>

                        </div>
                        <div class="col l4 s4">
                            <label for="">Fecha</label>
                            <input id="fechaexp" type="date" required>
                        </div>
                    </div>

                </div>
                <!-- SECCION 12 -->
                <div class="cuadro col l6 m12 s12 secc12">
                    <div class="row">
                        <p>12. Certificación de la autoridad competente:</p>
                        <p>Sobre la base del control efectuado, se certifica por este medio que la información aquí
                            señalada
                            es correcta y que las mercancías descritas cumplen con las disposiciones del Tratado de
                            Libre
                            Comercio entre la República de Colombia y la República de Costa Rica.
                        </p>
                        <p>Lugar y fecha, nombre y firma del funcionario y sello de la autoridad competente:</p>
                        <div class="row">
                            <div class=" col l4 s4">
                                <select name="" id="selectlCiudad" onchange="ciudadSeccDoce()">
                                <option value="NINGUNA" SELECTED>NINGUNA</option>
                                    <option value="BARRANQUILLA">BARRANQUILLA</option>
                                    <option value="BOGOTA">BOGOTA</option>
                                    <option value="CALI">CALI</option>
                                    <option value="MEDELLIN">MEDELLIN</option>
                                </select>

                            </div>
                            <div class="col l4 s4">
                                <!-- <label for="">Fecha</label>
                                <input id="fechaautocompe" type="date" required> -->
                            </div>
                        </div>
                        <div class="row ">
                            <div class="">
                                <label for="">Dirección</label>
                                <input id="direccionautocompe" type="" class="mayusc validate" style="width:415px" value=""
                                    required>
                            </div>
                        </div>

                        <div class="row">
                            <!-- <div class=" col l6 s6"> -->
                            <label for="">Teléfono</label>
                            <input id="telefonoautocompe" type="" class="validate" value="" required>
                            <!-- </div> -->
                            <!-- <div class="col l6 s6"> -->
                            <label for="">Fax</label>
                            <input id="faxautocompe" type="" class="validate" value="" required>
                            <!-- </div> -->
                        </div>
                        <div class="row ">
                            <div class="">
                                <label for="">Correo electrónico:</label>
                                <input id="correoautocompe" type="" style="width:40%" class="minusc validate" value="" required>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="row">
                <div class="col l12 center seccionboton">
                    <a href="../CR/principal.php" class="btn waves-effect waves-light">Volver
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