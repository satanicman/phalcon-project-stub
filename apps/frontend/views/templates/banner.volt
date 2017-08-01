{% if banners is defined and banners[position] is defined %}
    {% if banners[position]['link'] %}
        <a href="{{ banners[position]['link'] }}" title="{{ banners[position]['name'] }}">
    {% endif %}
    {{ banners[position]['description'] }}
    {% if banners[position]['link'] %}
        </a>
    {% endif %}
{% endif %}