{% for comment in comments %}
    <li class="comments-item">
        <div class="comments-icon"><i class="user-icon icon"></i></div>
        <div class="comments-text">
            <div class="comments-text--title"><span class="comments-text--name">{{ comment['name'] }}</span><span class="comments-text--time">{{ getDate(comment['date_add']) }}</span></div>
            <p class="comments-text--comment">{{ comment['description'] }}</p>
        </div>
        {% if comment['children'] is defined and comment['children'] %}
            <ul class="comments-children">
                {% include "templates/comments/item" with ["comments" : comment['children']] %}
            </ul>
        {% endif %}
    </li>
{% endfor %}