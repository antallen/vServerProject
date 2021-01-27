$(document).ready(function() {
    //toggle `popup` / `inline` mode
    $.fn.editable.defaults.mode = 'popup';

    //make username editable
    $('#content1').editable();
    $('#content2').editable();
    $('#content3').editable();
    $('#content4').editable();
    $('#content5').editable();
    $('#title1').editable();
    $('#title2').editable();
    $('#title3').editable();
    $('#title4').editable();
    $('#title5').editable();
    //$('#memid').editable();
    //$('#memtel').editable();
    //$('#mememail').editable();
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
