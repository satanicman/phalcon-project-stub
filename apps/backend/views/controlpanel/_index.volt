{% extends "templates/index.volt" %}

{% block body %}
    Добро пожаловать в панель администратора
    {{ flash.output() }}
{% endblock %}