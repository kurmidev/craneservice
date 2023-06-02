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

