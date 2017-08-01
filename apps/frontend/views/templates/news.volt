<ul class="news-list">
    {% for page in pages %}
    <li class="news-item news-item_news clearfix">
        <div class="news-img col-md-4"><a href="{{ link.getPageLink(page['id_page']) }}">
                <img src="{{ link.getPageImage(page) }}" alt="{{ page['name'] }}" title="{{ page['name'] }}" class="img-responsive news-img_main">
                <img src="{{ link.getPageImage(page, 'thumb') }}" alt="{{ page['name'] }}" title="{{ page['name'] }}" class="img-responsive news-img_thumb">
            </a></div>
        <div class="news-text col-md-8">
            <div class="page-header news-text--header clearfix">
                <h3 class="page-header--title news-text--title"><a href="{{ link.getPageLink(page['id_page']) }}">{{ page['name'] }}</a></h3>
                <div class="page-header--info">
                    {% if page['edit_date'] %}
                        {% set page_date = page['edit_date'] %}
                    {% else %}
                        {% set page_date = page['create_date'] %}
                    {% endif %}
                            <span class="page-header--info-date page-header--info-content"><i
                                        class="icon clock-icon"></i><span
                                        class="page-header--info-value">{{ getDate(page_date) }}</span></span>
                    <span class="page-header--info-chat page-header--info-content"><i class="icon chat-icon"></i><span
                                class="page-header--info-value">{{ page['totalComments'] }}</span></span>
                    {#<span class="page-header--info-eye page-header--info-content"><i class="icon eye-icon"></i><span#}
                                {#class="page-header--info-value">56</span>#}
                    </span>
                </div>
            </div>
            <p class="news-text--content">{{ truncate(page['description']|striptags, 96, '') }} <a href="{{ link.getPageLink(page['id_page']) }}" class="more-link">(Подробнее...)</a></p>
        </div>
    </li>
    {% endfor %}
</ul>