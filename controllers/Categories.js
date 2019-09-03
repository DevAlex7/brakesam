$(document).ready(function () {
    readListCategories();
    $('select').formSelect();
    selectCategories('selectCategory',null);
});

const setCategoriesList = (categories) => {
    let content = '';
    let contentTable = '';

    if(categories.length > 0){

        contentTable =  `
        <table>
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

        $('#categoriesList').html(contentTable);
        
        categories.map( categorie => {
            content +=`
                <tr>
                <td>
                    ${categorie.category}
                </td>
                <td>
                    <a id="editIcon"> <i class="material-icons">edit</i> </a>
                    <a id="deleteIcon"> <i class="material-icons">delete</i> </a>
                </td>
                </tr>
            `;
        })    

        $('#readCategories').html(content);    
    }
}
const readListCategories = () => {
    $.ajax(
        {
            url:apiTo('categories','allCategories'),
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
                    $('#categoriesList').html(`
                        <div id="">
                            <div class="center">
                                <i class="material-icons">face</i>
                                <p>No hay categorias agregadas todavia</p>
                            </div>
                        </div>
                    `);
                }
                setCategoriesList(result.dataset);
                
            }

            else{

            }
        }
    )
}
$('#search').submit(function(){
    event.preventDefault();
    
})
$('#createCategory').submit(function(){
    event.preventDefault();
    $.ajax(
        {
            url:apiTo('categories','createCategory'),
            type:'POST',
            data:$('#createCategory').serialize(),
            datatype:'JSON'
        }
    )
    .done(function(response)
        {
            if(isJSONString(response)){
                const result = JSON.parse(response);
                if(result.status){
                    ToastSucces('Categoría creada correctamente');
                    readListCategories();
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
const selectCategories = (Select, value) => {
    $.ajax({
        url: apiTo('categories','allCategories'),
        type: 'POST',
        data: null,
        datatype: 'JSON'
    })
    .done(function(response){
        if (isJSONString(response)) {
            const result = JSON.parse(response);
            if (result.status) {
                let content = '';
                if (!value) {
                    content += '<option value="" disabled selected>Seleccione una categoria</option>';
                }
                result.dataset.forEach(function(row){
                    if (row.id != value) {
                        content += `<option value="${row.id}">${row.category}</option>`;
                    } else {
                        content += `<option value="${row.id}" selected>${row.category}</option>`;
                    }
                });
                $('#' + Select).html(content);
            } else {
                $('#' + Select).html('<option value="">No hay tipos de eventos</option>');
            }
            $('select').formSelect();
        } else {
            console.log(response);
        }
    })
    .fail(function(jqXHR){
        console.log('Error: ' + jqXHR.status + ' ' + jqXHR.statusText);
    });
}
$('#addSubCategory').submit(function(){
    event.preventDefault();
    $.ajax(
        {
            url:apiTo('categories','createSubcategory'),
            type:'POST',
            data:$('#addSubCategory').serialize(),
            datatype:'JSON'
        }
    )
    .done(function(response)
        {
            if(isJSONString(response)){
                const result = JSON.parse(response);
                if(result.status){
                    ToastSucces('Sub Categoría creada correctamente');
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

