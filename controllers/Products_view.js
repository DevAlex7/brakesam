$(document).ready(function () {
    readProducts();
    $('.tooltipped').tooltip();
});
var id_subcategory = localStorage.getItem('id_subcategory')
const setProducts = (product) => {
    let content = '';
    if(product.length > 0){
        product.map( product => {
            content=`
            <div class="col s12 m2 offset-m1">
                <div class="card" onClick="viewProduct(${product.id})">
                    <div class="card-image">
                        <img class="activator" src="Imports/resources/pics/products/${product.image}">
                    </div>
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4">${product.product_name}</span>
                    </div>
                </div>
            </div>
            `;
        })
    }
    else{
        content = `
            <div class="center" style="margin-top:3rem">
                <i class="material-icons">face</i>
                <p id="titleError">No hay productos</p>
            </div>
            
        `;
    }   
    $('#readProducts').html(content);
}
const readProducts = () => {
    $.ajax(
        {
            url:apiTo('products','allProducts'),
            type:'POST',
            data:{
                id_subcategory
            },
            datatype:'JSON'
        }
    )
    .done((response) => {
        if(isJSONString(response)){
            const result = JSON.parse(response);
            if(!result.status){
            }
            setProducts(result.dataset);
            $('.tooltipped').tooltip();

        }
        else{
            console.log(response);
        }
    })
}
const viewProduct = (id) => {
    localStorage.setItem('id_viewp', id);
    location.href='viewproduct';
    
}