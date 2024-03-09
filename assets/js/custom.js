$(document).ready(function () {
    $('.sidebar-filter-clear').on('click', function(e) {
        $.ajax({
            url: "./View/get_data.php",
            method: "post",
            data: {
                action: 'get_data',
            },
            success: function (data) {
                $('#filter_data').html(data);
            }
        });
    })
    // $('input').filter(':checkbox').prop('checked',false);
    filter_data();
    function filter_data() {
        var action = 'get_data';
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var category = get_filter('category');
        var sortByDate = $('#sortby').val();
        var search= $('#search').val();
        var data = {};
        var short = {}
        switch (sortByDate) {
            case 'id':
                short ={condition: 'id'};
                break;
        
            case 'popularity':
                short = {condition: 'popularity'}
                break;
        
            case 'ascendingPrice':
                short = {condition: 'ascendingPrice'}
                break;
        
            case 'descendingPrice':
                short = {condition: 'descendingPrice'}
                break;
        
            default:
                break;
        }
        data = {
            action: action,
            minimum_price: minimum_price,
            maximum_price: maximum_price,
            category: category,
            condition: short.condition,
            search:search,
        }
        console.log(data);
        $.ajax({
            url: "./View/get_data.php",
            method: "post",
            data: data,
            success: function (data) {
                $('#filter_data').html(data);
            }
        });
    }

    $('#sortby').change(function () {
        filter_data();
    });

    function get_filter(class_name) {
        var filter = [];
        $('.' + class_name + ':checked').each(function () {
            filter.push($(this).val());
        });
        return filter;
    }

    $('.common_select').click(function () {
        filter_data();
    });

    $("#price_range").slider({
        range: true,
        min: 100,
        max: 10000,
        values: [100, 10000],
        step: 100,
        stop: function (event, ui) {
            console.log(ui);
            $('#price_show').html('Price Range: From' + ui.values[0] + '$ to ' + ui.values[1] + '$');
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            filter_data();
        }
    });
});
