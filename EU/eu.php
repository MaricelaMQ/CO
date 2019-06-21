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
    <title>CO - EEUU</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/materialize.min.css" />
    <link rel="stylesheet" href="../assets/css/Estilos.css" />
    <link rel="icon" href="../assets/logo.ico">

    <script src="../assets/js/vendor/jquery.js"></script>
    <script src="js/main_eu.js"></script>
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
            <div class="col l12 m12 s12  brown darken-1 center titulo">
                Certificado de Origen EEUU
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
                    <div class=" col l6 s12 cajas ">
                        <div class="row">
                            <div class="input-field">
                                <input id="NombreExp" class="validate" type="text" value="" required>
                                <label for="">1. Razón social exportador</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field">
                                <input id="DireccionExp" class="validate" type="text" value="" required>
                                <label for="">Dirección</label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="input-field col l6 s12">
                                <input id="TelefonoExp" type="text" class="validate" value="" required>
                                <label for="">Teléfono</label>
                            </div>
                            <div class="input-field col l6 s12">
                                <input id="CorreoExp" type="text" class="validate minusc" value="" required>
                                <label for="">Correo electrónico:</label>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- SECCION 2 PERIODO CUBIERTO -->
                <section>
                    <div class="col l6 s12 cajas" style="height:215px;">
                        <div class="row">
                            <div class="input-field s12">
                                <p>2. Periodo cubierto</p>
                                <p>Desde:
                                    <input id="FechaDesde" class="fechams" type="date" value="" required>
                                </p>
                                <p>Hasta:
                                    <input id="FechaHasta" class="fechams" type="date" value="" required>
                                </p>

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
                                <label for="">3. Razon social del Productor</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field">
                                <input id="DireccionPro" type="text" class="validate" value="" required>
                                <label for="">Dirección</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col l6 s6">
                                <input id="TelefonoPro" type="text" class="validate" value="" required>
                                <label for="">Teléfono</label>
                            </div>
                            <div class="input-field col l6 s6">
                                <input id="CorreoPro" type="text" class="validate minusc" value="" required>
                                <label for="">Correo electrónico:</label>
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
                                <label for="">4. Razón social del Importador</label>
                            </div>
                    </div>
                    <div class="row">
                        <div class="input-field">
                            <input id="DireccionImp" type="text" class="validate" value="" required>
                            <label for="">Dirección</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col l6 s6">
                            <input id="TelefonoImp" type="text" class="validate" value="" required>
                            <label for="">Teléfono</label>
                        </div>
                        <div class="input-field col l6 s6">
                            <input id="CorreoImp" type="text" class="validate minusc" value="" required>
                            <label for="">Correo electrónico:</label>
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
                            <table class="center responsive-table">
                                <thead>
                                    <tr>
                                        <th class="descripcion">5. Descripción de las mercancias</th>
                                        <th class="valorfactura">6. Clasificación Arancelaria</th>
                                        <th class="valorfactura">7. Criterio preferencial</th>
                                        <th class="valorfactura">8. Valor Contenido Regional</th>
                                        <th class="" style="width: 20%;">9. Factura No. / Fecha</th>
                                        <th class="valorfactura">10. País de origen</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="descripcion">
                                            <input id="varmodificando" type="" class="oculto" maxlength="3" value=""
                                                style="width:20px!important;" />
                                            <textarea id="DescMercancia" maxlength="160"></textarea>
                                        </td>
                                        <td class="center valorfactura mayusc"><input id="ClasiArancelaria" type=""
                                                class="valorfactura" maxlength="6" value="" />
                                        </td>
                                        <td class="center">
                                            <select id="CritPreferencial" class="">
                                                <option value="A" selected>A</option>
                                                <option value="B(i)">B(i)</option>
                                                <option value="B(ii)">B(ii)</option>
                                                <option value="C">C</option>
                                            </select>
                                        </td>
                                        <td class="center valorfactura"><input id="ValConRegional" type=""
                                                class="valorfactura mayusc" value="" /></td>
                                        <td class="center "><input id="FacturaNoDesc" type=""
                                                class="valorfactura mayusc" value="" />
                                            <input id="FechaDesc" type="date" class="fechams" value="" /></td>

                                        <td class="center">
                                            <input id="PaisdeOrigen" disabled class="center" style="width:50px;" type=""
                                                value="CO" />
                                        </td>
                                        <td>
                                            <button title="Agregar nuevo item" href="#" id="agregar"
                                                class="btn waves-effect waves-light"><i
                                                    class="material-icons">add</i></button>
                                            <div title="Aceptar cambios" href="#" id="modificar"
                                                class=" oculto btn blue waves-effect waves-light">
                                                <i class="material-icons">check</i></div>
                                            <div title="Cancelar" href="#" id="cancelar"
                                                class=" oculto btn orange waves-effect waves-light">
                                                <i class="material-icons">cancel</i></div>
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
            <!-- SECCION PERSONA QUE AUTORIZA-->
            <div class="row">
                <div class="cuadro col l12">
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
                        <div class="input-field col l4 m12 s12">
                            <input id="EmpresaAutoriza" class="validate" type="text" value="" required>
                            <label for="">Empresa</label>
                        </div>
                        <div class="input-field col l4 m12 s4">
                            <input id="CargoPersonAutoriza" type="text" class="validate" value="" required>
                            <label for="">Cargo</label>
                        </div>
                        <div class="input-field col l2 m12 s2">
                            <input id="TelPersonAutoriza" type="text" class="validate" value="" required>
                            <label for="">Telefono</label>
                        </div>
                        <div class="input-field col l2 s2">
                            <input id="FaxPersonAutoriza" type="text" class="validate" value="" required>
                            <label for="">Fax:</label>
                        </div>
                    </div>
                </div>
            </div>
            <!--  OBSERVACIONES -->
            <section>
                <div class="row ">
                    <div class="col l12 m12 s12 cuadro ">
                        <div class="input-field">
                            <textarea id="Observaciones" type="" class="materialize-textarea"> </textarea>
                            <label for="">12. Observaciones</label>
                        </div>
                    </div>
                </div>
            </section>
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
        <div id="resultado"></div>
        <div id="footer" class="cuadrado"></div>
        <script src="../assets/js/materialize.min.js"></script>
</body>

</html>