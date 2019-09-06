$(document).ready(function () {
    readWarehouse();
});
const setWarehouses = (warehouses) => {
    let content = '';
    let contentTable='';
    if(warehouses.length > 0){
        content=`
        <table class="responsive-table">
            <thead>
                <tr>
                    <th> <i class="material-icons left">store</i> Empresa</th>
                    <th> <i class="material-icons left">room</i> Dirección </th>
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