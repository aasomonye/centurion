$(function() {

    // $('input[name="book-date"]').daterangepicker({
    //     autoUpdateInput: false,
    //     locale: {
    //         cancelLabel: 'Clear'
    //     }
    // });

    $('input[name="book-date"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });

    $('input[name="book-date"]').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });

});