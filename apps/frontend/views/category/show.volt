{% extends "templates/index.volt" %}
{% block meta %}
    <title>{% if category.meta_title %}{{ category.meta_title }}{% else %}{{ category.name }}{% endif %}</title>
    <meta name="description" content="{{ category.meta_description }}">
    <meta name="keywords" content="{{ category.meta_keywords }}">
{% endblock %}
{% block style %}
    {% if styles is defined and styles|length %}
        {% for style in styles %}
            <link rel="stylesheet" href="{{ baseUrl }}dist/{{ style['path'] }}">
        {% endfor %}
    {% endif %}
{% endblock %}
{% block vars %}
    {#{% set left = 0 %}#}
    {#{% if subcategories|length > 0 %}#}
        {#{% set left = 2 %}#}
    {#{% endif %}#}
{% endblock %}
{% block leftMenu %}
    {#{% if subcategories|length > 0 %}#}
        {% include "templates/left-column" with ["subcategories" : subcategories] %}
    {#{% endif %}#}
{% endblock %}
{% block tabs_top %}
    {% if rubrics is defined AND rubrics %}
        <ul class="nav nav-tabs">
            {% for rubric in rubrics %}
                {% if (rubric['pages'] is defined and rubric['pages']) or rubric['description'] %}
                    <li><a href="#rubric_tab_{{ rubric['id_rubric'] }}_{{ category.id_category }}" data-toggle="tab">{{ rubric['name'] }}</a></li>
                {% endif %}
            {% endfor %}
        </ul>
    {% endif %}
{% endblock %}
{% block content %}
    {% include "templates/pages/"~category.tpl %}
{% endblock %}
{% block js %}
    {% if scripts is defined and scripts|length %}
        {% for script in scripts %}
            <script src="{{ baseUrl }}dist/{{ script['path'] }}"></script>
        {% endfor %}
    {% endif %}
{% endblock %}