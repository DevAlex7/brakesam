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

