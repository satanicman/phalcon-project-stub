<?php
/* Smarty version 3.1.30, created on 2017-06-27 22:44:37
  from "/media/Work/public_html/phalcon.loc/apps/backend/views/layouts/header.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5952b5a5cfd3d4_87158999',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '95c264f7c509c015d9c76619b3a0d31f96ce98bf' => 
    array (
      0 => '/media/Work/public_html/phalcon.loc/apps/backend/views/layouts/header.tpl',
      1 => 1498592357,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5952b5a5cfd3d4_87158999 (Smarty_Internal_Template $_smarty_tpl) {
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
    <!-- Bootstrap 3.3.2 -->
    <link href="/libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome 4.7.0 -->
    <link href="/libs/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="/libs/AdminLTE/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <link href="/libs/AdminLTE/css/skins/skin-blue.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="/libs/iCheck/square/blue.css" rel="stylesheet" type="text/css" />
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_9434322555952b5a5ccc617_10501418', "links");
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
<body class="<?php if ($_smarty_tpl->tpl_vars['class_name']->value) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['class_name']->value, ENT_QUOTES, 'UTF-8');
}?>"><?php }
/* {block "links"} */
class Block_9434322555952b5a5ccc617_10501418 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block "links"} */
}
