var id;
var name;
$(document).ready(function () {
    getCategory();
});
const setlistSubcategories = (subcategories) => {
    let content ='';
    let contentDiv = '';
    if(subcategories.length > 0){
        contentDiv=`
        <table id="tableSubcategories" class="animated fadeIn">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Stock</th>
                </tr>
            </thead>
            <tbody id="subcategoriesRead">
            </tbody>
        </table>
        `;
        subcategories.map( subcategorie => {
            content+= `
                <tr>
                    <td>
                    ${subcategorie.subcategory}  
                    </td>
                    <td>
                    ${subcategorie.number_products}
                    </td>
                </tr>
            `;
        })

        $('#readSubcategories').html(contentDiv);
        $('#subcategoriesRead').html(content);
    }
    else{
        content =`
            <div class="center">
                <i class="material-icons"> face </i>
                <p>No hay información <p>
            </div>
        `;
        $('#readSubcategories').html(content);
    }
    
} 
const getCategory = () => {
    name = localStorage.getItem('item_category');
    
    id = localStorage.getItem('id_category');
    $('#categoryselected').text(name);  
    $.ajax(
        {
            url:apiTo('categories','getSubcategoriesbyCategories'),
            type:'POST',
            data:{
                id
            },
            datatype:'JSON'
        }
    )
    .done(function(response){
        if(isJSONString(response)){
            const result = JSON.parse(response);
            if(!result.status){
            }
            setlistSubcategories(result.dataset);
        }
        else{
            console.log(response);
        }
    })
} 
$('body').on('click','td', function() {
    alert('clicked');
});