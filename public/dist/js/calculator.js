$(document).ready(function () {
    $(document).on('focus', '.calculator-col input', function() {
        $('.calculator__btn').attr('title', 'Новый расчет').attr('onclick', 'clearFields($(this))').removeClass('play').addClass('stop').siblings('strong').text('Сброс  ');
    });

});

function calculate(that) {
    $('#fuel_price_total').removeClass('calculator-input_error');

    var n = false,
        g = false,
        c = false,
        l = false,
        s = false,
        c1 = false,
        s1 = false;
    $("#fuel_col, #fuel_cons, #fuel_dist, #fuel_price, #fuel_price_total").prop('disabled', true);

    that.attr('title', 'Новый расчет').attr('onclick', 'clearFields($(this))').removeClass('play').addClass('stop').siblings('strong').text('Сброс  ');

    n = calculateN();
    g = calculateG();
    c = calculateC();
    l = calculateL();
    s = calculateS();
    c1 = calculateC1();
    s1 = calculateS1();
}

function fixed(val) {
    return val.toFixed(2);
}

function clearFields(that) {
    that.attr('title', 'Расчитать').attr('onclick', 'calculate($(this))').removeClass('stop').addClass('play').siblings('strong').text('Расчитать');
    $("#fuel_way, #fuel_price_way, #fuel_total, #fuel_col, #fuel_cons, #fuel_dist, #fuel_price, #fuel_price_total").val('');
}

function calculateN() {
    var input_1 = $("#fuel_col"),
        input_2 = $("#fuel_cons"),
        input_3 = $("#fuel_dist"),
        input_5 = $("#fuel_price"),
        input_6 = $("#fuel_price_total"),
        g = parseFloat(input_2.val().replace(',', '.')),
        l = parseFloat(input_3.val().replace(',', '.')),
        C = parseFloat(input_5.val().replace(',', '.')),
        c = parseFloat(input_6.val().replace(',', '.')),
        n = parseFloat(input_1.val());

    if(n)
        return n;

    if(g && l) {
        input_1.val(fixed(g*l/100));
        n = parseFloat(input_1.val());
    }

    if(c && C) {
        input_1.val(fixed(c/C));
        n = parseFloat(input_1.val());
    }

    calculateS();
    calculateC1();
    calculateC();
    calculateS1();

    return n;
}

function calculateG() {
    var input_1 = $("#fuel_col"),
        input_2 = $("#fuel_cons"),
        input_3 = $("#fuel_dist"),
        n = parseFloat(input_1.val().replace(',', '.')),
        l = parseFloat(input_3.val().replace(',', '.')),
        g = parseFloat(input_2.val());

    if(g)
        return g;

    if(n && l) {
        input_2.val(fixed(n/l*100));
        g = parseFloat(input_2.val());
    }

    calculateS();
    calculateC1();
    calculateS1();

    return g;
}

function calculateC() {

    var input_1 = $("#fuel_col"),
        input_5 = $("#fuel_price"),
        input_6 = $("#fuel_price_total"),
        n = parseFloat(input_1.val().replace(',', '.')),
        C = parseFloat(input_5.val().replace(',', '.')),
        c = parseFloat(input_6.val());

    input_6.removeClass('calculator-input_error');

    if(c)
        return c;

    if(n && C) {
        input_6.val(fixed(n*C));
        c = parseFloat(input_6.val());
    }

    calculateC1();
    calculateS1();

    return c;
}

function calculateL() {
    var input_1 = $("#fuel_col"),
        input_2 = $("#fuel_cons"),
        input_3 = $("#fuel_dist"),
        input_6 = $("#fuel_price_total"),
        n = parseFloat(input_1.val().replace(',', '.')),
        g = parseFloat(input_2.val().replace(',', '.')),
        c = parseFloat(input_6.val().replace(',', '.')),
        c1 = false,
        l = parseFloat(input_3.val());

    if(l)
        return l;

    if(n && g) {
        input_3.val(fixed(n/g*100));
        l = parseFloat(input_3.val());
    }

    if(c && c1) {
        input_3.val(fixed(c/c1));
        l = parseFloat(input_3.val());
    }
    calculateS();
    calculateC1();
    calculateS1();

    return l;
}



function calculateS() {
    var input_1 = $("#fuel_col"),
        input_3 = $("#fuel_dist"),
        input_4 = $("#fuel_way"),
        n = parseFloat(input_1.val().replace(',', '.')),
        l = parseFloat(input_3.val().replace(',', '.')),
        s = parseFloat(input_4.val());

    if(s)
        return s;

    if(n && l) {
        input_4.val(fixed(l/n));
        s = parseFloat(input_4.val());
    }

    calculateC1();
    calculateS1();

    return s;
}



function calculateS1() {
    var input_3 = $("#fuel_dist"),
        input_6 = $("#fuel_price_total"),
        input_8 = $("#fuel_total"),
        l = parseFloat(input_3.val().replace(',', '.')),
        c = parseFloat(input_6.val().replace(',', '.')),
        s1 = parseFloat(input_8.val());

    if(s1)
        return s1;

    if(l && c) {
        input_8.val(fixed(l/c));
        s1 = parseFloat(input_8.val());
    }

    return s1;
}



function calculateC1() {
    var input_3 = $("#fuel_dist"),
        input_6 = $("#fuel_price_total"),
        input_7 = $("#fuel_price_way"),
        l = parseFloat(input_3.val().replace(',', '.')),
        c = parseFloat(input_6.val().replace(',', '.')),
        c1 = parseFloat(input_7.val());

    if(c1)
        return c1;

    if(l && c) {
        input_7.val(fixed(c/l));
        c1 = parseFloat(input_7.val());
    }

    return c1;
}

function checkPrice() {
    var text = 'Введите стоимость топлива',
        element = $('#fuel_price_total'),
        className = 'calculator-input_error';

    if (!parseFloat($('#fuel_price').val())) {
        element.addClass(className);
        element.val(text);
        return false;
    } else if (element.hasClass(className)) {
        element.removeClass(className);
        element.val('');
        return true;
    }

    return true;
}