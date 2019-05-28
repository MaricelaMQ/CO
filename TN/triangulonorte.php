<?php
ob_start();
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
ob_flush();
?>
<!DOCTYPE html>
<html lang="ES">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CO - Triangulo Norte</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/materialize.min.css" />
    <link rel="stylesheet" href="../assets/css/Estilos.css" />
    <link rel="shortcut icon" href="../assets/logo.ico">

    <script src="../assets/js/vendor/jquery.js"></script>
    <script src="js/main_tn.js"></script>
    <script src="js/validaform_tn.js"></script>
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
            <div class="col l12 m12 s12 deep-purple lighten-1 center titulo">
                Certificado de Origen Triangulo Norte
            </div>
        </div>
        <div id="estado" class="col l12 m12 s12 center"></div>
        <!-- ****************** -->
        <!-- <form> -->
        <div>
            <!-- FORMULARIO -->
            <div class="row">
                <div class="">
                    <label for="">DO:</label>
                    <input id="Operacion" type="" value="" style="width=:50px;" maxlength="20" required>
                </div>
            </div>
            <!-- SECCION 1 EXPORTADOR -->
            <div class="row ">
                <section>
                    <div class=" col l6 s12 cajas">
                        <div class="row">
                            <div class="input-field">
                                <input id="NombreExp" class="validate" type="text" value="" required>
                                <label for="">1. Nombre del Exportador:</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col l6 s6">
                                <input id="DireccionExp" type="text" class="validate" value="" required>
                                <label for="">Dirección:</label>
                            </div>
                            <div class="input-field col l3 m3 s6">
                                <input id="FaxExp" type="text" class="validate" value="" required>
                                <label for="">Ciudad:</label>
                            </div>
                            <div class="input-field col l3 m3 s6">
                                <input id="PaisExp" type="text" class="validate" value="" required>
                                <label for="">Pais:</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col l6 s6">
                                <input id="TelefonoExp" type="text" class="validate" value="" required>
                                <label for="">Teléfono</label>
                            </div>
                            <div class="input-field col l6 s6">
                                <input id="NumRegFiscalExp" type="text" class="validate" value="" required>
                                <label for="">Número de Registro Fiscal:</label>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- SECCION 2 PERIODO CUBIERTO -->
                <section>
                    <div class="col l6 s12 cajas" style="height: 215px;">
                        <div class="row">
                            <div class="input-field s12">
                                <p>2. Periodo que cubre</p>
                                <p>Desde:
                                    <input id="FechaDesde" class="fechams" type="date" value="" required>
                                    Hasta:
                                    <input id="FechaHasta" class="fechams" type="date" value="" required>
                                </p>

                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col l6 s12">
                                <input id="NumFacturaComercial" type="text" class="validate" value="" required>
                                <label for="">Número de Factura Comercial</label>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <div class="row ">
                <!-- SECCION 3 PRODUCTOR -->
                <section>
                    <div class=" col l6 s12 m12 cajas">
                        <div class="row">
                            <div class="input-field">
                                <input id="NombrePro" type="text" class="validate" value="" required>
                                <label for="">3. Nombre del Productor</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col l6 s6">
                                <input id="TelefonoPro" type="text" class="validate" value="" required>
                                <label for="">Teléfono</label>
                            </div>
                            <div class="input-field col l6 s6">
                                <input id="FaxPro" type="text" class="validate" value="" required>
                                <label for="">Fax:</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col l6 s6">
                                <input id="DireccionPro" type="text" class="validate" value="" required>
                                <label for="">Dirección</label>
                            </div>
                            <div class="input-field col l6 s6">
                                <input id="NumRegFiscalPro" type="text" class="validate" value="" required>
                                <label for="">Número de Registro Fiscal:</label>
                            </div>
                        </div>
                    </div>
                </section>

                <div class="cuadro col l6 m12 s12">
                    <div class="row">
                        <!-- SECCION 4 IMPORTADOR -->
                        <section>
                            <div class="input-field">
                                <input id="NombreImp" type="text" class="validate" value="" required>
                                <label for="">4. Nombre del Importador</label>
                            </div>
                    </div>
                    <div class="row">
                        <div class="input-field col l6 s6">
                            <input id="TelefonoImp" type="text" class="validate" value="" required>
                            <label for="">Teléfono</label>
                        </div>
                        <div class="input-field col l6 s6">
                            <input id="DireccionImp" type="text" class="validate" value="" required>
                            <label for="">Dirección:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col l6 s6">
                            <input id="NumRegFiscalImp" type="text" class="validate" value="" required>
                            <label for="">Número de Registro Fiscal:</label>
                        </div>
                    </div>
                </div>
                </section>
            </div>
            <div class="row">
                <div class="col l12 cuadro">
                    <!-- SECCION 5 DESCRIPCION MERCANCIAS -->
                    <section>
                        <div class="row">
                            <table class="center responsive-table bortabla">
                                <thead>
                                    <tr>
                                        <th class="descripcion">5. Descripción de las mercancias</th>
                                        <th class="valorfactura">6. Clasificación Arancelaria</th>
                                        <th class="valorfactura">7. Criterio preferencial</th>
                                        <th class="valorfactura">8. Otros Criterios</th>
                                        <th class="valorfactura">9. Productor</th>
                                        <th class="valorfactura">10. País de origen</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="oculto"><input id="varmodificando" type="" class="valorfactura"
                                                style="width:20px!important;" maxlength="3" value="" /></td>
                                        <td class="descripcion">
                                            <textarea id="DescMercancia" maxlength=""></textarea>
                                        </td>
                                        <td class="center valorfactura"><input id="ClasiArancelaria" type=""
                                                class="valorfactura" maxlength="10" value="" />
                                        </td>
                                        <td class="center valorfactura"><input id="CritePreferencial" type=""
                                                class="valorfactura mayusc" maxlength="10" value="" />
                                        </td>
                                        <td class="center valorfactura"><input id="OtrosCriterios" type=""
                                                class="valorfactura mayusc" value="" /></td>
                                        <td class="center"><input id="Productor" type="" class="valorfactura mayusc"
                                                value="" /></td>
                                        <td class="center">
                                            <input id="PaisdeOrigen" disabled class="valorfactura" type="" maxlength="1"
                                                value="CO" />
                                            <!-- <select id="criterorigen" name="" class="validate">
                                                    <option value="A" selected>A</option>
                                                    <option value="B">B</option>
                                                    <option value="C">C</option>
                                                </select> -->
                                        </td>
                                        <td>
                                            <div href="#" id="agregar" class="waves-effect waves-light btn"><i
                                                    class="material-icons">add</i></div>
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

                    </section>

                    <!-- ************** TABLA DESCRIPCION MERCANCIAS*************-->
                    <div class="row">
                        <table id="tbldescripcionmercancia" class="highlight responsive-table striped bordered">
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--  OBSERVACIONES -->
            <section>
                <div class="row ">
                    <div class="col l12 m12 s12 cuadro ">
                        <div class="input-field">
                            <textarea id="Observaciones" type="" class="materialize-textarea"> </textarea>
                            <label for="">11. Observaciones</label>
                        </div>
                    </div>
                </div>
            </section>
            <!-- SECCION PERSONA QUE AUTORIZA-->
            <div class="row">
                <div class="cuadro col l12 m12 s12">
                    <div class="row">
                        <div class="col l12 s12">
                            <p>
                                <label for="">Fecha elaboración:</label>
                                <input id="FechaElabora" class="fechams" type="date" value="" required>
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col l4 m12 s12">
                            <input id="NombreAutoriza" class="validate" type="text" value="" required>
                            <label for="">Nombre persona que autoriza</label>
                        </div>
                        <div class="input-field col l4 m6 s6">
                            <input id="CargoPersonAutoriza" type="text" class="validate" value="" required>
                            <label for="">Cargo</label>
                        </div>
                        <div class="input-field col l4 m6 s6">
                            <input id="EmpresaAutoriza" type="text" class="validate" value="" required>
                            <label for="">Empresa</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col l2 m6 s6">
                            <input id="TelPersonAutoriza" type="text" class="validate" value="" required>
                            <label for="">Telefono</label>
                        </div>
                        <div class="input-field col l2 m6 s6">
                            <input id="FaxPersonAutoriza" type="text" class="validate" value="" required>
                            <label for="">Fax:</label>
                        </div>
                    </div>

                </div>
            </div>
            <!-- SECCION FINAL - BUTTONS -->
            <section>
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
            </section>

        </div>
        <!-- </form> -->
        <div id="resultado">
            <!-- <table class="bortabla">
                <thead>
                    <tr>
                        <th class="bortabla" width="58.1%"></th>
                        <th class="bortabla" width="18.6%"></th>
                        <th class="bortabla" width="11.6%"></th>
                        <th class="bortabla" width="11.6%"></th>
                    </tr>
                </thead>
                <tr>
                    <td colspan="5" height="300px" style="vertical-align:top;">
                        <table class="bortabla" cellspadding="" height="100%" style="vertical-align:top;">
                                <thead>
                                    <tr>
                                        <td class="bortabla" width="58.2%">a</td>
                                        <td class="bortabla" width="18.7%">a</td>
                                        <td class="bortabla" width="11.7%">a</td>
                                        <td class="bortabla" width="11.6%">a</td>
                                    </tr>                                
                                    <tr>
                                        <td>a</td>
                                        <td>a</td>
                                        <td>a</td>
                                        <td>a</td>
                                    </tr>
                                    </thead>
                                <tbody>
                                    <tr>
                                        <td>a</td>
                                        <td>a</td>
                                        <td>a</td>
                                        <td>a</td>
                                    </tr>
                                </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td class="bortabla">f</td>
                    <td class="bortabla">f</td>
                    <td class="bortabla">f</td>
                    <td class="bortabla">f</td>
                </tr>
            </table> -->
        </div>
        <div id="footer" class="cuadrado"></div>
        <script src="../assets/js/materialize.min.js"></script>
</body>

</html>