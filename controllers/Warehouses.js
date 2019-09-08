$(document).ready(function () {
    readWarehouse();
    $('.modal').modal();
});
const setWarehouses = (warehouses) => {
    let content = '';
    let contentTable='';
    if(warehouses.length > 0){
        content=`
        <table class="responsive-table animated fadeIn">
            <thead>
                <tr>
                    <th> <i class="material-icons left">store</i> Empresa</th>
                    <th> <i class="material-icons left">room</i> Dirección </th>
                    <th> <i class="material-icons left">build</i> Acciones </th>
                </tr>
            </thead>

            <tbody id="WarehouseTable">
            </tbody>
        </table>
        `;
        warehouses.map( warehouse =>{
            contentTable += `
                <tr>
                    <td>
                        ${warehouse.warehouse}
                    </td>
                    <td>
                        ${warehouse.ubication}
                    </td>
                    <td>
                        <a href="#modalEditWarehouse" onClick="showWarehouse(${warehouse.id})" class="modal-trigger">
                            <i class="material-icons">edit</i>
                        </a>
                        <a href="javascript:test(${warehouse.id})" id="iconDelete">
                            <i class="material-icons">delete</i>
                        </a>
                    </td>
                </tr>
            `;
        });
    }
    else{
        content = `
            <div class="center">
                <i class="material-icons" id="iconSad">sentiment_very_dissatisfied</i>
                <p class="grey-text" id="titleError">No hay sucursales que mostrar</p>
            </div>
            
        `;  
    }
    $('#warehousesRead').html(content);
    $('#WarehouseTable').html(contentTable);
}
const readWarehouse = () => {
    $.ajax(
        {
            url:apiTo('warehouses','readWarehouses'),
            type:'JSON',
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
                setWarehouses(result.dataset);
            }
            else{
                console.log(response);
            }
        }
    )
}
$('#createWarehouse').submit(function(){
    event.preventDefault();
    $.ajax(
        {
            url:apiTo('warehouses','insertWarehouse'),
            type:'POST',
            data:$('#createWarehouse').serialize(),
            datatype:'JSON'
        }
    )
    .done(function(response)
        {
            if(isJSONString(response)){
                const result = JSON.parse(response);
                if(result.status){
                    ToastSucces('Sucursal agregado correctamente')
                    readWarehouse();
                }
                else{
                    ToastError(result.exception);
                }
                
            }
            else{
                console.log(response);
            }
        }
    )
})
const test = (id) => {
    $.confirm({
        closeIcon: true,
        dragWindowBorder: false,
        boxWidth: '30%',
        useBootstrap: false,
        title: 'Eliminar sucursal',
        type: 'red',
        content: '¿Desea eliminar esta sucursal?',
        buttons: {
                confirm: {
                    text:'Eliminar',
                    btnClass:'red',
                    action:function () {
                    $.ajax({
                        url:apiTo('warehouses','deleteWarehouse'),
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
                                    content:'¡Sucursal eliminada!'
                                });
                                readWarehouse();
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
const showWarehouse = (id) =>{
    $.ajax({
        url:apiTo('warehouses','warehousebyId'),
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
                $('#id_warehouse').val(result.dataset.id);
                $('#edit_warehouse').val(result.dataset.warehouse);
                $('#edit_ubicationWh').val(result.dataset.ubication);
            }
            else{
                $.alert({
                    title: 'Error en la operación',
                    boxWidth: '30%',
                    type: 'red',
                    useBootstrap: false,
                    content:result.exception,
                });
                $('#modalEditWarehouse').modal('close');    
            }
        }
        else{
            console.log(response);
        }
    })
}
$('#form-updateWh').submit(function(){
    event.preventDefault();
    $.ajax({
        url:apiTo('warehouses','editWarehouse'),
        type:'POST',
        data:$('#form-updateWh').serialize(),
        datatype:'JSON'
    })
    .done(function(response){
        if(isJSONString(response)){
            const result = JSON.parse(response);
            if(result.status){
                $.alert({
                    title: `<i class="material-icons left green-text accent-4">done</i> Operación existosa`,
                    boxWidth: '30%',
                    type: 'green',
                    useBootstrap: false,
                    content:'¡Sucursal actualizada correctamente!',
                });          
                readWarehouse();
                $('#modalEditWarehouse').modal('close');    
            }
            else{
                $.alert({
                    title: 'Error en la operación',
                    boxWidth: '30%',
                    type: 'red',
                    useBootstrap: false,
                    content:result.exception,
                });
                $('#modalEditWarehouse').modal('close');    
            }
        }
        else{
            console.log(response);
        }
    })
})