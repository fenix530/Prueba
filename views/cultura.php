<!DOCTYPE html>
<?php
    date_default_timezone_set('America/Bogota');
    $mes = date("m");
    $año=date("Y");
    if($mes=='01'){
        $mes=12;
        $año=$año-1;
    }else{
        $mes=$mes-1;
    }
?>
<html lang="en" dir="ltr">
<head>
    <!-- Incluyendo archivo con Link y Scripts de Cabecera -->
    <?php include_once 'linkScripts.php'?>
    <meta charset="utf-8">
    <title> Cultura </title>
       

</head>
<body class="bg-dark">
    <!-- Inlcuyendo Navbar -->
    <?php include 'navbar.php' ?>    
    <div class="container">
        <div class="text-center text-white">
            <h3 class="title mt-3 mx-auto">Bienvenido, seleccione la opción deseada</h3>
        </div>
        <div class="row mt-3" >
            <div class="col-md">
                <div class="card mb-4 box-shadow">
                    <div class="card-header">
                        <div class="row ml-auto d-flex justify-content-between mr-3">
                            <h4 class="my-0 font-weight-normal" id="programa">Feria del Libro y la Cultura</h4>
                            <div class="row">
                                <i class="fas fa-check-circle fa-2x mr-3 success" style="color:green" id="checkFeriaLibro" hidden></i>
                                <a class="fas fa-2x fa-file-download ml-6" href="../media/plantillas/PlantillaFeriaDelLibro.xlsx" title="Descargar Plantilla" download="PlantillaFeriaDelLibro.xlsx"></a>
                            </div>                            
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="">Descripcion de la Opcion</p>
                        <div align="center" id="cargando" hidden>
                            <img src="../media/img/Cargando.gif" width="50" height="50">
                        </div> 
                        <div id="mensaje" hidden>
                        </div>
                        <form action="#" method="post" enctype="multipart/form-data" id="formulario" >
                            <label class="label" for="periodo">Selecciones el Periodo que desea Cargar:</label>
                            <div class="input-group perio" id="periodo">
                                <select class="form-control mr-3 " id="mes" required >
                                    <option value="01" <?php if($mes=='01'){ echo "selected";} ?> >1-Enero</option>
                                    <option value="02" <?php if($mes=='02'){ echo "selected";} ?> >2-Febrero</option>
                                    <option value="03" <?php if($mes=='03'){ echo "selected";} ?> >3-Marzo</option>
                                    <option value="04" <?php if($mes=='04'){ echo "selected";} ?> >4-Abril</option>
                                    <option value="05" <?php if($mes=='05'){ echo "selected";} ?> >5-Mayo</option>
                                    <option value="06" <?php if($mes=='06'){ echo "selected";} ?> >6-Junio</option>
                                    <option value="07" <?php if($mes=='07'){ echo "selected";} ?> >7-Julio</option>
                                    <option value="08" <?php if($mes=='08'){ echo "selected";} ?> >8-Agosto</option>
                                    <option value="09" <?php if($mes=='09'){ echo "selected";} ?> >9-Septiembre</option>
                                    <option value="10" <?php if($mes=='10'){ echo "selected";} ?> >10-Octubre</option>
                                    <option value="11" <?php if($mes=='11'){ echo "selected";} ?> >11-Noviembre</option>
                                    <option value="12" <?php if($mes=='12'){ echo "selected";} ?> >12-Diciembre</option>
                                </select>
                                <input name="year" id="year" type="number" required class="form-control ml-3" placeholder="Año" value= "<?php echo $año ?>">
                            </div>
                            <div class="input-group mt-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="archivo" name="archivo" accept=".xlsx" required>
                                    <label class="custom-file-label" for="archivo">Elegir archivo...</label>
                                </div>
                            </div>
                            <div class="btn-group w-100 mt-3">
                                <button type="submit" class="btn btn-lg btn-outline-primary" id="upload" > <span class="fas fa-upload"></span> Cargar Archivo</button>
                                <button class="btn btn-lg btn-outline-primary ml-3" id="validar" disabled> <span class="fas fa-check-double"></span> Validar Datos</button>
                                <button class="btn btn-lg btn-outline-primary ml-3" id="subirInf" disabled> <span class="fas fa-cloud-upload-alt"></span> Subir Informacion</button>
                            </div>
                        </form>                        
                    </div>
                </div>
                <div class="card mb-4 box-shadow">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal">Opción 1</h4>
                    </div>
                    <div class="card-body">
                        <a> Desccipción de la Opcion</a>
                        <form action="sube.php" method="post" enctype="multipart/form-data" >
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile01">
                                    <label class="custom-file-label" for="inputGroupFile01" id="label" >Elegir archivo...</label>
                                </div>
                            </div>
                            <br><br>
                            <button type="submit">Subir Archivo</button>
                        </form>
                        <a type="button" href="" class="btn btn-lg btn-block btn-outline-primary mt-3">Entrar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            bsCustomFileInput.init();

            var mes = $("#mes").val();
            var year = $("#year").val();   
            $.ajax({
                type:'POST', //aqui puede ser igual get
                url: '../controllers/VerificarPerdiodoCultura.php',//aqui va tu direccion donde esta tu funcion php
                data: {mes:mes,year:year},//aqui tus datos
                success:function(data){
                    if(data.includes("FeriaLibro")) {
                        document.getElementById("checkFeriaLibro").hidden=false;
                    }else{
                        document.getElementById("checkFeriaLibro").hidden=true;
                    }                                          
                },
                error:function(data){
                    //lo que devuelve si falla tu archivo mifuncion.php
                }
            });      
            
            $("#archivo" ).change(function() {
                if (!$('#checkFeriaLibro').is(':hidden')){
                    document.getElementById("mensaje").hidden=false;
                    document.getElementById('mensaje').innerHTML='<div class="alert alert-warning"> <strong><i class="fas fa-exclamation-triangle"></i>    Atención!</strong> ya se han cargado datos para el periodo seleccionado, si desea reemplazar la informacion continue con el proceso. </div>';
                }                
            });

            $("#formulario").on('submit', function(evt) {
                evt.preventDefault();
                document.getElementById("cargando").hidden=false;
                var formData = new FormData();
                var files = $('#archivo')[0].files[0];
                formData.append('file',files);
                $.ajax({
                    url: '../controllers/SubirArchivo.php',
                    type: 'post',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        if(data.includes("Error")) {
                            document.getElementById("mensaje").hidden=false;
                            document.getElementById('mensaje').innerHTML=data;
                            document.getElementById('mes').disabled=false;
                            document.getElementById('year').disabled=false;
                            document.getElementById('archivo').disabled=false;
                        }
                        else{
                            document.getElementById("mensaje").hidden=false;
                            document.getElementById('mensaje').innerHTML=data;
                            document.getElementById("validar").disabled = false;
                            document.getElementById("upload").disabled = true;
                            document.getElementById("cargando").hidden=true;
                            document.getElementById('mes').disabled=true;
                            document.getElementById('year').disabled=true;
                            document.getElementById('archivo').disabled=true;
                        }     
                    },
                    error:function(data){
                        //lo que devuelve si falla tu archivo mifuncion.php
                    }
                });   
                return false;              
            });

            $("#validar").on('click', function() {
                document.getElementById("mensaje").hidden=true;
                document.getElementById("cargando").hidden=false;      
                $.ajax({
                    type:'POST', //aqui puede ser igual get
                    url: '../controllers/validarDatos.php',//aqui va tu direccion donde esta tu funcion php
                    data: {id:1,otrovalor:'valor'},//aqui tus datos
                    success:function(data){
                        if(data.includes("Error")) {
                            document.getElementById("mensaje").hidden=false;
                            document.getElementById('mensaje').innerHTML=data;
                            document.getElementById("validar").disabled = true;
                            document.getElementById("upload").disabled = false;
                            document.getElementById("cargando").hidden=true;
                            document.getElementById("archivo").value='';
                            document.getElementById("label").innerHTML='Elegir archivo...';
                            document.getElementById('mes').disabled=false;
                            document.getElementById('year').disabled=false;
                            document.getElementById('archivo').disabled=false;
                        }else
                        {
                            document.getElementById("mensaje").hidden=false;
                            document.getElementById('mensaje').innerHTML=data;
                            document.getElementById("validar").disabled = true;
                            document.getElementById("subirInf").disabled = false;
                            document.getElementById("cargando").hidden=true;
                        }                        
                    },
                    error:function(data){
                        //lo que devuelve si falla tu archivo mifuncion.php
                    }
                });
            return false;
            });

            $("#subirInf").on('click', function() {
                document.getElementById("mensaje").hidden=true;
                document.getElementById("cargando").hidden=false;
                var mes = $("#mes").val();
                var year = $("#year").val();
                var programa=document.getElementById('programa').innerHTML;
                $.ajax({
                    type:'POST', //aqui puede ser igual get
                    url: '../controllers/SubirInformacion.php',//aqui va tu direccion donde esta tu funcion php
                    data: {mes:mes,year:year,programa:programa},//aqui tus datos
                    success:function(data){
                        if(data.includes("Error")) {
                            document.getElementById("mensaje").hidden=false;
                            document.getElementById('mensaje').innerHTML=data;
                            document.getElementById("validar").disabled = true;
                            document.getElementById("upload").disabled = false;
                            document.getElementById("cargando").hidden=true;
                            document.getElementById("subirInf").disabled = true;
                            document.getElementById("archivo").value='';
                            document.getElementById("label").innerHTML='Elegir archivo...';
                            document.getElementById('mes').disabled=false;
                            document.getElementById('year').disabled=false;
                            document.getElementById('archivo').disabled=false;
                        }else
                        {
                            document.getElementById("mensaje").hidden=false;
                            document.getElementById('mensaje').innerHTML=data;
                            document.getElementById("upload").disabled = false;
                            document.getElementById("subirInf").disabled = true;
                            document.getElementById("cargando").hidden=true;
                            document.getElementById("archivo").value='';
                            document.getElementById("label").innerHTML='Elegir archivo...';
                            document.getElementById("checkFeriaLibro").hidden=false;
                            document.getElementById('mes').disabled=false;
                            document.getElementById('year').disabled=false;
                            document.getElementById('archivo').disabled=false;
                        }                        
                    },
                    error:function(data){
                        //lo que devuelve si falla tu archivo mifuncion.php
                    }
                });
            return false;
            });

            $(".perio" ).change(function() {
                var mes = $("#mes").val();
                var year = $("#year").val();   
                $.ajax({
                    type:'POST', //aqui puede ser igual get
                    url: '../controllers/VerificarPerdiodoCultura.php',//aqui va tu direccion donde esta tu funcion php
                    data: {mes:mes,year:year},//aqui tus datos
                    success:function(data){
                        if(data.includes("FeriaLibro")) {
                            document.getElementById("checkFeriaLibro").hidden=false;
                        }else{
                            document.getElementById("checkFeriaLibro").hidden=true;
                        }                                          
                    },
                    error:function(data){
                        //lo que devuelve si falla tu archivo mifuncion.php
                    }
                });
                return false;
            });
        
        });
    </script>
    
</body>

</html>