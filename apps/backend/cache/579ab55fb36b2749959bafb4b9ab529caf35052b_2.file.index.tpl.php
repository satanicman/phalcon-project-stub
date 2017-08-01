<?php
/* Smarty version 3.1.30, created on 2017-06-28 14:52:29
  from "/media/Work/public_html/phalcon.loc/apps/backend/views/index/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5953987d53a813_38590735',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '579ab55fb36b2749959bafb4b9ab529caf35052b' => 
    array (
      0 => '/media/Work/public_html/phalcon.loc/apps/backend/views/index/index.tpl',
      1 => 1498650748,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:../layouts/layout.tpl' => 1,
  ),
),false)) {
function content_5953987d53a813_38590735 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1229260315953987d53a067_79997085', "content");
$_smarty_tpl->inheritance->endChild();
$_smarty_tpl->_subTemplateRender("file:../layouts/layout.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 2, false);
}
/* {block "content"} */
class Block_1229260315953987d53a067_79997085 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <div class="login-box">
        <div class="login-logo">
            <b>Admin</b>Panel
        </div><!-- /.login-logo -->
        <div class="login-box-body">
            <form action="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['baseUrl']->value, ENT_QUOTES, 'UTF-8');?>
" method="post">
                <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['flash']->value->output(), ENT_QUOTES, 'UTF-8');?>

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
<?php
}
}
/* {/block "content"} */
}
