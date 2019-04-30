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
    <title>CO - Canada</title>
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
            <div class="col l12 m12 s12 pink darken-2 center titulo">
                Certificado de Origen Canada
            </div>
        </div>
        <!-- ****************** -->
        <form>
            <div>
                <!-- FORMULARIO -->
                <div class="row">
                    <div class="">
                        <label for="">DO:</label>
                        <input id="operacion" type="" value="" style="width=:50px;" maxlength="20" required>
                    </div>
                </div>
                <!-- SECCION 1 EXPORTADOR -->
                <div class="row ">
                    <section>
                        <div class=" col l6 s12 cajas ">
                            <div class="row">
                                <div class="input-field">
                                    <input id="nombreexp" class="validate" type="text" value="" required>
                                    <label for="">1. Razón social exportador</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field">
                                    <input id="direccionexp" class="validate" type="text" value="" required>
                                    <label for="">Dirección</label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col l6 s12">
                                    <input id="telefonoexp" type="text" class="validate" value="" required>
                                    <label for="">Teléfono</label>
                                </div>
                                <div class="input-field col l6 s12">
                                    <input id="faxexp" type="text" class="validate" value="" required>
                                    <label for="">Fax:</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col l6 s12">
                                    <input id="correoexp" type="text" class="validate" value="" required>
                                    <label for="">Correo electrónico:</label>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- SECCION 2 PERIODO CUBIERTO -->
                    <section>
                        <div class="col l6 s12 cajas" style="height:281px;">
                            <div class="row">
                                <div class="input-field s12">
                                    <p>2. Periodo que cubre</p>
                                    <p>Desde:
                                        <input id="fechadesde" class="fechams" type="date" value="" required>
                                    </p>
                                    <p>Hasta:
                                        <input id="fechahasta" class="fechams" type="date" value="" required>
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
                                    <input id="nombrepro" type="text" class="validate" value="" required>
                                    <label for="">3. Razon social del Productor</label>
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
                                    <label for="">Fax:</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col l6 s6">
                                    <input id="correopro" type="text" class="validate" value="" required>
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
                                    <input id="nombreimp" type="text" class="validate" value="" required>
                                    <label for="">4. Razón social del Importador</label>
                                </div>
                        </div>
                        <div class="row">
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
                                <label for="">Fax:</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col l6 s6">
                                <input id="correoimp" type="text" class="validate" value="" required>
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
                                            <th class="valorfactura">8. Productor</th>
                                            <th class="valorfactura">9. Prueba de Valor</th>
                                            <th class="valorfactura">10. País de origen</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="descripcion">
                                                <textarea id="descmercancia" maxlength="160"></textarea>
                                            </td>
                                            <td class="center valorfactura">
                                                <input id="clasiarancelaria" type="" class="valorfactura" maxlength="6"
                                                    value="" />
                                            </td>
                                            <td class="center valorfactura">
                                                <input id="critpreferencial" type="" class="valorfactura" maxlength="10"
                                                    value="" />
                                            </td>
                                            <td class="center valorfactura"><input id="productor" type=""
                                                    class="valorfactura" value="" /></td>
                                            <td class="center"><input id="pruebadevalor" type="" class="valorfactura"
                                                    value="" /></td>

                                            <td class="center">
                                                <input id="paisdeorigen" disabled class="valorfactura" type=""
                                                    maxlength="1" value="PAIS ORIGEN" />
                                                <!-- <select id="criterorigen" name="" class="validate">
                                                    <option value="A" selected>A</option>
                                                    <option value="B">B</option>
                                                    <option value="C">C</option>
                                                </select> -->
                                            </td>
                                            <td>
                                                <div href="#" id="agregar" class="btn waves-effect waves-light"><i
                                                        class="material-icons left">add</i></div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </section>

                        <!-- ************** TABLA DESCRIPCION MERCANCIAS*************-->
                        <div class="row">
                            <table id="descripcionmercancia" class="highlight responsive-table striped bordered">
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
                                <textarea id="observaciones" type="" class="materialize-textarea"> </textarea>
                                <label for="">11. Observaciones</label>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- SECCION PERSONA QUE AUTORIZA-->
                <div class="row">
                    <div class="cuadro col l12">
                        <div class="row">
                            <div class="col l12 s12">
                                <p>
                                    <label for="">Fecha elaboración:</label>
                                    <input id="fechaelabora" class="fechams" type="date" value="" required>
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col l4 m12 s12">
                                <input id="nombreautoriza" class="validate" type="text" value="" required>
                                <label for="">Nombre persona que autoriza:</label>
                            </div>
                            <div class="input-field col l4 m12 s4">
                                <input id="empresaautoriza" type="text" class="validate" value="" required>
                                <label for="">Empresa:</label>
                            </div>
                            <div class="input-field col l4 m12 s4">
                                <input id="cargopersonautoriza" type="text" class="validate" value="" required>
                                <label for="">Cargo</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col l2 m12 s2">
                                <input id="telpersonautoriza" type="text" class="validate" value="" required>
                                <label for="">Telefono</label>
                            </div>
                            <div class="input-field col l2 s2">
                                <input id="faxpersonautoriza" type="text" class="validate" value="" required>
                                <label for="">Fax:</label>
                            </div>
                            <div class="input-field col l2 s2">
                                <input id="correopersonautoriza" type="text" class="validate" value="" required>
                                <label for="">Correo electrónico:</label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- SECCION FINAL - BUTTONS -->
                <section>
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
                </section>
            </div>
        </form>
        <div id="resultado"></div>
        <div id="footer" class="cuadrado"></div>
        <script src="../js/materialize.min.js"></script>
</body>

</html>