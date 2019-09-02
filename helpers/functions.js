$(document).ready(function () {
    $('.modal').modal('');
});
function modalInit(){
    $('.modal').modal('');
}
function apiTo(API, Action){
    const api = 'api/'+ API + '.php?action='+Action;
    return api;
}

function isJSONString(string)
{
    try {
        if (string != "[]") {
            JSON.parse(string);
            return true;
        } else {
            return false;
        }
    } catch(error) {
        return false;
    }
}
function ToastSucces(messageSucces){
    var success = M.toast({html:messageSucces});
    return success;
}
function ToastError(messageError){
    var error = M.toast({html:messageError});
    return error;
}
function ClearForm(Form){
    $('#'+Form)[0].reset();
}
function closeModal(modal){
    $('#'+modal).modal('close');
}
function catchError(jqueryError){
    var failMessage =  console.log('Error: ' + jqueryError.status + ' ' + jqueryError.statusText);
    return failMessage;
}
function LogOff(){
    location.href =  requestPOST('userEmployees','Logoff');
}

function LogOffPublic(){
    location.href =  requestPOST('userEmployees','LogoffPublic');
}
var months =['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
function combobox(nameId){
    let content ='';
    for(var i in months){
        content += `
        <option value=${ parseInt(i)+1 }>${months[i]}</option>
        `;
    }
    $('#'+nameId).html(content);
}