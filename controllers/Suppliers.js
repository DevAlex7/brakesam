$(document).ready(function () {
    readSuppliers();
});
const setSuppliers = (suppliers) => {
    let content = '';
    let contentTable = '';
    if (suppliers.length > 0) {

        content = `
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


        suppliers.map(supplier => {
            contentTable += `
          <tr>
            <td>${supplier.enterprise_name}</td>
            <td>${supplier.ubication}</td>
            <td>${supplier.cellphone}</td>
            <td>${supplier.NIT}</td>
            <td>${supplier.NRC}</td>
            <td>
                        <a href="#modalEditSuppliers" onClick="showSupplier(${supplier.id})" class="modal-trigger">
                            <i class="material-icons">edit</i>
                        </a>
                        <a href="javascript:test(${supplier.id})" id="iconDelete">
                            <i class="material-icons">delete</i>
                        </a>
                    </td>
          </tr>
          `;
        })


    } else {
        content = `
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
    $.ajax({
            url: apiTo('suppliers', 'getallSuppliers'),
            type: 'GET',
            data: null,
            datatype: 'JSON'
        })
        .done(function (response) {
            if (isJSONString(response)) {
                const result = JSON.parse(response);
                if (!result.status) {}
                setSuppliers(result.dataset);
            } else {
                console.log(response);
            }
        })
}

$("#createSupplier").submit(function () {
    event.preventDefault();
    $.ajax({
        url: apiTo("suppliers", "createSupplier"),
        type: "POST",
        data: $("#createSupplier").serialize(),
        datatype: "JSON"
    }).done(function (response) {
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


const showSupplier = (id) =>{
    alert(id);
    $.ajax({
        url:apiTo('suppliers','supplierbyId'),
        type:'POST',
        data:{
            id
        },
        datatype:'JSON'
    })
    .done(function(response){
        if(isJSONString(response)){
            const result = JSON.parse(response);
            if(result.status){
                $('#id_supplier').val(result.dataset.id);
                $('#edit_supplier').val(result.dataset.enterprise_name);
                $('#edit_ubicationSu').val(result.dataset.ubication);
                $('#edit_phoneSu').val(result.dataset.cellphone);
                $('#edit_nitSu').val(result.dataset.NIT);
                $('#edit_nrcSu').val(result.dataset.NRC);
            }
            else{
                $.alert({
                    title: 'Error en la operación',
                    boxWidth: '30%',
                    type: 'red',
                    useBootstrap: false,
                    content:result.exception,
                });
                $('#modalEditSuppliers').modal('close');    
            }
        }
        else{
            console.log(response);
        }
    })
}
$('#form-updateSu').submit(function () {
    event.preventDefault();
    $.ajax({
            url: apiTo('suppliers', 'updateSupplier'),
            type: 'POST',
            data: $('#form-updateSu').serialize(),
            datatype: 'JSON'
        })
        .done(function (response) {
            if (isJSONString(response)) {
                const result = JSON.parse(response);
                if (result.status) {
                    $.alert({
                        title: `<i class="material-icons left green-text accent-4">done</i> Operación existosa`,
                        boxWidth: '30%',
                        type: 'green',
                        useBootstrap: false,
                        content: '¡Proveedor actualizado correctamente!',
                    });
                    readSuppliers();
                    $('#modalEditSuppliers').modal('close');
                } else {
                    $.alert({
                        title: 'Error en la operación',
                        boxWidth: '30%',
                        type: 'red',
                        useBootstrap: false,
                        content: result.exception,
                    });
                    $('#modalEditSuppliers').modal('close');
                }
            } else {
                console.log(response);
            }
        })
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
                    data: {
                        idContactenos
                    },
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

const test = (id) => {
    $.confirm({
        closeIcon: true,
        dragWindowBorder: false,
        boxWidth: '30%',
        useBootstrap: false,
        animation: 'opacity',
        title: 'Eliminar proveedor',
        type: 'red',
        content: id,
        buttons: {
                confirm: {
                    text:'Confirme',
                    btnClass:'red',
                    action:function () {
                        $.ajax({
                            url:apiTo('suppliers','deleteSupplier'),
                            type:'POST',
                            data:{
                                id
                            },
                            datatype:'JSON'
                        })
                        .done(function(response){
                            if(isJSONString(response)){
                                const result = JSON.parse(response);
                                if(result.status){
                                    $.alert({
                                        boxWidth: '30%',
                                        useBootstrap: false,
                                        type: 'green',
                                        content:'¡Proveedor eliminada!'
                                    });
                                    readSuppliers();
                                }
                                else{
                                    $.alert({
                                        title: 'Error en la operación',
                                        boxWidth: '30%',
                                        type: 'red',
                                        useBootstrap: false,
                                        content:result.exception,
                                    });
                                }
                            }
                            else{
                                console.log(response);
                            }
                        })
                }
            },
            cancel:{
                text:'Cancelar',
                boxWidth: '30%',
                useBootstrap: false,
                action:function(){
                    $.alert({
                        title: '',
                        boxWidth: '30%',
                        useBootstrap: false,
                        type:'red',
                        content:'Operación cancelada'
                    })
                } 
            }
        }
    });
}