$(document).ready(function () {
    readListCategories();
});

const setCategoriesList = (categories) => {
    let content = '';
    let contentTable = '';

    if(categories.length > 0){

        contentTable =  `
        
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


