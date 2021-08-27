/* Complemento que agrega busqueda a la tabla con id #example y pone boton
*  para exportar la tabla en formato .xlsx*/
$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: {
            dom: {
                button: {
                    tag: 'button',
                    className: ''
                }
            },
            buttons: [{
                extend: 'excel',
                className: 'btn btn-success fas fa-file-excel',
                titleAttr: 'Excel export.',
                text: '  Exportar como Excel',
                filename: 'Reporte',
                extension: '.xlsx'
            }]
        }
    });
} );

/* Verificar si se selecciona una las opciones de sintomas para desactivar y desaparecer
* la opcion ninuguno */
function verificarCheckBoxMes() {
    fiebre=document.getElementById('fiebreM');
    estornudo=document.getElementById('EstornudosM');
    tos=document.getElementById('TosM');
    difRespirar=document.getElementById('DifRespirarM');
    malestar=document.getElementById('MalestarM');
    dolorCabeza=document.getElementById('DolorCabezaM');
    ninguno=document.getElementById('NingunoM');
    labelNinguno=document.getElementById('labaleNingunoM')
    if(fiebre.checked || estornudo.checked || tos.checked || difRespirar.checked || malestar.checked || dolorCabeza.checked){
        ninguno.checked=0
        ninguno.style.visibility="hidden"
        labelNinguno.style.visibility="hidden"
    }
    else{
        ninguno.style.visibility="visible"
        labelNinguno.style.visibility="visible"
        ninguno.checked=1
    }
}

/* Verificar si se selecciona una las opciones de sintomas para desactivar y desaparecer
* la opcion ninuguno */
function verificarCheckBox() {
    fiebre=document.getElementById('fiebre');
    tos=document.getElementById('Tos');
    difRespirar=document.getElementById('DifRespirar');
    malestar=document.getElementById('Malestar');
    ninguno=document.getElementById('Ninguno');
    labelNinguno=document.getElementById('labaleNinguno')
    if(fiebre.checked || tos.checked || difRespirar.checked || malestar.checked ){
        ninguno.checked=0
        ninguno.style.visibility="hidden"
        labelNinguno.style.visibility="hidden"
    }
    else{
        ninguno.style.visibility="visible"
        labelNinguno.style.visibility="visible"
        ninguno.checked=1
    }
}

/* Verificar si se selcciona el radio button Si para habilitar cuadro de texto */
function verificarFamiliar() {
    nomFamiliar=document.getElementById('nomFamiliar')
    txtFemiliar=document.getElementById('familiar')
    if($('input[name=tieneFamiliar]:checked').val()==1) {
        txtFemiliar.hidden=""
        txtFemiliar.style.visibility="visible"
    } else {
        nomFamiliar.value=""
        txtFemiliar.hidden="hidden"
        txtFemiliar.style.visibility="hidden"
    }
}



