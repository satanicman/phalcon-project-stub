{% extends "templates/index.volt" %}
{% block vars %}
    {% set left = 0 %}
    {% set right = 0 %}
{% endblock %}
{% block content %}
    <h1 class="page-header--title title title--main">Статистика</h1>
    <table class="table table-hover">
        <thead>
        <tr>
            <th class="text-center">Название</th>
            <th class="text-center">Кол-во просмотров</th>
            <th class="text-center">Кол-во кликов</th>
            <th class="text-center">Кол-во уникальных просмотров</th>
            <th class="text-center">Кол-во уникальных кликов</th>
        </tr>
        </thead>
        <tbody>
        {% if statistic is defined %}
            {% for item in statistic %}
                <tr id="item_{{ item['id_banner'] }}">
                    <td class="col-xs-4 text-center">{{ item['name'] }}</td>
                    <td class="col-xs-2 text-center">{{ item['_show'] }}</td>
                    <td class="col-xs-2 text-center">{{ item['_click'] }}</td>
                    <td class="col-xs-2 text-center">{{ item['clear_show'] }}</td>
                    <td class="col-xs-2 text-center">{{ item['clear_click'] }}</td>
                </tr>
            {% endfor %}
        {% endif %}
        </tbody>
    </table>
{% endblock %}