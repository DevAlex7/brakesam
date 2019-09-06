$(document).ready(function () {
    readCategories();
});
const setCategories = (categories) => {
    if(categories.length > 0){
        let content = '';
        $('#title-card3').text('Categorías');
        categories.map( categorie => {
            content+= `
            <div class="col s12 m12">
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