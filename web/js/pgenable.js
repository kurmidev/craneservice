$(function () {

    /*$('.cal').daterangepicker({
        singleDatePicker: true,
        locale: {
            format: "yyyy-MM-DD"
        }
    });*/

    jQuery('.cal').datetimepicker({
        i18n: {
            de: {
                months: [
                    'Januar', 'Februar', 'March', 'April',
                    'May', 'June', 'July', 'August',
                    'September', 'October', 'November', 'December',
                ],
                dayOfWeek: [
                    "Su", "Mo", "Tu", "We",
                    "Th", "Fr", "Sa.",
                ]
            }
        },
        timepicker: false,
        format: 'Y-m-d'
    });

    $('.timepick').timepicker({
        timeFormat: 'h:mm p',
        scrollbar: true,
        dropdown: true,
        dynamic: false,
    });



    /*jQuery('.timepick').datetimepicker({
     datepicker:false,
     formatTime:'h:m',
     format:'h:m',
     onChangeDateTime:function(dp,$input){
        
         // alert($input.val())
       }
 });*/

    /*$('.timepick').daterangepicker({
        singleDatePicker: true,
        timePicker: true,
        timePicker24Hour: false,
        timePickerIncrement: 1,
        locale: {
            format: 'hh:mm A'
        }
    }).on('show.daterangepicker', function (ev, picker) {
        picker.container.find(".calendar-table").hide();
    });*/

    $('body').on('focus', ".timepick", function () {

        /*$(this).datetimepicker({
            datepicker:false,
            formatTime:'h:m a',
            format:'h:m a'
        });*/

        $(this).timepicker({
            timeFormat: 'h:mm p',
            scrollbar: true,
            dropdown: true,
            dynamic: false,
        });

        /* $(this).daterangepicker({
             singleDatePicker: true,
             timePicker: true,
             timePicker24Hour: false,
             timePickerIncrement: 1,
             locale: {
                 format: 'hh:mm A'
             }
         }).on('show.daterangepicker', function (ev, picker) {
             picker.container.find(".calendar-table").hide();
         });*/
    });

    $(".searchd").hide();

    $(".lvl2").hide();
    $(".lvl3").hide();
    $(".lvl4").hide();
    $("#form-challan").submit(function (e) {
        e.preventDefault();
        submitChallanForm();
    });
    $("#challan-submit").on('click', function (e) {
        e.preventDefault();
        submitChallanForm();
    });

    $('body').on('click', ".del-challan", function () {
        var url = $(this).attr('url');
        var utr_id = $(this).attr('rel');
        $.get(url,
            function (data, status) {
                $('#' + utr_id).remove();
            }, 'json');
    });

    $("#challanform-plan_id").on("change", function (event) {
        var price = $('option:selected', this).attr('price');
        var plan_type = $('option:selected', this).attr('plan_type');
        var plan_id = $(this).val();
        $(".lvl1").hide();
        $(".lvl2").hide();
        $(".lvl3").hide();
        $(".lvl4").hide();

        $("#break_time").show();
        $("#up_time").show();
        $("#down_time").show();

        alert(plan_type);

        if (plan_type === "3") {
            $("#plan_trip").show();
            $("#plan_measure").show();
        } else if (plan_type === "5" || plan_type === "1") {
            $("#plan_start_time").show();
            $("#plan_end_time").show();
        } else if (plan_type === "2") {
            $("#day_wise").show();
        } else if (plan_type === "4") {
            $("#from_destination").show();
            $("#to_destination").show();
        }else if(plan_type === "6"){
            $("#up_time").hide();
            $("#down_time").hide();
            $("#plan_start_time").show();
            $("#plan_end_time").show();
            $("#plan_extra_hours").show();
            $("#plan_shift_type").show();
            $("#break_time").hide();
        }
        $("#amount").val(price);
    });

    $(".caldiff").on("click", function (event) {
        console.log("e.kdsn");
        calculateTotalTime();
    });

    $('.select2').select2();

});

$('document').ready(function () {
    $('.deletemodal').on("click", function (e) {
        e.preventDefault();
        var button = $(this) // Button that triggered the modal
        var url = button.attr('data-url'); // Extract info from data-* attributes
        var title = button.attr('data-title');
        var body = button.attr('data-body');
        console.log('modal data', url, title, body);
        $('#defaultModal')
            .find('.modal-header > h3').text(title).end()
            .find('.modal-body').html(body).end()
            .find('#modal-delete').attr('url', url).end()
            .modal('show');
    });

    $(".caldiff").on("click", function (event) {
        console.log("e.kdsn");
        calculateTotalTime();
    });

});

function validateform(value, plan_type) {
    $is_valid = true;
    if (plan_type === "3") {
        if (value['ChallanForm[plan_trip]'] === "") {
            $("#error_plan_trip").html("Value is required");
            $is_valid = $is_valid && false;
        }
        if (value['ChallanForm[plan_measure]'] === "") {
            $("#error_plan_measure").html("Value is required");
            $is_valid = $is_valid && false;
        }
    } else if (plan_type === "5" || plan_type === "1" || plan_type === "6") {
        if (value['ChallanForm[plan_start_time]'] === "") {
            $("#error_plan_trip").html("Value is required");
            $is_valid = $is_valid && false;
        }
        if (value['ChallanForm[plan_end_time]'] === "") {
            $("#error_plan_end_time").html("Value is required");
            $is_valid = $is_valid && false;
        }
    } else if (plan_type === "2") {
        if (value['ChallanForm[day_wise]'] === "") {
            $("#error_day_wise").html("Value is required");
            $is_valid = $is_valid && false;
        }
    } else if (plan_type === "4") {
        if (value['ChallanForm[from_destination]'] === "") {
            $("#error_from_destination").html("Value is required");
            $is_valid = $is_valid && false;
        }
        if (value['ChallanForm[to_destination]'] === "") {
            $("#error_to_destination").html("Value is required");
            $is_valid = $is_valid && false;
        }
    }
    return $is_valid;
}

function calculateTotalTime() {
    if ($("#plan_start_time").is(":visible") && $("#plan_end_time").is(":visible")) {
        if ($("#challanform-plan_start_time").val() !== "" && $("#challanform-plan_end_time").val() !== "") {
            var start = $("#challanform-plan_start_time").val();
            var end = $("#challanform-plan_end_time").val();
            console.log(start,end);
            var timeStart = new Date("01/01/2007 " + start);
            var timeEnd = new Date("01/01/2007 " + end);
            var diff = (timeEnd - timeStart) / 60000;
            var break_time = $("#challanform-break_time").val() || 0;
            var up_time = $("#challanform-up_time").val() || 0;
            var down_time = $("#challanform-down_time").val() || 0;
            diff = diff - parseInt(break_time) + parseInt(up_time) - parseInt(down_time);
            var minutes = diff % 60;
            var hours = (diff - minutes) / 60;
            $("#challanform-plan_extra_hours").val(hours + ":" + minutes + "hrs");
        }
    }
}

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

function addmoretablerowdetails() {
    var $cloneObj = $("#clonetable tbody tr:first").clone();
    var len = ($('#clonetable > tbody').children().length) + 1;
    console.log($cloneObj);

    $cloneObj.find('td:last span').attr('onclick', "$(this).closest(\'tr\').remove();");
    // $cloneObj.find('td:last span').attr('class', "fa fa-minus btn btn-danger btn-xs");
    $cloneObj.find(":input").each(function () {
        console.log($(this).attr('name'), len);
        if (!$(this).is("button")) {
            $(this).val('');
            $(this).attr('name', $(this).attr('name').replace(/\[\d+]/, '[' + len + ']'));
            $(this).attr('id', $(this).attr('id').replace(/\_\d+_/, '_' + len + '_'));
            if ($(this).attr('rel') !== undefined) {
                $(this).attr('rel', $(this).attr('rel').replace(/\_\d/, '_' + len));
            }
        }
    }).end().appendTo("table");

}

function submitChallanForm() {
    $('#challan-submit').prop('disabled', true);
    $('#challan-submit').html('Adding Please wait....');
    var actionUrl = $("#form-challan").attr("action");
    var inputs = $('#form-challan :input');
    var values = {};
    var price = $('#challanform-plan_id option:selected').attr('price');
    var plan_type = $('#challanform-plan_id option:selected').attr('plan_type');
    inputs.each(function () {
        values[this.name] = $(this).val();
    });

    var is_valid = validateform(values, price, plan_type);
    if (is_valid) {
        $.post(actionUrl, $('#form-challan').serialize(),
            function (data, status) {
                $(':input', '#form-challan')
                    .not(':button, :submit, :reset, :hidden')
                    .val('')
                    .prop('checked', false)
                    .prop('selected', false);
                $("#adddata tbody").append(data.data);
                $('#challan-submit').html('Add More');
                $('#challan-submit').prop('disabled', false)
            }, 'json');
    }
}
