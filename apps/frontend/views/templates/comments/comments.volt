<div class="comments-block col-sm-8 col-sm-push-2">
    {% if comments|length > 0 %}
        <p class="comments-total" data-count="{{ comments|length }}"><span>{{ pluralcomments(comments|length) }}</span></p>
        <ul class="comments-list" data-total="{{ totalComments }}" data-id="{{ id }}" data-type="{{ type }}">
            {% include "templates/comments/item" with ["comments" : comments] %}
        </ul>
        {% if totalComments > count %}
            <button class="btn btn-default comments-more">Показать еще</button>
        {% endif %}
    {% endif %}
    <form action="{{ baseUrl }}comments/add/{{ type }}/{{ id }}" class="comments-form" method="POST">
        <div class="form-group clearfix">
            <input type="text" name="name" class="form-control comments-form--input" placeholder="Ваше имя">
            <input type="text" name="description" class="form-control comments-form--input" placeholder="Оставить отзыв">
            <button class="comments-form--btn"><i class="icon icon-paper-plane"></i></button>
        </div>
    </form>
</div>