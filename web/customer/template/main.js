$(document).ready(function() {
    //toggle `popup` / `inline` mode
    $.fn.editable.defaults.mode = 'popup';

    //make username editable
    $('#username').editable();
    $('#memid').editable();
    $('#memtel').editable();
    $('#mememail').editable();
    $('#quota1').editable();
    $('#quota2').editable();
    $('#quota3').editable();
    $('#quota4').editable();
    $('#quota5').editable();
    $('#quota6').editable();
    $('#quota7').editable();
    $('#quota8').editable();
    $('#quota9').editable();
    $('#quota10').editable();
    $('#password1').editable();
    $('#password2').editable();
    $('#password3').editable();
    $('#password4').editable();
    $('#password5').editable();
    $('#password6').editable();
    $('#password7').editable();
    $('#password8').editable();
    $('#password9').editable();
    $('#password10').editable();
    //make status editable
    //$('#status').editable({
    //    type: 'select',
    //    title: 'Select status',
    //    placement: 'right',
    //    value: 2,
    //    source: [
    //        {value: 1, text: 'status 1'},
    //        {value: 2, text: 'status 2'},
    //        {value: 3, text: 'status 3'}
    //    ]
        /*
        //uncomment these lines to send data on server
        ,pk: 1
        ,url: '/post'
        */
    //});
    $('#my-checkbox').bootstrapSwitch();
});
