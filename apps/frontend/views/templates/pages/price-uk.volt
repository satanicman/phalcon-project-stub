<h1 class="title title--green">{{ category.name }}</h1>
<div class="fuel-country">
    <div class="fuel-country__header">
        <div class="fuel-country-header">
            {% if dates is defined and dates %}
            <div class="fuel-country-header__col">
                <div class="fuel-country-col">
                    <label for="datepicker" class="fuel-country-col__title">
                        <span class="fuel-country-title">Дата:</span>
                    </label>
                    <div class="fuel-country-col__select">
                        <input type="text" id="datepicker" class="fuel-country-select fuel-country-select__input">
                        {#<select name="country_date" id="country_date" class="fuel-country-select" onchange="changeDate(this.value)">#}
                            {#{% for d in dates %}#}
                                {#<option value="{{ d['date'] }}"{% if d['date'] == date %} selected="selected"{% endif %}>{{ date('d-m-Y', strtotime(d['date'])) }}</option>#}
                            {#{% endfor %}#}
                        {#</select>#}
                    </div>
                </div> <!-- fuel-country-col -->
            </div> <!-- fuel-country-header__col -->
            {% endif %}
            {% if regions is defined and regions %}
            <div class="fuel-country-header__col">
                <div class="fuel-country-col">
                    <label for="country_name" class="fuel-country-col__title">
                        <span class="fuel-country-title">Область:</span>
                    </label>
                    <div class="fuel-country-col__select">
                        <select name="country_name" id="country_name" class="fuel-country-select" onchange="changeRegion(this.value)">
                            {% for r in regions %}
                                <option value="{{ r['id_region'] }}"{% if r['id_region'] == id_region %} selected="selected"{% endif %}>{{ r['name'] }}</option>
                            {% endfor %}
                        </select>
                    </div>
                </div>  <!-- fuel-country-col -->
            </div> <!-- fuel-country-header__col -->
            {% endif %}
        </div> <!-- fuel-country-header -->
    </div> <!-- fuel-country__header -->
    <div class="fuel-country__prices">
        {% include "category/change.volt" %}
    </div>
</div>
{% if category.description %}
    <div class="page-text">
        {{ category.description }}
    </div>
{% endif %}
