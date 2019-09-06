$(document).ready(function () {
    readSuppliers();
    regex();
});
const setSuppliers = (suppliers) => {
    let content = '';
    let contentDiv = '';
    
    if(suppliers.length > 0){
        content = `
        <table>
        <thead>
            <tr>
                <th>Proveedores</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="readSuppliers">
        </tbody>
    </table>
    `;
        
        
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

$("#createSupplier").submit(function() {
    event.preventDefault();
    $.ajax({
      url: apiTo("supplier", "createSupplier"),
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

