{% if rubrics is defined AND rubrics %}
    {% include "templates/pages/blog" with ['rubrics' : rubrics] %}
{% elseif pages is defined AND pages %}
    {% if pages|length > 1 %}
        {% include "templates/news" with ['pages' : pages] %}
    {% else %}
        {% include "templates/pages/singl" with ["page" : pages[0]] %}
    {% endif %}
{% else %}
    <div class="page-header">
        <h1 class="page-header--title title title--main">{{ category.name }}</h1>
    </div>
    <div class="page-text">
        {{ category.description }}
    </div>
{% endif %}