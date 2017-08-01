{% extends "templates/index.volt" %}
{% block meta %}
    <title>{% if page.meta_title %}{{ page.meta_title }}{% else %}{{ page.name }}{% endif %}</title>
    <meta name="description" content="{{ page.meta_description }}">
    <meta name="keywords" content="{{ page.meta_keywords }}">
{% endblock %}
{% block style %}
    <link rel="stylesheet" href="{{ baseUrl }}/dist/css/modules/comments.css">
{% endblock %}
{% block vars %}
    {#{% set left = 0 %}#}
    {#{% if subcategories|length > 0 %}#}
        {#{% set left = 2 %}#}
    {#{% endif %}#}
    {% set right = 3 %}
{% endblock %}
{% block leftMenu %}
    {#{% if subcategories|length > 0 %}#}
        {% include "templates/left-column" with ["subcategories" : subcategories] %}
    {#{% endif %}#}
{% endblock %}
{% block content %}
    {% include "templates/pages/singl" with ["page" : page] %}
{% endblock %}
{% block comments %}
    {% include "templates/comments/comments" with ["comments" : comments, "type" : "page", "id" : page['id_page'], "count" : countComments] %}
{% endblock %}
{% block js %}
{% endblock %}