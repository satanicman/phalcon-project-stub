<?php
/* Smarty version 3.1.30, created on 2017-06-27 22:44:37
  from "/media/Work/public_html/phalcon.loc/apps/backend/views/layouts/footer.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5952b5a5d748f7_27451857',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fbc51d9741d7a72a5f1aead5922c5fea06f08dec' => 
    array (
      0 => '/media/Work/public_html/phalcon.loc/apps/backend/views/layouts/footer.tpl',
      1 => 1498592406,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5952b5a5d748f7_27451857 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!-- jQuery 2.1.3 -->
<?php echo '<script'; ?>
 src="/libs/jQuery/jQuery-2.1.3.min.js"><?php echo '</script'; ?>
>
<!-- Bootstrap 3.3.2 JS -->
<?php echo '<script'; ?>
 src="/libs/bootstrap/js/bootstrap.min.js" type="text/javascript"><?php echo '</script'; ?>
>
<!-- iCheck -->
<?php echo '<script'; ?>
 src="/libs/iCheck/icheck.min.js" type="text/javascript"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
<?php echo '</script'; ?>
>
</body>
</html><?php }
}
