{% extends "templates/index.volt" %}
{% block meta %}
    <title>Поиск</title>
    <meta name="description" content="Поиск {{ search_query }}">
    {#<meta name="keywords" content="{{ category.meta_keywords }}">#}
{% endblock %}
{% block style %}
    {% if styles is defined and styles|length %}
        {% for style in styles %}
            <link rel="stylesheet" href="{{ baseUrl }}dist/{{ style['path'] }}">
        {% endfor %}
    {% endif %}
{% endblock %}
{% block vars %}
    {% set left = 0 %}
    {% set right = 0 %}
{% endblock %}
{% block content %}
    {% if pages is defined and pages %}
        {% include "templates/news.volt" %}
    {% else %}
        {{ flash.output() }}
    {% endif %}
{% endblock %}
{% block js %}
    {% if scripts is defined and scripts|length %}
        {% for script in scripts %}
            <script src="{{ baseUrl }}dist/{{ script['path'] }}"></script>
        {% endfor %}
    {% endif %}
{% endblock %}