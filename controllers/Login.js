$(document).ready(function () {
    
});
$('#form-register').submit(function(){
    event.preventDefault();
    $.ajax(
        {    
            url:apiTo('users','signup'),
            type:'POST',
            data: $('#form-register').serialize(),
            datatype:'JSON'
        }
    )
    .done(function(response)
        {   
            if(isJSONString(response)){
                const result = JSON.parse(response);
                if(result.status){
                    ToastSucces('Perfil creado correctamente');
                    location.href='login';
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
$('#form-login').submit(function(){
    event.preventDefault();
    $.ajax(
        {    
            url:apiTo('users','login'),
            type:'POST',
            data: $('#form-login').serialize(),
            datatype:'JSON'
        }
    )
    .done(function(response)
        {   
            if(isJSONString(response)){
                const result = JSON.parse(response);
                if(result.status){
                    ToastSucces('Logueado correctamente');
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