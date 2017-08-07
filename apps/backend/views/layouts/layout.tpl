<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{$title}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    {if isset($css_files)}
        {foreach from=$css_files key=css_uri item=media}
            {if $css_uri == 'lteIE9'}
                <!--[if lte IE 9]>
                {foreach from=$css_files[$css_uri] key=css_uriie9 item=mediaie9}
                <link rel="stylesheet" href="{$css_uriie9|escape:'html':'UTF-8'}" type="text/css" media="{$mediaie9|escape:'html':'UTF-8'}" />
                {/foreach}
                <![endif]-->
            {else}
                <link rel="stylesheet" href="{$css_uri|escape:'html':'UTF-8'}" type="text/css" media="{$media|escape:'html':'UTF-8'}" />
            {/if}
        {/foreach}
    {/if}
    {block name="links"}{/block}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="skin-blue{if $class_name} {$class_name}{/if}">
{block name="content"}

{/block}
{if isset($js_def) && is_array($js_def) && $js_def|@count}
    <script type="text/javascript">
        {foreach from=$js_def key=k item=def}
        {if !empty($k) && is_string($k)}
        {if is_bool($def)}
        var {$k} = {$def|var_export:true};
        {elseif is_int($def)}
        var {$k} = {$def|intval};
        {elseif is_float($def)}
        var {$k} = {$def|floatval|replace:',':'.'};
        {elseif is_string($def)}
        var {$k} = '{$def|strval}';
        {elseif is_array($def) || is_object($def)}
        var {$k} = {$def|json_encode};
        {elseif is_null($def)}
        var {$k} = null;
        {else}
        var {$k} = '{$def|@addcslashes:'\''}';
        {/if}
        {/if}
        {/foreach}
    </script>
{/if}
{if isset($js_files)}
    {foreach from=$js_files item=js_uri}
        <script type="text/javascript" src="{$js_uri|escape:'html':'UTF-8'}"></script>
    {/foreach}
{/if}
{block name="scripts"}

{/block}
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>