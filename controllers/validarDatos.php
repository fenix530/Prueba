<?php
    require '../src/PHPExcel/Classes/PHPExcel.php';
    $archivo='../media/archivos/prueba.xlsx';
    $excel= PHPExcel_IOFactory::load($archivo);
    $excel->setActiveSheetIndex(0);
    $errores='';
    $error=0;
    $numFilas=$excel->setActiveSheetIndex(0)->getHighestRow();
    $ERFecha="/^([0-2][0-9]|(3)[0-1])(\/)(((0)[0-9])|((1)[0-2]))(\/)\d{4}$/";
    for($i=2;$i<=$numFilas;$i++){
        $celda=$excel->setActiveSheetIndex(0)->getCell('E'.$i)->getCalculatedValue();
        $stringDate = \PHPExcel_Style_NumberFormat::toFormattedString($celda, 'DD/MM/YYYY');
        if(preg_match($ERFecha, $stringDate)=='1'){}
        else{
            $error=1;
            $errores=$errores.'<br> Error en la fila '.$i.', en la columna Fecha,';
        }
    }
    if($error==0){
        $msg='<div class="alert alert-success">
			<strong><i class="fas fa-check"></i>    Validado!</strong> Los datos han sido validados con Exito, puedes subir la informacion
			</div>';
    }
    else{
        $msg='<div class="alert alert-danger">
			<strong><i class="fas fa-times"></i>    Se han encontrdo los siguientes Errores!</strong> '.$errores.' <br> Corrigalos e intentelo de nuevo
			</div>';
    }
    echo $msg;
?>