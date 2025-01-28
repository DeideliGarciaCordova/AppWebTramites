
<script>

var url = "<?php echo URL . '/' . $this->archivo ?>";

 $('#txt1').select2({
        theme: 'bootstrap4',
        dataType: 'json',
        placeholder: 'Buscar Chofer',
        ajax: { 
          type: 'POST',
          url: '<?php echo URL . '/salida/b_chofer'; ?>',
        },
        cache: false
    });

    $('#txt2').select2({
        theme: 'bootstrap4',
        dataType: 'json',
        placeholder: 'Buscar Vehiculo',
        ajax: { 
          type: 'POST',
          url: '<?php echo URL . '/salida/b_vehiculo'; ?>',
        },
        cache: false
    });   

    
    $('#txt3').select2({
        theme: 'bootstrap4',
        dataType: 'json',
        placeholder: 'Buscar Tipo de Bien',
        ajax: { 
          type: 'POST',
          url: '<?php echo URL . '/salida/b_bien'; ?>',
           
        },
        cache: false
    });


    //ALERTA POR FALTA DE STOCK
    $( "#txt3" ).on( "change", function() {
       // alert($(this).val());
        var datos={'id':$(this).val()};
        $.post("<?php echo URL ?>/salida/mostrar_bien", datos, function(data, textStatus, jqXHR) {
               var json=JSON.parse(data);
               if(json.bie_stock<=10){
                swal("SU STOCK ESTA APUNTO DE ACABARSE","solo cuenta con " + json.bie_stock+ " Unidades" ,"warning");
               }
            
        });
    } );

    function fn_editar(e,id) {
        //alert(id); 
        var btn = $(e);
        btn.attr('disabled', true);
        btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
        var _url = url + '/edi/';

        $.get(_url, {
            id: id
        }, function (data, textStatus, jqXHR) {
            if (textStatus == 'success') {
                btn.attr('disabled', false);
                btn.html('<i class="fas fa-edit"></i>');
                $('#resp').html(data);
                $('#modalForm').modal('show');
                var idform = $('#idForm');
                idform.attr('data-action', _url);
                idform.attr('data-method', 'edi');
            }
        });
    }

    function fn_agregar(e) {
        var btn = $(e);
        btn.attr('disabled', true);
        btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Nuevo');
        var _url = url + '/add/';

        $.get(url + '/add/', function (data, textStatus, jqXHR) {
            if (textStatus == 'success') {
                btn.attr('disabled', false);
                btn.html('<i class="fa fa-plus"></i> Nuevo');
                $('#resp').html(data);
                $('#modalForm').modal('show');
                var idform = $('#idForm')
                idform.attr('data-action', _url);
                idform.attr('data-method', 'add');
            }
        });
    }2


    function anularregistro(e){

       // $(e).attr('disabled', true);
        var v2=$('#v2').val();

        if($.trim(v2)==""){
            alert("Ingrese el motivo de anulacion del registro");
            $('#v2').focus()
        }else{
            var datos = {
                v1: $('#v1').val(),
                v2: v2
            };
            $.post(url+"/anular", datos, function(data, textStatus, jqXHR) {
                location.reload();
                //alert(data);
            });
            
        }
    }
    /*$("#btnanular").click(function(e){
        e.preventDefault();
        $(this).attr('disabled', true);
        var v2=$('#v2').val();
       // console.log(v2);exit;
        if($.trim(v2)==""){
            alert("Ingrese el motivo de anulacion del registro");
            $('#v2').focus()
        }else{
            var datos = {
                v1: $('#v1').val(),
                v2: v2
            };

            alert("hola");
            $.post(url+"/anular", datos, function(data, textStatus, jqXHR) {
                //location.reload();
                //alert(data);
            });
            
        }
       
    })*/



    function fn_anular(e,id) {
        $("#v1").val(id);
        $("#modalanular").modal("show");
    };

    //para mostrar la obcervacion
    function fn_show(e,val) {
        
        swal({
            position: 'top-end',
            title:"MOTIVO  DE ANULACION: ",
            text:val,
            icon: 'warning',
            button: {
                text: "Cerrar",
                className: "btn btn-secondary btn-sm",
                closeModal: true,
            },
        });
    };

function  fn_validar(e){
    var form = $(e);

//alert(form.attr('data-method'));exit;
   var idvehiculo=$("#txt2").val();
   var idbien=$("#txt3").val();
   //alert(idvehiculo+'  '+idbien);
   var datos={'idvehiculo':idvehiculo,'idbien':idbien};
   $.post(url + '/verificar',datos,function(data,textStatus,jqXHR) {

        if(data!=1 && form.attr('data-method')=="add" ){
            //alert("HOla add");
            fn_enviar(form);
        }else if(form.attr('data-method')=="edi"){
            fn_enviar(form);
        }else{
                swal({
                    position: 'top-end',
                    title: "YA AGREGASTE COMBUSTIBLE EL DIA DE HOY A ESTE VEHICULO",
                    icon: "warning",
                    button: {
                        text: "Cerrar",
                        className: "btn btn-secondary btn-sm",
                        closeModal: true,
                    },
                });
            }
    });

    return false;
}

function fn_enviar(form) {
    var data = new FormData(form[0]);
                
                if (form[0].checkValidity() === false) {
                    form[0].classList.add('was-validated');
                } else {
                    var btn  = form.find('[type="submit"]');
                        btn.removeClass('btn-primary'); 
                        btn.addClass('btn-danger');
                        btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Guardando...');

                    var _url = form.attr('data-action');            
                    $.ajax({
                        type: "POST",
                        url: _url,
                        data: data,
                        processData: false,
                        contentType: false,
                        success: function (response) {
                            var method = form.attr('data-method');
                            var json = jQuery.parseJSON(response);
                            btn.html('Aceptar');
                            btn.removeClass('btn-danger');
                            btn.addClass('btn-primary');
                            
                            if (method == 'edi') {
                                if (json.icon == 'success') {
                                    table.ajax.reload(null, false);
                                    $('#modalForm').modal('hide');
                                }

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
                            }

                            if (method == 'add') {
                                table.ajax.reload();
                                form.trigger("reset");
                                
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
                            }

                        
                        }
                    });
                }
        
        
    }

/*
    $('#idForm').on('submit', function(e) {
        e.preventDefault();
        var idvehiculo=$("#txt2").val();
       var idbien=$("#txt3").val();
       //alert(idvehiculo+'  '+idbien);
       var datos={'idvehiculo':idvehiculo,'idbien':idbien};
       $.post(url + '/verificar',datos,function(data,textStatus,jqXHR) {
            if(data!=1){
                var serialize = $(this).serialize();
                $.post(_url+"/<?php echo $method ?>", serialize, function(data,
                    textStatus, jqXHR) {
                    if (textStatus == 'success') {
                        var msg = jQuery.parseJSON(data);
                        if (msg.est == true) {
                            swal("Datos Registrado!", msg.msj, "success");
                            setTimeout(function() {
                                window.location.href = "<?php echo URL ?>/<?php echo $vga_tabla; ?>";
                            }, 1000);
                        } else {
                            swal("Error!!!", msg.msj, "error");
                        }
                    }
                    console.log(data);
                });

            }else{
                    swal({
                        position: 'top-end',
                        title: "YA AGREGASTE COMBUSTIBLE EL DIA DE HOY A ESTE VEHICULO",
                        icon: "warning",
                        button: {
                            text: "Cerrar",
                            className: "btn btn-secondary btn-sm",
                            closeModal: true,
                        },
                    });
            }  
        });  
    });*/
   
</script>