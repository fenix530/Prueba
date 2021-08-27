<?php 
include_once '../models/ConxionBD.php';
require '../src/PHPExcel/Classes/PHPExcel.php';
$archivo = '../media/archivos/prueba.xlsx';
$excel = PHPExcel_IOFactory::load($archivo);
$excel->setActiveSheetIndex(0);
$periodo=$_POST['year'].$_POST['mes'];
$programa=$_POST['programa'];
$numFilas = $excel->setActiveSheetIndex(0)->getHighestRow();
$query = "INSERT INTO [dbo].[FiestaLibroyCultura] ([Tipo Documento],[Numero Documento],[Nombre Completo],[Genero],[Fecha Nacimiento],[Edad],[Categoria de Afiliacion],[Numero Contacto],[Correo Electronico],[Institucion],[Codigo Dane institucion],[Grado Escolaridad],[Fecha de Evento],[Hora Inicio],[Hora Fin],[Nombre Evento],[Producto],[Plataforma Digital],[Sede],[Municipio],[Negocio],[Subregion],[Convenio],[Valor Pagado],[Costo],[Valor Subsidio],[Servicio Superintendencia],[Modalidad Superintendencia],[Periodo],[Usuario]) VALUES";
$numrows=0;
$usuario=str_replace("comfama\\","",shell_exec('whoami'));
if( $conn === false ) {
    $msg='<div class="alert alert-danger">
			<strong><i class="fas fa-times"></i>    Error de Conexión!</strong> no se ha podido conectar con  la Base de Datos, verifique si tiene ecceso y/o que la VPN este activa.
            </div>';
    echo $msg;
    die;
}
$queryR="SELECT  COUNT(*) as cuenta FROM [VTRAZADORAS].[dbo].[FiestaLibroyCultura] Where [Periodo]='".$periodo."'";
$stmt2 = sqlsrv_query($conn, $queryR);
$rowR = sqlsrv_fetch_array( $stmt2, SQLSRV_FETCH_ASSOC);

if($rowR['cuenta']>0){
    $queryR="DELETE FROM [dbo].[FiestaLibroyCultura] WHERE [Periodo]='".$periodo."'";
    $stmt2 = sqlsrv_query($conn, $queryR);
}
sqlsrv_free_stmt($stmt2);


for($i=2;$i<=$numFilas;$i++){
    $tipoDoc=$excel->setActiveSheetIndex(0)->getCell('A'.$i)->getCalculatedValue();
    $id=$excel->setActiveSheetIndex(0)->getCell('B'.$i)->getCalculatedValue();
    $nombre=$excel->setActiveSheetIndex(0)->getCell('C'.$i)->getCalculatedValue();
    $genero=$excel->setActiveSheetIndex(0)->getCell('D'.$i)->getCalculatedValue();
    $fecha=$excel->setActiveSheetIndex(0)->getCell('E'.$i)->getCalculatedValue();
    $fechaNacimiento = \PHPExcel_Style_NumberFormat::toFormattedString($fecha, 'YYYY/MM/DD');
    $edad=$excel->setActiveSheetIndex(0)->getCell('F'.$i)->getCalculatedValue();
    $categoria=$excel->setActiveSheetIndex(0)->getCell('G'.$i)->getCalculatedValue();
    $numContacto=$excel->setActiveSheetIndex(0)->getCell('H'.$i)->getCalculatedValue();
    $correo=$excel->setActiveSheetIndex(0)->getCell('I'.$i)->getCalculatedValue();
    $institucion=$excel->setActiveSheetIndex(0)->getCell('J'.$i)->getCalculatedValue();
    $codDaneInsti=$excel->setActiveSheetIndex(0)->getCell('K'.$i)->getCalculatedValue();
    $escolaridad=$excel->setActiveSheetIndex(0)->getCell('L'.$i)->getCalculatedValue();
    $fechaEvento=$excel->setActiveSheetIndex(0)->getCell('M'.$i)->getCalculatedValue();
    $horaInicio=$excel->setActiveSheetIndex(0)->getCell('N'.$i)->getCalculatedValue();
    $horaFin=$excel->setActiveSheetIndex(0)->getCell('O'.$i)->getCalculatedValue();
    $nomEvento=$excel->setActiveSheetIndex(0)->getCell('P'.$i)->getCalculatedValue();
    $producto=$excel->setActiveSheetIndex(0)->getCell('Q'.$i)->getCalculatedValue();
    $plataformaDig=$excel->setActiveSheetIndex(0)->getCell('R'.$i)->getCalculatedValue();
    $sede=$excel->setActiveSheetIndex(0)->getCell('S'.$i)->getCalculatedValue();
    $municipio=$excel->setActiveSheetIndex(0)->getCell('T'.$i)->getCalculatedValue();
    $negocio=$excel->setActiveSheetIndex(0)->getCell('U'.$i)->getCalculatedValue();
    $subRegion=$excel->setActiveSheetIndex(0)->getCell('V'.$i)->getCalculatedValue();
    $convenio=$excel->setActiveSheetIndex(0)->getCell('W'.$i)->getCalculatedValue();
    $pagado=$excel->setActiveSheetIndex(0)->getCell('X'.$i)->getCalculatedValue();
    $costo=$excel->setActiveSheetIndex(0)->getCell('Y'.$i)->getCalculatedValue();
    $vlrSubsidio=$excel->setActiveSheetIndex(0)->getCell('Z'.$i)->getCalculatedValue();
    $srvSuper=$excel->setActiveSheetIndex(0)->getCell('AA'.$i)->getCalculatedValue();
    $modSuper=$excel->setActiveSheetIndex(0)->getCell('AB'.$i)->getCalculatedValue();
    $numrows=$numrows+1;
    if($i==$numFilas or $numrows==1000){
        $query = $query."('".$tipoDoc."','".$id."','".$nombre."','".$genero."','".$fechaNacimiento."','".$edad."','".$edad."','".$numContacto."','".$correo."','".$institucion."','".$codDaneInsti."','".$escolaridad."','".$fechaEvento."','".$horaInicio."','".$horaFin."','".$nomEvento."','".$producto."','".$plataformaDig."','".$sede."','".$municipio."','".$negocio."','".$subRegion."','".$convenio."','".$pagado."','".$costo."','".$vlrSubsidio."','".$srvSuper."','".$modSuper."','".$periodo."','".$usuario."');";
        $stmt = sqlsrv_query($conn, $query);
        $query = "INSERT INTO [dbo].[FiestaLibroyCultura] ([Tipo Documento],[Numero Documento],[Nombre Completo],[Genero],[Fecha Nacimiento],[Edad],[Categoria de Afiliacion],[Numero Contacto],[Correo Electronico],[Institucion],[Codigo Dane institucion],[Grado Escolaridad],[Fecha de Evento],[Hora Inicio],[Hora Fin],[Nombre Evento],[Producto],[Plataforma Digital],[Sede],[Municipio],[Negocio],[Subregion],[Convenio],[Valor Pagado],[Costo],[Valor Subsidio],[Servicio Superintendencia],[Modalidad Superintendencia],[Periodo],[Usuario]) VALUES";
        $numrows=0;
    }else{
        $query = $query."('".$tipoDoc."','".$id."','".$nombre."','".$genero."','".$fechaNacimiento."','".$edad."','".$edad."','".$numContacto."','".$correo."','".$institucion."','".$codDaneInsti."','".$escolaridad."','".$fechaEvento."','".$horaInicio."','".$horaFin."','".$nomEvento."','".$producto."','".$plataformaDig."','".$sede."','".$municipio."','".$negocio."','".$subRegion."','".$convenio."','".$pagado."','".$costo."','".$vlrSubsidio."','".$srvSuper."','".$modSuper."','".$periodo."','".$usuario."'),";
    }
}

sqlsrv_free_stmt($stmt);
if( $stmt === false ) {
    $msg='<div class="alert alert-danger">
			<strong><i class="fas fa-times"></i>    Error de Subiendo Información!</strong> detalle error:'.sqlsrv_errors().'
            </div>';
    echo $msg;
    die;
}
$msg='<div class="alert alert-success">
			<strong><i class="fas fa-check"></i>    Completado!</strong> Los datos han sido guardados con exito en la base de datos
			</div>';


//Recipiente
$to = 'diegoorozco@comfama.com.co';

//remitente del correo
$from = 'diegoorozco@comfama.com.co';
$fromName = 'Carga Archivos';

//Asunto del email
$subject = 'Se ha cargado archivo exitosamente'; 

//Ruta del archivo adjunto
$file = '../media/archivos/prueba.xlsx';

//Contenido del Email
$htmlContent = '<h3>Se ha subido informacion para el programa '.$programa.' y periodo '.$periodo.', este ha sido cargado por el usario: '.$usuario.'</h3>
    <p>Adjunto encontrara el archivo cargado.</p>';

//Encabezado para información del remitente
$headers = "De: $fromName"." <".$from.">";

//Limite Email
$semi_rand = md5(time()); 
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x"; 

//Encabezados para archivo adjunto 
$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 

//límite multiparte
$message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
"Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n"; 

//preparación de archivo
if(!empty($file) > 0){
    if(is_file($file)){
        $message .= "--{$mime_boundary}\n";
        $fp =    @fopen($file,"rb");
        $data =  @fread($fp,filesize($file));

        @fclose($fp);
        $data = chunk_split(base64_encode($data));
        $message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" . 
        "Content-Description: ".basename($files[$i])."\n" .
        "Content-Disposition: attachment;\n" . " filename=\"".$periodo."-".basename($file)."\"; size=".filesize($file).";\n" . 
        "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
    }
}
$message .= "--{$mime_boundary}--";
$returnpath = "-f" . $from;

//Enviar EMail
mail($to, $subject, $message, $headers, $returnpath);

echo $msg;

?>