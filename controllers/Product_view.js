
$(document).ready(function () {
   viewProduct(); 
});
const viewProduct = () => {
    var id = localStorage.getItem('id_viewp');
    $.ajax(
        {
            url:apiTo('products','getProductbyId'),
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
                var ImageCover = "Imports/resources/pics/products/"+result.dataset.image;
                $('#imgProduct').attr("src", ImageCover);
                $('#ProductTitle').text(result.dataset.product_name);
                $('#priceTitle').text(result.dataset.product_price);
                $('#providerTitle').text(result.dataset.enterprise_name);
                $('#countTitle').text(result.dataset.count_stock);
                $('#warehouseTitle').text(result.dataset.warehouse);
            }   
            else{
                $.alert(
                    {
                        title:'Error al obtener el producto',
                        type:'red',
                        content:result.exception,

                    }
                )
            }
        }
        else{
            console.log(response);
        }
    })
}

