<?php
$nombre='prueba.xlsx';
$guardado=$_FILES['file']['tmp_name'];
$msgt="hola";

if(!file_exists('../media/archivos')){
	mkdir('../media/archivos',0777,true);
	if(file_exists('../media/archivos')){
		if(move_uploaded_file($guardado, '../media/archivos/'.$nombre)){
			$msgt='<div class="alert alert-success">
			<strong><img src="../media/img/cloud-check.svg" alt="" width="25" height="25" >  Correcto!</strong> Carga del Archivo correcto
			</div>';
		}else{
			$msgt='<div class="alert alert-danger">
			<strong><img src="../media/img/cloud-slash.svg" alt="" width="25" height="25" >    Error!</strong> Error al cargar el archivo, intentelo nuevamente
			</div>';
		}
	}
}else{
	if(move_uploaded_file($guardado, '../media/archivos/'.$nombre)){
		$msgt='<div class="alert alert-success">
		<strong><img src="../media/img/cloud-check.svg" alt="" width="25" height="25" >  Correcto!</strong> Carga del Archivo correcto
		</div>';
	}else{
		$msgt='<div class="alert alert-danger">
		<strong><img src="../media/img/cloud-slash.svg" alt="" width="25" height="25" >    Error!</strong> Error al cargar el archivo, intentelo nuevamente
		</div>';
	}
}
echo $msgt;
?>