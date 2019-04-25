<!DOCTYPE php>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="css/Estilos.css" />
    <link rel="stylesheet" href="css/materialize.min.css" />
    <script src="js/vendor/jquery.js"></script>
    <script src="js/main.js"></script>
</head>

<body>
    <div id="contenedor">

        <div class="row">
            <div class="col l12 m12 s12 light-blue lighten-1 center titulo">Certificado de Origen</div>
        </div>
        <!-- ****************** -->
        <div>
            <!-- FORMULARIO -->
            <!-- SECCION EXPORTADOR -->
            <div class="row ">
                <div class=" col l6 s12 cuadro">
                    <div class="row">
                        <div class="input-field">
                            <!-- -->
                            <input id="nombreexp" type="text" class="validate">
                            <label for="">1. Nombre del Exportador</label>

                        </div>
                    </div>
                    <div class="row ">
                        <div class="input-field">
                            <input id="direccionexp" type="text" class="validate">
                            <label for="">Dirección</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col l6 s6">
                            <input id="telefonoexp" type="text" class="validate">
                            <label for="">Teléfono</label>
                        </div>
                        <div class="input-field col l6 s6">
                            <input id="faxexp" type="text" class="validate">
                            <label for="">Fax</label>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="input-field col l6 s6">
                            <input id="correoexp" type="text" class="validate">
                            <label for="">Correo electrónico:</label>
                        </div>

                        <div class="input-field col l6 s6">
                            <input id="numregfiscalexp" type="text" class="validate">
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
                            <input id="nombrepro" type="text" class="validate">
                            <label for="">2. Nombre del Productor</label>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="input-field">
                            <input id="direccionpro" type="text" class="validate">
                            <label for="">Dirección</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col l6 s6">
                            <input id="telefonopro" type="text" class="validate">
                            <label for="">Teléfono</label>
                        </div>
                        <div class="input-field col l6 s6">
                            <input id="faxpro" type="text" class="validate">
                            <label for="">Fax</label>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="input-field col l6 s6">
                            <input id="correopro" type="text" class="validate">
                            <label for="">Correo electrónico:</label>
                        </div>

                        <div class="input-field col l6 s6">
                            <input id="numregfiscalpro" type="text" class="validate">
                            <label for="">No. Registro Fiscal</label>
                        </div>
                    </div>
                </div>
                <!-- SECCION IMPORTADOR -->
                <div class="cuadro col l6 m12 s12">
                    <div class="row">
                        <div class="input-field">
                            <input id="nombreimp" type="text" class="validate">
                            <label for="">3. Nombre del Importador</label>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="input-field">
                            <input id="direccionimp" type="text" class="validate">
                            <label for="">Dirección</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="input-field col l6 s6">
                            <input id="telefonoimp" type="text" class="validate">
                            <label for="">Teléfono</label>
                        </div>
                        <div class="input-field col l6 s6">
                            <input id="faximp" type="text" class="validate">
                            <label for="">Fax</label>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="input-field col l6 s6">
                            <input id="correoimp" type="text" class="validate">
                            <label for="">Correo electrónico:</label>
                        </div>

                        <div class="input-field col l6 s6">
                            <input id="numregfiscalimp" type="text" class="validate">
                            <label for="">No. registro fiscal</label>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class=" col l12 cuadro">
                
                    <div class="row center">
                    <table border="1"><thead>
                    
                    <tr>                                
                                <th>5. Descripción de las mercancias</th>
                                <th>6. Clasificación Arancelaria</th>
                                <th>7. No. Factura</th>
                                <th>8. Valor en Factura</th>
                                <th>9. Criterio de Origen</th>
                            </tr>
                            <tr><div class="col l4 "><textarea id="descmercancia" type="" placeholder="5. Descripción de las mercancias"class="descmercancia"></textarea></div>
                        <div class="col l2 "><input id="clasiarancelaria" type="" maxlenght="6" placeholder="6. Clasificación Arancelaria" class="" /></div>
                        <div class="col l2 "><input id="nofactura" type="" placeholder="7. No. Factura" class="" /></div>
                        <div class="col l1 "><input id="valorfactura" type="" placeholder="8. Valor en Factura " class="valorfactura" /></div>
                        <div class="col l1 center"><input id="criterorigen" type="" placeholder="9. Criterio de Origen" class="item" /></div>
                        <div class="col l1 center"><button href="#" id="agregar"
                                class="btagregar btn waves-effect waves-light">Agregar 
                                <i class="material-icons right">add_circle</i></button></div></tr>
            </thead>
            </table>
                        <!-- <div class="col l4 ">5. Descripción de las mercancias</div>
                        <div class="col l2 ">6. Clasificación Arancelaria</div>
                        <div class="col l2 ">7. No. Factura</div>
                        <div class="col l1 ">8. Valor en Factura </div>
                        <div class="col l1 ">9. Criterio de Origen</div> -->
                    </div>
                    <div class="row">

                        <!-- <div class="col l4 "><textarea id="descmercancia" type="" placeholder="5. Descripción de las mercancias"class="descmercancia"></textarea></div>
                        <div class="col l2 "><input id="clasiarancelaria" type="" maxlenght="6" placeholder="6. Clasificación Arancelaria" class="" /></div>
                        <div class="col l2 "><input id="nofactura" type="" placeholder="7. No. Factura" class="" /></div>
                        <div class="col l1 "><input id="valorfactura" type="" placeholder="8. Valor en Factura " class="valorfactura" /></div>
                        <div class="col l1 center"><input id="criterorigen" type="" placeholder="9. Criterio de Origen" class="item" /></div>
                        <div class="col l1 center"><button href="#" id="agregar"
                                class="btagregar btn waves-effect waves-light">Agregar 
                                <i class="material-icons right">add_circle</i></button></div> -->
                    </div>


                    <div class="row">
                        <!-- ************** TABLA *************-->
                        <table id="descripcionmercancia" class="highlight responsive-table">
                            <!-- <thead>
                                <tr>
                            <th>4. Item</th>
                            <th>5. Descripción de las mercancias</th>
                            <th>6. Clasificación Arancelaria</th>
                            <th>7. No. Factura</th>
                            <th>8. Valor en Factura</th>
                            <th>9. Criterio de Origen</th>
                        </tr> -->
                            </thead>
                            <tbody>                                

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!--  OBSERVACIONES -->
            <div class="row ">
                <div class="col l12  m12 s12 observaciones">
                    <div class="input-field">

                        <textarea id="observaciones" type="" class="materialize-textarea"></textarea>
                        <label for="">10. Observaciones</label>
                    </div>
                </div>
            </div>
            <!-- SECCION 11-->
            <div class="row ">
                <div class=" col l6 s12 m12 cuadro secc11">
                    <div class="row">
                        <p>11. Declaración del exportador:</p>
                        <p>El abajo firmante declara bajo juramento que la información consignada en este certificado de
                            origen es correcta y verdadera y que las mercancías fueron producidas en:
                        </p>
                    </div>
                    <div class="row ">
                        <p>
                            País: <input id="paisexp" disabled value="COLOMBIA" type="">
                        </p>
                        <p>y cumplen con las disposiciones del Capitulo 3 (Reglas de Origen y Procedimientos de Origen)
                            establecidas en el Tratado de Libre Comercio entre la República de Colombia y la República
                            de
                            Costa Rica y exportadas a:</p>
                        País de importación: <input id="paisimp" disabled value="COSTA RICA" type="">


                    </div>

                    <div class="row">
                        <div class=" col l4 s4">
                            <label for="">Lugar</label>
                            <input id="lugar" type="text" class="validate">

                        </div>
                        <div class="col l4 s4">
                            <label for="">Fecha</label>
                            <input id="fechaexp" type="date">
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
                        <!-- <p>Lugar y fecha, nombre y firma del funcionario y sello de la autoridad competente:</p> -->
                        <div class="row">
                            <div class=" col l4 s4">
                                <label for="">Lugar</label>
                                <input id="lugar" type="text" class="validate">

                            </div>
                            <div class="col l4 s4">
                                <label for="">Fecha</label>
                                <input id="fechaexp" type="date">
                            </div>
                        </div>
                        <div class="row ">
                            <div class="">
                                <label for="">Dirección</label>
                                <input id="direccionimp" type="" class="validate" style="width:415px">
                            </div>
                        </div>

                        <div class="row">
                            <!-- <div class=" col l6 s6"> -->
                            <label for="">Teléfono</label>
                            <input id="telefonoimp" type="" class="validate">
                            <!-- </div> -->
                            <!-- <div class="col l6 s6"> -->
                            <label for="">Fax</label>
                            <input id="faximp" type="" class="validate">
                            <!-- </div> -->
                        </div>
                        <div class="row ">
                            <div class="">
                                <label for="">Correo electrónico:</label>
                                <input id="correoimp" type="" class="validate">
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="row">
                <div class="col l12 center seccionboton">
                    <button class=" btn waves-effect waves-light" type="submit" id="btenviarform">Enviar
                        <i class="material-icons right">send</i>
                    </button>
                </div>
            </div>
        </div>
</body>
<script src="js/materialize.min.js"></script>

</html>