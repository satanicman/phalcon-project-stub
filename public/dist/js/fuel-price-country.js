$(document).ready(function () {
    selectTabs();
    $(document).on("changeDate", "#datepicker", function (e) {
        var date = $(this).data('datepicker').getFormattedDate('dd-mm-yyyy');
        changeDate(date);
    });
});

function changeDate(date) {
    var region = $('#country_name').val();
    $.ajax({
        url: '/ajax',
        type: 'GET',
        dataType: 'json',
        data: 'type=changeDate&date='+date+'&region='+region,
        success: function(jsonData) {
            $('.fuel-country__prices').hide().html(jsonData.result);
            selectTabs();
            $('.fuel-country__prices').fadeIn(300);
        }
    });
}

function changeRegion(id_region) {
    var date = $("#datepicker").data('datepicker').getFormattedDate('dd-mm-yyyy');
    $.ajax({
        url: '/ajax',
        type: 'GET',
        dataType: 'json',
        data: 'type=changeDate&date='+date+'&region='+id_region,
        success: function(jsonData) {
            $('.fuel-country__prices').hide().html(jsonData.result);
            selectTabs();
            $('.fuel-country__prices').fadeIn(300);
        }
    });
}

function selectTabs() {
    var tabs = $('.fuel-country-prices__tabs li');
    var content = $('.fuel-country-prices__tabs-content .tab-pane');
    tabs.removeClass('active');
    tabs.eq(2).addClass('active');
    content.removeClass('active in');
    content.eq(2).addClass('active in');
}
