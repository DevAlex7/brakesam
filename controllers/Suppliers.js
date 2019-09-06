$(document).ready(function () {
    readSuppliers();
});
const setSuppliers = (suppliers) => {
    let content = '';
    let contentTable = '';
    if(suppliers.length > 0){
     
        content=`
        <table class="responsive-table">
            <thead>
                <tr>
                    <th> <i class="material-icons left">apartment</i> Empresa</th>
                    <th> <i class="material-icons left">room</i> Dirección </th>
                    <th> <i class="material-icons left">phone</i> Telefono</th>
                    <th> <i class="material-icons left">contact_mail</i> NIT</th>
                    <th> <i class="material-icons left">contact_mail</i> NRC</th>
                    <th> <i class="material-icons left">build</i>Acciones</th>
                </tr>
            </thead>

            <tbody id="suppliersTable">
            </tbody>
        </table>
        `;


        suppliers.map( supplier => {
          contentTable+=`
          <tr>
            <td>${supplier.enterprise_name}</td>
            <td>${supplier.ubication}</td>
            <td>${supplier.cellphone}</td>
            <td>${supplier.NIT}</td>
            <td>${supplier.NRC}</td>
            <td><a href="#"> <i class="material-icons left">edit</i></a> <a href="#"> <i class="material-icons left">delete</i></a></td>
          </tr>
          `;
        })
            
        
    }
    else{
        content=`
            <div class="center">
                <i class="material-icons" id="iconSad">sentiment_very_dissatisfied</i>
                <p> <span class="grey-text flow-text" id="spantitleError">No hay proveedores para mostrar.</span> </p>
            </div> 
        `;
    }
    $('#contentDiv').html(content);
    $('#suppliersTable').html(contentTable);
}
const readSuppliers = () => {
    $.ajax( 
        {
            url:apiTo('suppliers','getallSuppliers'),
                 type:'GET',
            data:null,
            datatype:'JSON'
        }   
    )
    .done(function(response)
        {
            if(isJSONString(response)){
                const result = JSON.parse(response);
                if(!result.status){
                }
                setSuppliers(result.dataset);
            }
            else{
                console.log(response);
            }
        }
    )
}

$("#createSupplier").submit(function() {
    event.preventDefault();
    $.ajax({
      url: apiTo("suppliers", "createSupplier"),
      type: "POST",
      data: $("#createSupplier").serialize(),
      datatype: "JSON"
    }).done(function(response) {
      if (isJSONString(response)) {
        const result = JSON.parse(response);
        if (result.status) {
          ToastSucces("Proveedor creada correctamente");
          $("#name_supplier").val("");
          $("#address_category").val("");
          $("#phone_category").val("");
          $("#nit_category").val("");
          $("#nrc_category").val("");
          readSuppliers();
        } else {
          ToastError(result.exception);
        }
      } else {
        console.log(response);
      }
    });
  });


/**
 * Función que envia la informacion de contacto para modificar registro
 */
$('#formModificarContacto').submit(async () => {
    event.preventDefault();
    const response = await $.ajax({
        url: apiContactanos + 'updateContactenos',
        type: 'post',
        data: new FormData($('#formModificarContacto')[0]),
        datatype: 'json',
        cache: false,
        contentType: false,
        processData: false
    }).fail(function (jqXHR) {
        //Se muestran en consola los posibles errores de la solicitud AJAX
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
    if (isJSONString(response)) {
        const result = JSON.parse(response)
        if (result.status) {
            
            $('#modalModificar').modal('toggle')
        } else {
        }
        readContactenos()
    } else {
    }
})

/**
 * Función que elimina un contacto
 * @param {number} idContactenos - Codigo de identificacion del contacto
 */
const borrarContacto = async (idContactenos) => {
    validarSesion()
    swal({
        title: 'Advertencia',
        text: '¿Quiere eliminar el contacto?',
        icon: 'warning',
        buttons: {
            cancel: {
                text: "Cancelar",
                value: false,
                visible: true,
                closeModal: true,
              },
              confirm: {
                text: "Borrar",
                value: true,
                visible: true,
                className: "",
                closeModal: true
              }
        }
    }).then(
        async (isConfirm) => {
            if (isConfirm) {
                const response = await $.ajax({
                    url: apiContactanos + 'deleteContactenos',
                    type: 'post',
                    data: { idContactenos },
                    datatype: 'json'
                })
                //Se verifica si la respuesta de la API es una cadena JSON, sino se muestra el resultado en consola
                if (isJSONString(response)) {
                    const result = JSON.parse(response);
                    //Se comprueba si el resultado es satisfactorio, sino se muestra la excepción
                    if (result.status) {
                        swal(
                            'Operación Correcta',
                            result.message,
                            'success'
                        )
                    } else {
                        swal(
                            'Error',
                            result.exception,
                            'error'
                        )
                    }
                    readContactenos()
                } else {
                    swal(
                        'Error',
                        response,
                        'error'
                    )
                }
            }
        });
}