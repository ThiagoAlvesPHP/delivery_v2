//DEFINIR SE É EM PRODUÇÃO OU~DESENVOLVIMENTO
var url_local = window.location.href;
if(url_local.indexOf('localhost')==-1) {
    var url = 'https://www.albicod.com/delivery/';
} else {
    var url = 'http://localhost/PROJETOS_ANDAMENTO/delivery_v2/';
}