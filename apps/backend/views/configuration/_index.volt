{% extends "templates/index.volt" %}
{% block content_header %}
    <small>Конфигурация</small>
{% endblock %}
{% block breadcrumb %}
    <li>Настройки</li>
    <li class="active">Конфигурация</li>
{% endblock %}

{% block body %}
    <div class="col-xs-12">
        <div class="row">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title d-block cleafix">Конфигурация</h3>
                </div>
                <!-- /.box-header -->
                <form action="{{ indexUrl }}" method="POST">
                    <div class="box-body clearfix">
                        <div class="form-group">
                            <label for="editor">Информация в футере:</label>
                            <textarea name="footer" id="editor" cols="30" rows="10">{{ configuration['footer'] is defined ? configuration['footer'] : '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="comment_count">Количество комментариев:</label>
                            <input type="text" class="form-control" name="comment_count" id="comment_count" value="{{ configuration['comment_count'] is defined ? configuration['comment_count'] : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="comment_moderation">Модерация комментариев:</label>
                            <input type="checkbox" class="form-control" name="comment_moderation" id="comment_moderation" value="1" {{ configuration['comment_moderation'] is defined and configuration['comment_moderation'] ? 'checked="checked"' : '' }}>
                        </div>
                        <div class="form-group">
                            <label for="page_count">Количество выводимых страниц:</label>
                            <input type="text" class="form-control" name="page_count" id="page_count" value="{{ configuration['page_count'] is defined ? configuration['page_count'] : '' }}">
                        </div>
                        <button class="btn btn-primary">Сохранить</button>
                    </div>
                </form>
                <!-- /.box-body -->
            </div>
        </div>
        <!-- /.box -->
    </div>
{% endblock %}
{% block js %}
{% endblock %}