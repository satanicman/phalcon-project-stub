<h1 class="title title--main">{{ category.name }}</h1>
<ul class="brands-list clearfix row">
    {% for page in pages %}
        <li class="brands-list--item col-xs-2">
            <a href="{{ link.getPageLink(page) }}">
                <div class="brands-list--img">
                    <img src="{{ link.getPageImage(page) }}" alt="{{ page['name'] }}" title="{{ page['name'] }}" class="img-responsive">
                </div>
                <p class="brands-list--text">{{ page['name'] }}</p>
            </a>
        </li>
    {% endfor %}
</ul>
{{ category.description }}