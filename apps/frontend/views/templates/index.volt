<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    {% block meta %}
    {% endblock %}
    <link rel="stylesheet" href="{{ baseUrl }}dist/css/global.css">
    <link rel="stylesheet" href="{{ baseUrl }}dist/css/modules/blockleftmenu.css">
    <link rel="stylesheet" href="{{ baseUrl }}dist/css/modules/searchblock.css">
    <link rel="stylesheet" href="{{ baseUrl }}dist/css/tire.css">
    <link rel="stylesheet" href="{{ baseUrl }}plugins/datepicker/datepicker3.css">
    {% block style %}
    {% endblock %}
</head>
<body id="news">
<div id="page">
    <div class="container">
        <div class="row content" id="content">
            {% if category is defined %}
                {% set c_id = category.id_category %}
            {% elseif page is defined %}
                {% set c_id = page['id_category'] %}
            {% else %}
                {% set c_id = 0 %}
            {% endif %}
            <div class="header_top">
                <div class="b-header-top b_3 bnr" data-params='{"id_banner" : 0, "id_position": 3, "id_category": {{ c_id }}, "google":{% if banners[3] is defined %}1{% else %}0{% endif %}}'>
                    {#{% include 'templates/banner' with ['position':3] %}#}
                </div>
            </div>
            <div class="b-main-left b-main b_1 bnr" data-params='{"id_banner" : 0, "id_position": 1, "id_category": {{ c_id }}, "google":{% if banners[1] is defined %}1{% else %}0{% endif %}}'>
                {#{% include 'templates/banner' with ['position':1] %}#}
            </div>
            <div class="b-main-right b-main b_2 bnr" data-params='{"id_banner" : 0, "id_position": 2, "id_category": {{ c_id }}, "google":{% if banners[2] is defined %}1{% else %}0{% endif %}}'>
                {#{% include 'templates/banner' with ['position':2] %}#}
            </div>
            <header class="clearfix" id="header">
                <div class="col-md-3 b-header b-header--left">
                    <div class="row b_4 bnr" data-params='{"id_banner" : 0, "id_position": 4, "id_category": {{ c_id }}, "google":{% if banners[4] is defined %}1{% else %}0{% endif %}}'>
                        {#{% include 'templates/banner' with ['position':4] %}#}
                    </div>
                </div>
                <div class="col-md-6 header--center">
                    <div class="row">
                        <div id="header_logo"><a href="/"><img src="/dist/img/logo.png" alt="logo"
                                                               class="img-responsive"></a></div>
                        <div id="search-block" class="search-block">
                            <form action="{{ url }}search" class="search-form">
                                <input name="search_query" type="text" class="form-control search-form--input" placeholder="Поиск по сайту"{% if search_query is defined and search_query %}value="{{ search_query }}"{% endif %}>
                                <button class="search-form--button">
                                    <i class="icon icon-search" aria-hidden="true"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 b-header b-header--right">
                    <div class="row b_5 bnr" data-params='{"id_banner" : 0, "id_position": 5, "id_category": {{ c_id }}, "google":{% if banners[5] is defined %}1{% else %}0{% endif %}}'>
                        {#{% include 'templates/banner' with ['position':5] %}#}
                    </div>
                </div>
            </header>
            {#<div class="horisontal_menu container">#}
                <nav class="navbar navbar-blue container horisontal_menu">
                    <div class="container-fluid">
                        <div class="navbar-header" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <button type="button" class="navbar-toggle collapsed">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#">Меню</a>
                        </div>

                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                {{ makemenu(horizontal_menu_items, selected) }}
                            </ul>
                        </div>
                    </div>
                </nav>
            {#</div>#}
            {#<nav class="horisontal_menu container">#}
                {#<ul class="clearfix">#}
                    {#{{ makemenu(horizontal_menu_items, selected) }}#}
                {#</ul>#}
            {#</nav>#}
            <div class="content">
                <div class="content--top col-sm-12">
                    <div class="tabs-top">
                        {% block tabs_top %}
                        {% endblock %}
                    </div>
                    <div class="clearfix column-wrap row">
                        {% set left = 2 %}
                        {% set right = 3 %}
                        {% set center = 12 %}
                        {% block vars %}
                            {#{% set left = 0 %}#}
                        {% endblock %}
                        {% if left and right %}{% set center = center-(left+right) %}{% elseif left %}{% set center = center-left %}{% elseif right %}{% set center = center-right %}{% endif %}
                        {% block leftMenu %}
                        {% endblock %}
                        <div class="column-center col-sm-{{ center }}">
                            {% block content %}
                            {% endblock %}
                            <p>Поделиться</p>
                            <div class="share42init"></div>
                            {% if pages_nb is defined and pages_nb %}
                                {% include "partials/pagination.volt" %}
                            {% endif %}
                        </div>
                        <div class="column-right col-sm-{{ right }}">
                        {% if right %}
                            <div class="b-right b_7 bnr" data-params='{"id_banner" : 0, "id_position": 7, "id_category": {{ c_id }}, "google":{% if banners[7] is defined %}1{% else %}0{% endif %}}'>
                                {#{% include 'templates/banner' with ['position':7] %}#}
                            </div>
                            <div class="b-right b_8 bnr" data-params='{"id_banner" : 0, "id_position": 8, "id_category": {{ c_id }}, "google":{% if banners[8] is defined %}1{% else %}0{% endif %}}'>
                                {#{% include 'templates/banner' with ['position':8] %}#}
                            </div>
                        {% endif %}
                        </div>
                    </div>
                    <div class="b-bottom clearfix b_9 bnr" data-params='{"id_banner" : 0, "id_position": 9, "id_category": {{ c_id }}, "google":{% if banners[9] is defined %}1{% else %}0{% endif %}}'>
                        {#{% include 'templates/banner' with ['position':9] %}#}
                    </div>
                </div> <!-- content--top #END -->
                <div class="content--bottom clearfix">
                    {% block comments %}
                    {% endblock %}
                </div>
            </div> <!-- content #END -->
        </div> <!-- row #END -->
    </div> <!-- container #END -->
    <footer id="footer" class="footer">
        <i class="icon tire-icon footer-icon"></i>
        <div class="footer-container container">
            <div class="clearfix">
                {{ configuration['footer'] }}
            </div> <!-- clearfix -->
        </div> <!-- footer-container -->
    </footer>
</div>
<script src="{{ baseUrl }}dist/js/global.js"></script>
<script src="{{ baseUrl }}dist/js/tire_calc.js"></script>
<script src="{{ baseUrl }}plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="{{ baseUrl }}plugins/datepicker/locales/bootstrap-datepicker.ru.js"></script>
<script src="{{ baseUrl }}dist/js/share42/share42.js"></script>
<script>
    var baseUrl = '{{ baseUrl }}';
    var url = '{{ url }}';
</script>
{% block js %}
{% endblock %}
</body>
</html>
</body>
</html>