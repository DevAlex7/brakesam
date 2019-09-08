$(document).ready(function () {
    readCategories();
    $('.modal').modal();
    $("select").formSelect();
    selectSubCategories("listSubcategories", null);
    selectProvider('listProvider',null);
    selectWarehouse('listWarehouses',null);
});

const setCategories = (categories) => {
    if(categories.length > 0){
        let content = '';
        $('#title-card3').text('Categorías');
        categories.map( categorie => {
            content+= `
            <div class="col s12 m12 animated fadeIn">
                <ul class="collection">
                    <li class="collection-item" onClick="viewCategory( ${categorie.id_category} , '${categorie.category}' )"> ${categorie.category} </li>
                </ul>
            </div>
            `;
        })
        $('#readCategories').html(content);
    }else{
        $('#title-card3').text('No hay categorías para mostrar');
    }
}
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
const readCategories = () => {
    $.ajax(
        {
            url:apiTo('categories','categoriesWithSubcategories'),
            type:'POST',
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
                setCategories(result.dataset);
            }
            else{
            }
        }
    )
}
const viewCategory = (id , name) => {
    localStorage.setItem('item_category',name);
    localStorage.setItem('id_category',id);
    location.href='subcategories';
}
$('#form-addProduct').submit(function(){    
    event.preventDefault();
    $.ajax(
        {
            url:apiTo('products','insertProduct'),
            type:'POST',
            data:new FormData($('#form-addProduct')[0]),
            cache: false,
            contentType: false,
            processData: false,
            datatype:'JSON'
        }
    )
    .done((response)=>{
        if(isJSONString(response)){
            const result = JSON.parse(response);
            if(result.status == 1 ){
              $.alert({
                title:'Operación existosa',
                type:'green',
                boxWidth:'30%',
                useBootstrap: false,
                content:'¡Producto agregado correctamente!'
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