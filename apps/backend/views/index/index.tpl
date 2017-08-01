{extends file="../layouts/layout.tpl"}
{block name="content"}
    <div class="login-box">
        <div class="login-logo">
            <b>Admin</b>Panel
        </div><!-- /.login-logo -->
        <div class="login-box-body">
            <form action="{$baseUrl}" method="post">
                {$flash->output()}
                <div class="form-group has-feedback">
                    <input type="text" name="email" class="form-control" placeholder="E-mail" />
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Пароль" />
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Войти</button>
                    </div><!-- /.col -->
                </div>
            </form>
        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
{/block}