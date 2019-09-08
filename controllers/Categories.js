$(document).ready(function() {
    readListCategories();
    readListSubCategories();
    $("select").formSelect();
    selectCategories("selectCategory", null);
    $('.modal').modal();
  });
  
  const setCategoriesList = categories => {
   let content = '';
   let contentTable = '';
  
    if (categories.length > 0) {          
          contentTable = `
          <table class="animated fadeIn" id="tableCategories">
          <thead>
              <tr>
                  <th>Categoria</th>
                  <th>Acciones</th>
              </tr>
          </thead>
          <tbody id="readCategories">
          </tbody>
        </table>
         `;

      $("#categoriesList").html(contentTable);
      categories.map(categorie => {
        content += `
                  <tr>
                  <td>
                      ${categorie.category}
                  </td>
                  <td>
                      <a id="editIcon" class="modal-trigger" href="#modalEditCat" onClick="getCategorybyId(${categorie.id})"> <i class="material-icons">edit</i> </a>
                      <a id="deleteIcon" href="javascript:confirmDelete( ${categorie.id} )"> 
                        <i class="material-icons">delete</i>  
                      </a>
                  </td>
                  </tr>
              `;
      });
  
      $("#readCategories").html(content);
    }
  };
  
  const readListCategories = () => {
    $.ajax({
      url: apiTo("categories", "allCategories"),
      type: "GET",
      data: null,
      datatype: "JSON"
    })
    .done(function(response) {
      if (isJSONString(response)) {
        const result = JSON.parse(response);
        if (!result.status) {
          $("#categoriesList").html(`
              <div id="">
                  <div class="center">
                      <i class="material-icons">face</i>
                      <p>No hay categorias agregadas todavia</p>
                  </div>
              </div>
          `);
        }
        setCategoriesList(result.dataset);
      } else {
        console.log(response);
      }
    })
    .fail(function(jqXHR) {
      catchError(jqXHR);
    });;
  };
  
  const setSubCategoriesList = categories => {
    let content = "";
    let contentTable = "";
  
    if (categories.length > 0) {
      contentTable = `
          <table class="animated fadeIn" id="tableSubcategories">
              <thead>
                  <tr>
                      <th>Subcategoria</th>
                      <th>Categoria</th>
                      <th>Acciones</th>
                  </tr>
              </thead>
              <tbody id="subcategoriesRead">
              </tbody>
          </table>
      `;
      
      categories.map(categorie => {
        content += `
            <tr>
            <td>
                ${categorie.subcategory}
            </td>
            <td>
                ${categorie.category}
            </td>
            <td>
                <a id="editIcon" class="modal-trigger" onClick="getSubcategory(${categorie.id_subcategory})" href="#modalEditSubcategory" > 
                    <i class="material-icons">edit</i> 
                </a>
                <a id="deleteIcon" href="javascript:deleteSubcategory(${categorie.id_subcategory})"> 
                  <i class="material-icons">delete</i> 
                </a>
            </td>
            </tr>
        `;
      });
      $("#subcategoriesDiv").html(contentTable);
      $("#subcategoriesRead").html(content);
    }
  };

  const readListSubCategories = () => {
    $.ajax({
      url: apiTo("categories", "allSubCategories"),
      type: "GET",
      data: null,
      datatype: "JSON"
    }).done(function(response) {
      if (isJSONString(response)) {
        const result = JSON.parse(response);
        if (!result.status) {
          $("#subcategoriesDiv").html(`
            <div id="">
                <div class="center">
                    <i class="material-icons">face</i>
                    <p>No hay subcategorias agregadas todavia</p>
                </div>
            </div>
        `);
        }
        setSubCategoriesList(result.dataset);
      } else {
        console.log(response);
      }
    })
    .fail(function(jqXHR) {
      catchError(jqXHR);
    });
  };

  $("#search").submit(function() {
    event.preventDefault();
  });
  
  $("#createCategory").submit(function() {
    event.preventDefault();
    $.ajax({
      url: apiTo("categories", "createCategory"),
      type: "POST",
      data: $("#createCategory").serialize(),
      datatype: "JSON"
    }).done(function(response) {
      if (isJSONString(response)) {
        const result = JSON.parse(response);
        if (result.status) {
          ToastSucces("Categoría creada correctamente");
          $("#name_category").val("");
          $("#name_category").focus();
          readListCategories();
          selectCategories("selectCategory", null);
        } else {
          ToastError(result.exception);
        }
      } else {
        console.log(response);
      }
    })
    .fail(function(jqXHR) {
      catchError(jqXHR);
    });
  });

  const selectCategories = (Select, value) => {
    $.ajax({
      url: apiTo("categories", "allCategories"),
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
                '<option value="" disabled selected>Seleccione una categoria</option>';
            }
            result.dataset.forEach(function(row) {
              if (row.id != value) {
                content += `<option class="black-text" value="${row.id}">${row.category}</option>`;
              } else {
                content += `<option class="black-text" value="${row.id}" selected>${row.category}</option>`;
              }
            });
            $("#" + Select).html(content);
          } else {
            $("#" + Select).html(
              '<option value="">No hay tipos de eventos</option>'
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

  $("#addSubCategory").submit(function() {
    event.preventDefault();
    $.ajax({
        url: apiTo("categories", "createSubcategory"),
        type: "POST",
        data: $("#addSubCategory").serialize(),
        datatype: "JSON"
    }).done(function(response) {
        if (isJSONString(response)) {
          const result = JSON.parse(response);
          if (result.status) {
              ToastSucces("Sub Categoría creada correctamente");
              readListSubCategories();
          } else {
              ToastError(result.exception);
          }
        } 
        else {
          console.log(response);
        }
    });
  });

  const getCategorybyId = (id) => {
      $.ajax(
          {
            url:apiTo('categories','getCategorybyId'),
            type:'POST',
            data:{
              id
            },
            datatype:'JSON'
          }
      )
      .done(function(res)
          {
            if(isJSONString(res)){
                const result = JSON.parse(res);
                
                if(result.status){
                  $('#id_category').val(result.dataset.id);
                  $('#edit_category').val(result.dataset.category)
                }
                else{
                  $.alert({
                    title: 'Error en obtener información',
                    boxWidth: '30%',
                    type: 'red',
                    useBootstrap: false,
                    content:result.exception,
                });
                $('#modalEditCat').modal('close');   
                }
            }
            else{
              console.log(res);
            }
          }
      )
      .fail(function(jqXHR) {
        catchError(jqXHR);
      });
  }

  $('#form-editCategory').submit(function(){
    event.preventDefault();
    $.ajax(
        {
          url:apiTo('categories','editCategory'),
          type:'POST',
          data:$('#form-editCategory').serialize(),
          datatype:'JSON'
        }
    )
    .done(function(response)
      {
          if(isJSONString(response)){
              const result = JSON.parse(response);
              if(result.status){
                  $.alert({
                    title: `<i class="material-icons left green-text accent-4">done</i> Operación existosa`,
                    boxWidth: '30%',
                    type: 'green',
                    useBootstrap: false,
                    content:'Categoria actualizada correctamente!',
                });          
                
                readListCategories();
                readListSubCategories();
                
                $('#tableSubcategories').removeClass('animated fadeIn');
                selectCategories("selectCategory", null);
                $('#modalEditCat').modal('close'); 
              }
              else{
                $.alert({
                  title: 'Error en la operación',
                  boxWidth: '30%',
                  type: 'red',
                  useBootstrap: false,
                  content:result.exception,
              });
              $('#modalEditCat').modal('close');    
              }
          }
          else{
            console.log(response);
          }
      }
    )
    .fail(function(jqXHR) {
      catchError(jqXHR);
    });
  })
  const confirmDelete = (id) => {

      $.confirm({
        closeIcon:true,
        dragWindowBorder: false,
        boxWidth: '30%',
        useBootstrap: false,
        title:'Eliminar categoria',
        type:'red',
        content:'Al eliminar esta categoría, eliminara las subcategorias registradas con ella, y sus productos pertenecientes a las subcategorías',
        buttons:{
              confirm:{
                text:'Eliminar',
                btnClass:'red',
                action:function(){
                      $.ajax({
                        url:apiTo('categories','deleteCategory'),
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
                                    title:'<i class="material-icons left green-text accent-4">done</i> Operación exitosa',
                                    boxWidth: '30%',
                                    useBootstrap: false,
                                    type: 'green',
                                    content:'Categoría eliminada!'
                                });
                                readListCategories();
                                readListSubCategories();
                                selectCategories("selectCategory", null);
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
      })

  }
  const getSubcategory = (id) => {
      $.ajax(
          {
            url:apiTo('categories','getSubcategorybyId'),
            type:'POST',
            data:{
              id
            },
            datatype:'JSON'    
          }
      )
      .done((response) => {
          if(isJSONString(response)){
              const result = JSON.parse(response);
              if(result.status){
                  $('#id_editsubcategory').val(result.dataset.id_subcategory);
                  $('#editSubcategory').val(result.dataset.subcategory);
                  selectCategories("edit_categoryCombo", result.dataset.id_category);
              }
              else{
                $.alert({
                    title: 'Error en obtener información',
                    boxWidth: '30%',
                    type: 'red',
                    useBootstrap: false,
                    content:result.exception,
                });
                $('#modalEditSubcategory').modal('close');
              }
          }
          else{
            console.log(response);
          }
      })
      .fail(function(jqXHR) {
        catchError(jqXHR);
      });
  }
  $('#editSubcategory-form').submit(function(){
      event.preventDefault();
      $.ajax(
          {
            url:apiTo('categories','updateSubCategory'),
            type:'POST',
            data:$(this).serialize(),
            datatype:'JSON'    
          }
      )
      .done((response) => {
          if(isJSONString(response)){
              const result =  JSON.parse(response);
              if(result.status){
                $.alert({
                  title: '<i class="material-icons green-text accent-4 left">done</i> Operación exitosa',
                  boxWidth: '30%',
                  type: 'green',
                  useBootstrap: false,
                  content:'Subcategoria actualizada correctamente',
                });
                readListSubCategories();
                $('#modalEditSubcategory').modal('close');
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
  })
  const deleteSubcategory = (id) => {
      $.confirm({
          title:'Eliminar subcategoria',
          boxWidth:'30%',
          useBootstrap:false,
          type:'red',
          buttons:{
              confirm:{
                text:'Eliminar',
                btnClass:'red',
                action:()=>{
                    $.ajax(
                      {
                        url:apiTo('categories','deleteSubcategorie'),
                        type:'POST',
                        data:{
                          id
                        },
                        datatype:'JSON'    
                      }
                  )
                  .done((response) => {
                      if(isJSONString(response)){
                          const result = JSON.parse(response);
                          if(result.status){
                              $.alert({
                                title: '<i class="material-icons green-text accent-4 left">done</i> Operación exitosa',
                                boxWidth: '30%',
                                type: 'green',
                                content:'Subcategoria eliminada',
                                useBootstrap: false,
                                content:result.exception,
                              });
                              readListSubCategories();
                          }
                          else{
                            $.alert({
                                title: 'Error en obtener información',
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
                  .fail(function(jqXHR) {
                    catchError(jqXHR);
                  });         
                }
              },
              cancel:{
                action:()=>{
                  
                }
              }
          }
      })
  }