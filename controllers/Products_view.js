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
            <div class="col s12 m3">
                <div class="card">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img class="activator" src="Imports/resources/pics/products/${product.image}">
                    </div>
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4">${product.product_name}<i class="material-icons right tooltipped data-position="bottom" data-tooltip="ver más detalles">more_vert</i></span>
                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>
                        <p>Here is some more information about this product that is only revealed once clicked on.</p>
                    </div>
                </div>
            </div>
            `;
        })
    }
    else{
        content = `
            <div class="center">
                <i class="material-icons">face<i>
                <p id="titleError">No hay nada</p>
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