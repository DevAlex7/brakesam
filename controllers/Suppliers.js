$(document).ready(function () {
    readSuppliers();
    regex();
});
const setSuppliers = (suppliers) => {
    let content = '';
    
    if(suppliers.length > 0){

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
