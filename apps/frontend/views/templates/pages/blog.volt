<div class="page-header">
    <h1 class="page-header--title title title--main">{{ category.name }}</h1>
</div>
<div class="tab-content">
    {% for rubric in rubrics %}
        <div id="rubric_tab_{{ rubric['id_rubric'] }}_{{ category.id_category }}" class="tab-pane fade">
            {% if rubric['pages'] is defined and rubric['pages'] %}
                {% include "templates/news" with ['pages' : rubric['pages']] %}
            {% elseif rubric['description'] %}
                <div class="page-text">
                    {{ rubric['description'] }}
                </div>
            {% endif %}
        </div>
    {% endfor %}
    <div id="overlay"></div>
</div>