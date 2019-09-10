$(document).ready(function () {
    readProduct();
    $('.modal').modal();
    $("select").formSelect();   
});

const selectSubCategories = (Select, value) => {
    $.ajax({
      url: apiTo('categories', 'getSubcategories'),
      type: "POST",
      data: null,
      datatype: "JSON"
    })
      .done(function(response) {
        if (isJSONString(response)) {
          const result = JSON.parse(response);
          if (result.status) {
            let content = "";
            if (!value) {
              content +=
                '<option value="" disabled selected>Seleccione una subcategoria</option>';
            }
            result.dataset.forEach(function(row) {
              if (row.id != value) {
                content += `<option class="black-text" value="${row.id}">${row.subcategory}</option>`;
              } else {
                content += `<option class="black-text" value="${row.id}" selected>${row.subcategory}</option>`;
              }
            });
            $("#" + Select).html(content);
          } else {
            $("#" + Select).html(
              '<option value="">No hay Subcategorias</option>'
            );
          }
          $("select").formSelect();
        } else {
          console.log(response);
        }
      })
      .fail(function(jqXHR) {
        console.log("Error: " + jqXHR.status + " " + jqXHR.statusText);
      });
};
const selectWarehouse = (Select, value) => {
    $.ajax({
      url: apiTo('warehouses', 'readWarehouses'),
      type: "POST",
      data: null,
      datatype: "JSON"
    })
      .done(function(response) {
        if (isJSONString(response)) {
          const result = JSON.parse(response);
          if (result.status) {
            let content = "";
            if (!value) {
              content +=
                '<option value="" disabled selected>Seleccione un almacen</option>';
            }
            result.dataset.forEach(function(row) {
              if (row.id != value) {
                content += `<option class="black-text" value="${row.id}">${row.warehouse}</option>`;
              } else {
                content += `<option class="black-text" value="${row.id}" selected>${row.warehouse}</option>`;
              }
            });
            $("#" + Select).html(content);
          } else {
            $("#" + Select).html(
              '<option value="">No hay almacenes</option>'
            );
          }
          $("select").formSelect();
        } else {
          console.log(response);
        }
      })
      .fail(function(jqXHR) {
        console.log("Error: " + jqXHR.status + " " + jqXHR.statusText);
      });
};
const selectProvider = (Select, value) => {
    $.ajax({
      url: apiTo('suppliers', 'getallSuppliers'),
      type: "POST",
      data: null,
      datatype: "JSON"
    })
      .done(function(response) {
        if (isJSONString(response)) {
          const result = JSON.parse(response);
          if (result.status) {
            let content = "";
            if (!value) {
              content +=
                '<option value="" disabled selected>Seleccione un proveedor</option>';
            }
            result.dataset.forEach(function(row) {
              if (row.id != value) {
                content += `<option class="black-text" value="${row.id}">${row.enterprise_name}</option>`;
              } else {
                content += `<option class="black-text" value="${row.id}" selected>${row.enterprise_name}</option>`;
              }
            });
            $("#" + Select).html(content);
          } else {
            $("#" + Select).html(
              '<option value="">No hay proveedores</option>'
            );
          }
          $("select").formSelect();
        } else {
          console.log(response);
        }
      })
      .fail(function(jqXHR) {
        console.log("Error: " + jqXHR.status + " " + jqXHR.statusText);
      });
};

const setProducts = (rows) => {
    let content = '';
    if(rows.length > 0){
        rows.map( product => {
            var ImageCover = "Imports/resources/pics/products/";
            content+=`
                <tr>
                    <td> <img src="${ImageCover+product.image}"> </td>
                    <td>${product.product_name}</td>
                    <td>${product.product_price}</td>
                    <td>${product.enterprise_name}</td>
                    <td>${product.count_stock}</td>
                    <td>${product.warehouse}</td>
                    <td>${product.subcategory}</td>
                    <td>
                        <a class="modal-trigger" onClick="getProduct(${product.id})" href="#modalEditProduct"> 
                            <i class="material-icons">edit</i> 
                        </a>
                        <a href="javascript:deleteProduct(${product.id},'${product.image}')"> 
                            <i class="material-icons" >delete</i>    
                        </a>
                    </td>
                </tr>
            `;
        })
    }
    else{
        content=`
                <tr>
                    <td> No hay productos </td>
                </tr>
            `;
    }
    $('#tableProducts').html(content);
} 
const readProduct = () => {
    $.ajax(
        {
            url:apiTo('products','all'),
            type:'GET',
            data:null,
            datatype:'JSON'
        }
    )
    .done((response) => {
        if(isJSONString(response)){
            const result = JSON.parse(response);
            if(!result.status){
            }
            setProducts(result.dataset);
        }
        else{
            console.log(response);
        }
    })
}

const getProduct = (id) => {
    $.ajax(
        {
            url:apiTo('products','getProductbyId'),
            type:'POST',
            data:{
                id
            },
            datatype:'JSON',
            
        }
    )
    .done((response)=>{
        if(isJSONString(response)){
            const result = JSON.parse(response);
            if(result.status){
                $('#id').val(id);
                $('#edit_name_product').val(result.dataset.product_name);
                $('#edit_price_product').val(result.dataset.product_price);
                selectProvider('editlistProvider',result.dataset.supplier_id);
                $('#edit_count_product').val(result.dataset.count_stock);
                selectWarehouse('editlistWarehouses',result.dataset.warehouse_id);
                selectSubCategories('editlistSubcategories',result.dataset.subcategory_id);
                $('#edit_image').val(result.dataset.image);
                $('#pic_image').val(result.dataset.image);
            }
            else{

            }
        }
        else{
            console.log(response);
        }
    })
}
$('#form-updateProduct').submit(()=>{
    event.preventDefault();
    $.ajax(
        {
            url:apiTo('products','editProductbyId'),
            type:'POST',
            data:new FormData($('#form-updateProduct')[0]),
            cache: false,
            contentType: false,
            processData: false,
            datatype:'JSON'       
        }
    ).done((response)=>{
        if(isJSONString(response)){
            const result = JSON.parse(response);
            if(result.status == 1 ){
              $.alert({
                title:'Operación existosa',
                type:'green',
                boxWidth:'30%',
                useBootstrap: false,
                content:'¡Producto editado correctamente!'
              })
              readProduct();
              $('#modalEditProduct').modal('close');
            }
            else if(result.status == 0){
              $.alert({
                title:'Error',
                type:'red',
                boxWidth:'30%',
                useBootstrap: false,
                content:result.exception
              })
            }
            else if(result.status == 2){
                $.alert({
                  title:'Error',
                  type:'red',
                  boxWidth:'30%',
                  useBootstrap: false,
                  content:result.exception
                })
            }
            else if(result.status == 3){
                $.alert({
                  title:'Exito',
                  type:'green',
                  boxWidth:'30%',
                  useBootstrap: false,
                  content:'Editado sin subir un archivo'
                })
                readProduct();
                $('#modalEditProduct').modal('close');
            }
            else{
                $.alert({
                    title:'Error',
                    type:'red',
                    boxWidth:'30%',
                    useBootstrap: false,
                    content:result.exception
                })
            }
        }
        else{
            console.log(response);
        }
    })
})
const deleteProduct = (id, image) => {
    $.confirm(
        {
            title:'Eliminar producto',
            type:'red',
            boxWidth:'30%',
            useBootstrap: false,
            content:'¿Desea elíminar este producto? Estaria eliminando productos relacionados a las subcategorías',
            buttons:{
                eliminar:{
                    text:'Si, eliminar',
                    btnClass:'red',
                    action:()=>{
                        $.ajax(
                            {
                                url:apiTo('products','deletebyId'),
                                type:'POST',
                                data:{
                                    id, image
                                },
                                datatype:'JSON'
                            }
                        )
                        .done((response)=>{
                            if(isJSONString(response)){
                                const result = JSON.parse(response);
                                if(result.status == 1){
                                    $.alert(
                                    {
                                        title:'Exito',
                                        type:'green',
                                        boxWidth:'30%',
                                        useBootstrap: false,
                                        content:'Producto eliminado correctamente'
                                    })
                                    readProduct();
                                }
                                else if(result.status == 2){
                                    $.alert({

                                        title:'Error',
                                        type:'red',
                                        boxWidth:'30%',
                                        useBootstrap: false,
                                        content:result.exception

                                    })
                                    
                                }
                                else{
                                $.alert(
                                    {
                                        title:'Error',
                                        type:'red',
                                        boxWidth:'30%',
                                        useBootstrap: false,
                                        content:result.exception
                                    })
                                }
                            }
                            else{
                                console.log(response);  
                            }
                        })
                    }
                },
                cancelar:{

                }
            }
        }
    )
} 
