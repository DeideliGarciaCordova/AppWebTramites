
<script>

  //combox de buscar tipo de comprobante 

  $('#txt1').select2({
        theme: 'bootstrap4',
        dataType: 'json',
        placeholder: 'Buscar tipo comprobante',
        ajax: { 
          type: 'POST',
          url: '<?php echo URL . '/entrada/b_tipocomprobante'; ?>',
        },
        cache: false
      });


    //combox de buscar bienes 

    $('#txt3').select2({
        theme: 'bootstrap4',
        dataType: 'json',
        placeholder: 'Buscar Bienes',
        ajax: { 
          type: 'POST',
          url: '<?php echo URL . '/entrada/b_bien'; ?>',
        },
        cache: false
      });



      //agrega articulos al detalle

var cont=0;
var detalles=0;
function agregarDetalle(idbien){
    var nombrebien=$('#txt3  option:selected').text();
    var idbien=$('#txt3  option:selected').val();
    //alert(nombrebien);exit;
  //alert(idproducto+ '  '+producto+ ' '+precio_compra);
   // idunidadmedida=$('#cbounidadmedida'+idproducto).val();
   //var um=$("#cbounidadmedida"+idproducto).text();
   // unidadmedida=$('#cbounidadmedida'+idproducto+' option:selected').html();
    //precio_compra=$('#tdprecio'+idproducto).html();

   var cantidad=1;
  var descuento=0;
 
  if (idbien!="") {
    var subtotal=cantidad*1;

                     
                                                             
     var fila='<tr class="filas" id="fila'+cont+'">'+
     '<td width="20"><button type="button" class="text-inverse btn" onclick="eliminarDetalle('+cont+')" style="margin: 0px;padding: 0px"><i class="text-danger fa-regular fa-trash-can"></i></button></td>'+
     '<td width="500"><input class="form-control form-control-sm w-100"  style="height: calc(1.4rem + 2px);" type="hidden" name="idbien[]" value="'+idbien+'">'+nombrebien+'</td>' +
     '<td width="100"><input class="form-control form-control-sm"  style="height: calc(1.4rem + 2px);" type="number" name="precio[]" id="precio[]" value="0" onchange="modificarSubtotales()"></td>' +
     '<td width="70"><input class="form-control form-control-sm"  style="height: calc(1.4rem + 2px);" type="number" name="cantidad[]" id="cantidad[]" value="1" onchange="modificarSubtotales()"></td>'+
     '<td  style="text-align: right;"><span id="subtotal'+cont+'" name="subtotal"> S/ '+subtotal.toFixed(2) + '</span></td>'+
   '</tr>';                                       

    cont++;
    detalles++;
    $('#detalles').append(fila);
    modificarSubtotales();

  }else{
    alert("error al ingresar el detalle, revisar las datos del articulo ");
  }
}



function modificarSubtotales(){
  //alert("Hola");
  var cant=document.getElementsByName("cantidad[]");
  var prec=document.getElementsByName("precio[]");
  //var desc=document.getElementsByName("descuento[]");
  var sub=document.getElementsByName("subtotal");


  for (var i = 0; i < cant.length; i++) {
    var cantidad=cant[i];
    var precio=prec[i];
    var inpS=sub[i];
    //var des=desc[i];
    inpS.value=(cantidad.value*precio.value);
    //inpS.value=(inpV.value*inpP.value)-des.value;

    document.getElementsByName("subtotal")[i].innerHTML=inpS.value.toFixed(2);
  }

  calcularTotales();
}


function calcularTotales(){
  var sub = document.getElementsByName("subtotal");
  var total=0.0;
 
  for (var i = 0; i < sub.length; i++) {
    total += document.getElementsByName("subtotal")[i].value;
  } 
  $("#h5total_valor").html("S/" + total.toFixed(2));
  $("#importe_total").val(total.toFixed(2));

}

//eliminar  fila de la tabla
function eliminarDetalle(indice){
$("#fila"+indice).remove();
calcularTotales();
calcular();
detalles=detalles-1;

}


//Agregar compra
$('#frmentrada').on('submit', function(e) {
 
         e.preventDefault();
         var serialize = $(this).serialize();
       
         $.post("<?php echo URL ?>/entrada/add", serialize, function(data, textStatus, jqXHR) {

              if (textStatus == 'success') {
                var json = jQuery.parseJSON(data);
                swal({
                    position: 'top-end',
                    title: json.msj,
                    icon: json.icon,
                    button: {
                        text: "Cerrar",
                        className: "btn btn-secondary btn-sm",
                        closeModal: true,
                    },
                });
                  setTimeout(function() {
                      location.reload(true);
                  }, 1000);
              }            

         });
    });

</script>