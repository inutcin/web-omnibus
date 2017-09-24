$(document).ready(function(){
});

function riseError(text){
    $('#error').html(text);
    $('#error').fadeIn('slow');
    setTimeout(function(){$('#error').fadeOut('slow');},3000)
}
