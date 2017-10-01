$(document).ready(function(){

    $('select[name="add_access_type"]').change(function(){
        var defaultValue = $(this.options[this.selectedIndex])
            .attr('default-name');
        $('input[name="add_access_name"]').val(defaultValue);

    });

});

function riseError(text){
    $('#error').html(text);
    $('#error').fadeIn('slow');
    setTimeout(function(){$('#error').fadeOut('slow');},3000)
}
