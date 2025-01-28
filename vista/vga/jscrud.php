<script>
    /** 
     ordering: false,
     pageLength: 25,
     lengthChange: false,
     bInfo: false,
     autoWidth: false,
     responsive: true,
     colReorder: true,
     retrieve: true,
     select: true,
     */
     

    var url = "<?php echo URL . '/' . $this->archivo ?>";
//alert("<?php echo $this->archivo ?>");
//alert(url);
    var table = $('#dataTable').DataTable({
       //dom: '<"row"<"col-sm-12 col-md-4"l><"col-sm-12 col-md-4"<"dt-buttons btn-group flex-wrap"B>><"col-sm-12 col-md-4"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
        buttons: [
            { extend: 'copy', className: 'btn-warning btn-sm', text: '<i class="fa fa-copy"></i> Copiar' },
            { extend: 'pdf', className: 'btn-danger btn-sm', text: '<i class="fa fa-file-pdf"></i> PDF' },
            { extend: 'print', className: 'btn-primary btn-sm', text: '<i class="fa fa-print"></i> Imprimir' },
            { extend: 'excel', className: 'btn-success btn-sm', text: '<i class="fa fa-file-excel"></i> Excel' }
        ],
        responsive: true,
        colReorder: true,
        autoWidth: false, 
        ordering: false,
        processing: true,
        serverSide: true,
        ajax: {
            url: url + "/listar",
            type: "POST"
            
        },
        language: {
            "lengthMenu": "Mostrar _MENU_ ",
            "zeroRecords": "Datos no encontrados.",
            "info": "Pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No hay datos disponibles",
            "infoFiltered": "(filtrado de _MAX_ datos totales)",
            "search": "Buscar:",
            "paginate": {
                "first": "Primero",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });

    function fn_edi(e, id) {
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

    function fn_add(e) {
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
    }

    function fn_del(e, id) {
       // alert(id);
        swal({
            title: "¿Estás seguro de eliminar?",
            text: "Una vez eliminado, ¡no podrá recuperar este registro!",
            icon: "error",
            buttons: ["No", "Si"],
            dangerMode: true
        })
                .then((willDelete) => {
                    if (willDelete) {
                        $.post(url + '/del', {
                            id: id
                        }, function (data, textStatus, jqXHR) {
                            table.ajax.reload(null, false);
                            swal({
                                title: "¡Su registro ha sido eliminado!",
                                button: {
                                    text: "Cerrar",
                                    className: "btn btn-secondary btn-sm",
                                    closeModal: true,
                                },
                                icon: "success"
                            });
                        });
                    }
                });
    }
    ;

    function fn_submit(e) {
        var form = $(e);
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

                    if (method == 'print') {
                        //console.log(json);
                        if (json.icon == 'success') {                        
                           // table.ajax.reload(null, false);
                            $('#frm_num_recivo').modal('hide');
                            window.location.href =url+'/mostrarpdf?id='+json.id;
                            //alert(url);
                        }

                    }
                }
            });
        }
        return false;
    }

    (function($){

    	$(document).on("mousedown", ".modal-header", function(mousedownEvt) {
    		var $draggable = $(this);
		    var x = mousedownEvt.pageX - $draggable.offset().left;
		    var y = mousedownEvt.pageY - $draggable.offset().top;

		    console.log(x);
		    console.log(y);

		    $("body").on("mousemove.draggable", function(mousemoveEvt) {
		        $draggable.closest(".modal-content").offset({
		            "left": mousemoveEvt.pageX - x,
		            "top": mousemoveEvt.pageY - y
		        });
		    });
		    $("body").one("mouseup", function() {
		        $("body").off("mousemove.draggable");
		    });
		    $draggable.closest(".modal").one("bs.modal.hide", function() {
		        $("body").off("mousemove.draggable");
		    });
		});

    })(jQuery);
    

    
/*    function fn_print(e, id) {
        $("#txt0").val(id);
        
        //$("#frm_num_recivo").modal("show");

        var btn = $(e);
        btn.attr('disabled', true);
        btn.html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>');
        var _url = url + '/print/';

        $.get(_url, {
            id: id
        }, function (data, textStatus, jqXHR) {
            if (textStatus == 'success') {
                btn.attr('disabled', false);
                btn.html('<i class="fas fa-print"></i>');
                $('#resp').html(data);
                $('#frm_num_recivo').modal('show');
                var idform = $('#idprint');
                idform.attr('data-action', _url);
                idform.attr('data-method', 'print');
            }
        });
    } ;
   */
 


</script>
