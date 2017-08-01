<?php
/* Smarty version 3.1.30, created on 2017-06-28 18:59:40
  from "/media/Work/public_html/phalcon.loc/apps/backend/views/layouts/layout.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5953d26c0e4727_42949413',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '7efd952528bfdc389e840af2bf79302a5b63b857' => 
    array (
      0 => '/media/Work/public_html/phalcon.loc/apps/backend/views/layouts/layout.tpl',
      1 => 1498665578,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5953d26c0e4727_42949413 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['title']->value, ENT_QUOTES, 'UTF-8');?>
</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <?php if (isset($_smarty_tpl->tpl_vars['css_files']->value)) {?>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['css_files']->value, 'media', false, 'css_uri');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['css_uri']->value => $_smarty_tpl->tpl_vars['media']->value) {
?>
            <?php if ($_smarty_tpl->tpl_vars['css_uri']->value == 'lteIE9') {?>
                <!--[if lte IE 9]>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['css_files']->value[$_smarty_tpl->tpl_vars['css_uri']->value], 'mediaie9', false, 'css_uriie9');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['css_uriie9']->value => $_smarty_tpl->tpl_vars['mediaie9']->value) {
?>
                <link rel="stylesheet" href="<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['css_uriie9']->value, ENT_QUOTES, 'UTF-8', true), ENT_QUOTES, 'UTF-8');?>
" type="text/css" media="<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['mediaie9']->value, ENT_QUOTES, 'UTF-8', true), ENT_QUOTES, 'UTF-8');?>
" />
                <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                <![endif]-->
            <?php } else { ?>
                <link rel="stylesheet" href="<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['css_uri']->value, ENT_QUOTES, 'UTF-8', true), ENT_QUOTES, 'UTF-8');?>
" type="text/css" media="<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['media']->value, ENT_QUOTES, 'UTF-8', true), ENT_QUOTES, 'UTF-8');?>
" />
            <?php }?>
        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

    <?php }?>
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_12448038195953d26c0dcea1_70531134', "links");
?>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <?php echo '<script'; ?>
 src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"><?php echo '</script'; ?>
>
    <![endif]-->
</head>
<body class="<?php if ($_smarty_tpl->tpl_vars['page_name']->value) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['page_name']->value, ENT_QUOTES, 'UTF-8');
}?>">
<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_9976892125953d26c0dedc5_17353669', "content");
?>


<?php if (isset($_smarty_tpl->tpl_vars['js_files']->value) && isset($_smarty_tpl->tpl_vars['js_def']->value)) {?>
    <?php echo '<script'; ?>
 type="text/javascript">
    <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['js_def']->value, ENT_QUOTES, 'UTF-8');?>

    <?php echo '</script'; ?>
>
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['js_files']->value, 'js_uri');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['js_uri']->value) {
?>
        <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo htmlspecialchars(htmlspecialchars($_smarty_tpl->tpl_vars['js_uri']->value, ENT_QUOTES, 'UTF-8', true), ENT_QUOTES, 'UTF-8');?>
"><?php echo '</script'; ?>
>
    <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

<?php }
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_5806073555953d26c0e39e1_45472435', "scripts");
?>

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
/* {block "links"} */
class Block_12448038195953d26c0dcea1_70531134 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block "links"} */
/* {block "content"} */
class Block_9976892125953d26c0dedc5_17353669 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<?php
}
}
/* {/block "content"} */
/* {block "scripts"} */
class Block_5806073555953d26c0e39e1_45472435 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<?php
}
}
/* {/block "scripts"} */
}
