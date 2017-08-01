{% if fuels is defined and fuels %}
    <div class="fuel-country-prices">
        <ul class="nav nav-tabs fuel-country-prices__tabs">
            {% for name, fuel in fuels %}
                <li><a data-toggle="tab" href="#fuel_tabs_{{ fuel['id'] }}">{{ name }}</a></li>
            {% endfor %}
        </ul>
        <div class="tab-content  fuel-country-prices__tabs-content">
            {% for name, fuel in fuels %}
                {% if fuel['azses'] is defined and fuel['azses']|length %}
                    <div id="fuel_tabs_{{ fuel['id'] }}" class="tab-pane fade fuel">
                        <div class="fuel__list">
                            <ul class="fuel-list">
                                {% for azs in fuel['azses'] %}
                                    <li class="fuel-list__item">
                                        <p class="fuel-item">
                                            <span class="fuel-item__name"><span class="fuel-name">{{ azs['name'] }}</span></span><span class="fuel-item__price"><span class="fuel-price">{{ azs['price'] }}</span> <span class="fuel-currency">Грн.</span></span>
                                        </p>
                                    </li>
                                {% endfor %}
                            </ul>
                        </div>
                    </div>
                {% endif %}
            {% endfor %}
        </div>
    </div> <!-- fuel-country-prices -->
{% else %}
    <p class="page-text">Нет результатов...</p>
{% endif %}