$(function () {

    $('.cal').daterangepicker({
        singleDatePicker: true,
        locale: {
            format: "yyyy-MM-DD"
        }
    });


    $('.timepick').daterangepicker({
        singleDatePicker: true,
        timePicker: true,
        timePicker24Hour: true,
        timePickerIncrement: 1,
        locale: {
            format: 'HH:mm'
        }
    }).on('show.daterangepicker', function (ev, picker) {
        picker.container.find(".calendar-table").hide();
    });

    $('body').on('focus', ".timepick", function () {
        $(this).daterangepicker({
            singleDatePicker: true,
            timePicker: true,
            timePicker24Hour: true,
            timePickerIncrement: 1,
            locale: {
                format: 'HH:mm'
            }
        }).on('show.daterangepicker', function (ev, picker) {
            picker.container.find(".calendar-table").hide();
        });
    });

    $(".searchd").hide();
});

function addmoretablerow() {
    var $cloneObj = $("#clonetable tbody tr:first").clone();
    var len = ($('#clonetable > tbody').children().length) + 1;
    console.log($cloneObj);

    $cloneObj.find('td:last span').attr('onclick', "$(this).closest(\'tr\').remove();");
    // $cloneObj.find('td:last span').attr('class', "fa fa-minus btn btn-danger btn-xs");
    $cloneObj.find(":input").each(function () {
        if (!$(this).is("button")) {
            $(this).val('');
            $(this).attr('name', $(this).attr('name').replace(/\[\d+]/, '[' + len + ']'));
        }

    }).end().appendTo("table");
}

function addmoretablerowdetails(){
    var $cloneObj = $("#clonetable tbody tr:first").clone();
    var len = ($('#clonetable > tbody').children().length) + 1;
    console.log($cloneObj);

    $cloneObj.find('td:last span').attr('onclick', "$(this).closest(\'tr\').remove();");
    // $cloneObj.find('td:last span').attr('class', "fa fa-minus btn btn-danger btn-xs");
    $cloneObj.find(":input").each(function () {
        console.log($(this).attr('name'),len);
        if (!$(this).is("button")) {
            $(this).val('');
            $(this).attr('name', $(this).attr('name').replace(/\[\d+]/, '[' + len + ']'));
            $(this).attr('id', $(this).attr('id').replace(/\_\d+_/, '_' + len + '_'));
            if($(this).attr('rel')!==undefined){
                $(this).attr('rel', $(this).attr('rel').replace(/\_\d/, '_' + len));
            }
        }
    }).end().appendTo("table");
    
}