<div class="column-left col-sm-2">
    {% if subcategories is defined and subcategories|length > 0 %}
        <div class="block">
            <div class="block__title">Категории</div>
            <div class="blockleftmenu block__content">
                <ul class="menu">
                    {{ makemenu(subcategories, selected) }}
                </ul>
            </div>
        </div>
    {% endif %}
    <div class="b-left b_6 bnr" data-params='{"id_banner" : 0, "id_position": 6, "id_category": {% if category is defined %}{{ category.id_category }}{% else %}0{% endif %}, "google":{% if banners[6] is defined %}1{% else %}0{% endif %}}'>
        {#{% include 'templates/banner' with ['position':6] %}#}
    </div>
</div>