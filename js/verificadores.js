/* Funcion que verifica el numero seleccionado de Visitantes, recarga la pagina con
*  numero de filas igual al umero seleccionado en la tabla de visitantes*/

function verficarNumeroDeVisitantes(opcion) {
    num= opcion.value;
    var url = '/ControlIngreso_Pruebas/views/registroExternos.php';
    url += '?num='+num
    window.location.href = url;
}


/* Verifica si en la relacion con la empresa se selecciona Otro paea habilitar
*  cuadro de texto */
function verificarTipo(opcion){
    otro=document.getElementById("divOtro");
    if(opcion.value=="Otro"){
        otro.hidden="";
        otro.style.visibility="visible";
    }else{
        otro.hidden="hidden";
        otro.style.visibility="hidden";
    }
}