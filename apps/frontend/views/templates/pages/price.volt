<h1 class="title title--green">{{ category.name }}</h1>
{% if pages is defined and pages %}
    <ul class="news-list">
        {% for page in pages %}
            <li class="news-item clearfix">
                <div class="news-img col-sm-4"><img src="{{ link.getPageImage(page) }}" alt="{{ page['name'] }}" title="{{ page['name'] }}" class="img-responsive"></div>
                <div class="news-text col-sm-8">
                    <h3 class="news-text--title"><a href="{{ link.getPageLink(page['id_page']) }}" title="{{ page['name'] }}">{{ page['name'] }}</a></h3>
                </div>
            </li>
        {% endfor %}
    </ul>
{% endif %}