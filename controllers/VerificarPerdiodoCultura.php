<?php
include_once '../models/ConxionBD.php';
$periodo=$_POST['year'].$_POST['mes'];
if( $conn ) {
    
}else{
    $msg='<div class="alert alert-danger">
			<strong><i class="fas fa-times"></i>    Error de Conexión!</strong> no se ha podido conectar con  la Base de Datos, verifique si tiene ecceso y/o que la VPN este activa.
            </div>';
    echo $msg;
    die;
}
$query="SELECT  COUNT(*) as cuenta FROM [VTRAZADORAS].[dbo].[FiestaLibroyCultura] Where [Periodo]='".$periodo."'";
$stmt = sqlsrv_query($conn, $query);
$row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
sqlsrv_free_stmt($stmt);
if($row['cuenta']>0){
    $msg="FeriaLibro";
}
else{
    $msg="";
}
echo $msg;
?>