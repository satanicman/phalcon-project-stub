<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    
    <title><?php if ($category->meta_title) { ?><?= $category->meta_title ?><?php } else { ?><?= $category->name ?><?php } ?></title>
    <meta name="description" content="<?= $category->meta_description ?>">
    <meta name="keywords" content="<?= $category->meta_keywords ?>">

    <link rel="stylesheet" href="<?= $baseUrl ?>dist/css/global.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>dist/css/modules/blockleftmenu.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>dist/css/modules/searchblock.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>dist/css/tire.css">
    <link rel="stylesheet" href="<?= $baseUrl ?>plugins/datepicker/datepicker3.css">
    
    <?php if (isset($styles) && $this->length($styles)) { ?>
        <?php foreach ($styles as $style) { ?>
            <link rel="stylesheet" href="<?= $baseUrl ?>dist/<?= $style['path'] ?>">
        <?php } ?>
    <?php } ?>

</head>
<body id="news">
<div id="page">
    <div class="container">
        <div class="row content" id="content">
            <?php if (isset($category)) { ?>
                <?php $c_id = $category->id_category; ?>
            <?php } elseif (isset($page)) { ?>
                <?php $c_id = $page['id_category']; ?>
            <?php } else { ?>
                <?php $c_id = 0; ?>
            <?php } ?>
            <div class="header_top">
                <div class="b-header-top b_3 bnr" data-params='{"id_banner" : 0, "id_position": 3, "id_category": <?= $c_id ?>, "google":<?php if (isset($banners[3])) { ?>1<?php } else { ?>0<?php } ?>}'>
                    
                </div>
            </div>
            <div class="b-main-left b-main b_1 bnr" data-params='{"id_banner" : 0, "id_position": 1, "id_category": <?= $c_id ?>, "google":<?php if (isset($banners[1])) { ?>1<?php } else { ?>0<?php } ?>}'>
                
            </div>
            <div class="b-main-right b-main b_2 bnr" data-params='{"id_banner" : 0, "id_position": 2, "id_category": <?= $c_id ?>, "google":<?php if (isset($banners[2])) { ?>1<?php } else { ?>0<?php } ?>}'>
                
            </div>
            <header class="clearfix" id="header">
                <div class="col-md-3 b-header b-header--left">
                    <div class="row b_4 bnr" data-params='{"id_banner" : 0, "id_position": 4, "id_category": <?= $c_id ?>, "google":<?php if (isset($banners[4])) { ?>1<?php } else { ?>0<?php } ?>}'>
                        
                    </div>
                </div>
                <div class="col-md-6 header--center">
                    <div class="row">
                        <div id="header_logo"><a href="/"><img src="/dist/img/logo.png" alt="logo"
                                                               class="img-responsive"></a></div>
                        <div id="search-block" class="search-block">
                            <form action="<?= $url ?>search" class="search-form">
                                <input name="search_query" type="text" class="form-control search-form--input" placeholder="Поиск по сайту"<?php if (isset($search_query) && $search_query) { ?>value="<?= $search_query ?>"<?php } ?>>
                                <button class="search-form--button">
                                    <i class="icon icon-search" aria-hidden="true"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 b-header b-header--right">
                    <div class="row b_5 bnr" data-params='{"id_banner" : 0, "id_position": 5, "id_category": <?= $c_id ?>, "google":<?php if (isset($banners[5])) { ?>1<?php } else { ?>0<?php } ?>}'>
                        
                    </div>
                </div>
            </header>
            
                <nav class="navbar navbar-blue container horisontal_menu">
                    <div class="container-fluid">
                        <div class="navbar-header" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <button type="button" class="navbar-toggle collapsed">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#">Меню</a>
                        </div>

                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <?= Modules\Models\Tools::makeMenu($horizontal_menu_items, $selected) ?>
                            </ul>
                        </div>
                    </div>
                </nav>
            
            
                
                    
                
            
            <div class="content">
                <div class="content--top col-sm-12">
                    <div class="tabs-top">
                        
    <?php if (isset($rubrics) && $rubrics) { ?>
        <ul class="nav nav-tabs">
            <?php foreach ($rubrics as $rubric) { ?>
                <?php if ((isset($rubric['pages']) && $rubric['pages']) || $rubric['description']) { ?>
                    <li><a href="#rubric_tab_<?= $rubric['id_rubric'] ?>_<?= $category->id_category ?>" data-toggle="tab"><?= $rubric['name'] ?></a></li>
                <?php } ?>
            <?php } ?>
        </ul>
    <?php } ?>

                    </div>
                    <div class="clearfix column-wrap row">
                        <?php $left = 2; ?>
                        <?php $right = 3; ?>
                        <?php $center = 12; ?>
                        
    <?php $left = 0; ?>
    <?php if ($this->length($subcategories) > 0) { ?>
        <?php $left = 2; ?>
    <?php } ?>

                        <?php if ($left && $right) { ?><?php $center = $center - ($left + $right); ?><?php } elseif ($left) { ?><?php $center = $center - $left; ?><?php } elseif ($right) { ?><?php $center = $center - $right; ?><?php } ?>
                        
    <?php if ($this->length($subcategories) > 0) { ?>
        <?php $this->partial('templates/left-column', ['subcategories' => $subcategories]); ?>
    <?php } ?>

                        <div class="column-center col-sm-<?= $center ?>">
                            
    <?php $this->partial('templates/pages/' . $category->tpl); ?>

                        </div>
                        <div class="column-right col-sm-<?= $right ?>">
                        <?php if ($right) { ?>
                            <div class="b-right b_7 bnr" data-params='{"id_banner" : 0, "id_position": 7, "id_category": <?= $c_id ?>, "google":<?php if (isset($banners[7])) { ?>1<?php } else { ?>0<?php } ?>}'>
                                
                            </div>
                            <div class="b-right b_8 bnr" data-params='{"id_banner" : 0, "id_position": 8, "id_category": <?= $c_id ?>, "google":<?php if (isset($banners[8])) { ?>1<?php } else { ?>0<?php } ?>}'>
                                
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                    <div class="b-bottom clearfix b_9 bnr" data-params='{"id_banner" : 0, "id_position": 9, "id_category": <?= $c_id ?>, "google":<?php if (isset($banners[9])) { ?>1<?php } else { ?>0<?php } ?>}'>
                        
                    </div>
                    <?php if (isset($pages_nb) && $pages_nb) { ?>
                        <?php if (isset($p) && $p && $start != $stop) { ?>
    <?php $no_follow_text = ' rel="nofollow"'; ?>
    <nav aria-label="Page navigation" class="pagination-wrap">
        <ul class="pagination">
            <?php if ($p != 1) { ?>
                <li class="page-item page-arrow">
                    <a<?= $no_follow_text ?> href="<?= $link->goPage($requestPage, $p - 1) ?>" class="page-link" aria-label="Previous">
                        <i class="icon chevron-blue-left-icon"></i>
                    </a>
                </li>
            <?php } else { ?>
                <li class="disabled page-item page-arrow">
                  <span class="page-link">
                      <i class="icon chevron-blue-left-icon"></i>
                  </span>
                </li>
            <?php } ?>
            <?php if ($start == 3) { ?>
                <li class="page-item">
                    <a<?= $no_follow_text ?> href="<?= $link->goPage($requestPage, 1) ?>" class="page-link">
                        <span>1</span>
                    </a>
                </li>
                <li class="page-item">
                    <a<?= $no_follow_text ?> href="<?= $link->goPage($requestPage, 2) ?>" class="page-link">
                        <span>2</span>
                    </a>
                </li>
            <?php } ?>
            <?php if ($start == 2) { ?>
                <li class="page-item">
                    <a<?= $no_follow_text ?> href="<?= $link->goPage($requestPage, 1) ?>" class="page-link">
                        <span>1</span>
                    </a>
                </li>
            <?php } ?>
            <?php if ($start > 3) { ?>
                <li class="page-item">
                    <a<?= $no_follow_text ?> href="<?= $link->goPage($requestPage, 1) ?>" class="page-link">
                        <span>1</span>
                    </a>
                </li>
                <li class="truncate">
                    <span>
                        <span>...</span>
                    </span>
                </li>
            <?php } ?>
            <?php foreach (range($start, $stop) as $i) { ?>
                <li class="page-item<?php if ($p == $i) { ?> active<?php } ?>">
                    <a<?= $no_follow_text ?> href="<?= $link->goPage($requestPage, $i) ?>" class="page-link"><?= $i ?></a>
                </li>
            <?php } ?>
            <?php if ($pages_nb > $stop + 2) { ?>
                <li class="truncate">
                    <span>
                        <span>...</span>
                    </span>
                </li>
                <li class="page-item">
                    <a<?= $no_follow_text ?> href="<?= $link->goPage($requestPage, $pages_nb) ?>" class="page-link">
                        <span><?= $pages_nb ?></span>
                    </a>
                </li>
            <?php } ?>
            <?php if ($pages_nb == $stop + 1) { ?>
                <li class="page-item">
                    <a<?= $no_follow_text ?> href="<?= $link->goPage($requestPage, $pages_nb) ?>" class="page-link">
                        <span><?= $pages_nb ?></span>
                    </a>
                </li>
            <?php } ?>
            <?php if ($pages_nb == $stop + 2) { ?>
                <li class="page-item">
                    <a<?= $no_follow_text ?> href="<?= $link->goPage($requestPage, $pages_nb - 1) ?>" class="page-link">
                        <span><?= $pages_nb - 1 ?></span>
                    </a>
                </li>
                <li class="page-item">
                    <a<?= $no_follow_text ?> href="<?= $link->goPage($requestPage, $pages_nb) ?>" class="page-link">
                        <span><?= $pages_nb ?></span>
                    </a>
                </li>
            <?php } ?>

            <?php if ($pages_nb > 1 && $p != $pages_nb) { ?>
                <li class="page-item page-arrow">
                    <a<?= $no_follow_text ?> href="<?= $link->goPage($requestPage, $p + 1) ?>" aria-label="Next" class="page-link">
                        <i class="icon chevron-blue-right-icon"></i>
                    </a>
                </li>
            <?php } else { ?>
                <li class="page-item disabled page-arrow">
                  <span class="page-link">
                      <i class="icon chevron-blue-right-icon"></i>
                  </span>
                </li>
            <?php } ?>
        </ul>
    </nav>
<?php } ?>
                    <?php } ?>
                </div> <!-- content--top #END -->
                <div class="content--bottom clearfix">
                    
                    
                </div>
            </div> <!-- content #END -->
        </div> <!-- row #END -->
    </div> <!-- container #END -->
    <footer id="footer" class="footer">
        <i class="icon tire-icon footer-icon"></i>
        <div class="footer-container container">
            <div class="clearfix">
                <?= $configuration['footer'] ?>
            </div> <!-- clearfix -->
        </div> <!-- footer-container -->
    </footer>
</div>
<script src="<?= $baseUrl ?>dist/js/global.js"></script>
<script src="<?= $baseUrl ?>dist/js/tire_calc.js"></script>
<script src="<?= $baseUrl ?>plugins/datepicker/bootstrap-datepicker.js"></script>
<script src="<?= $baseUrl ?>plugins/datepicker/locales/bootstrap-datepicker.ru.js"></script>
<script src="<?= $baseUrl ?>dist/js/share42/share42.js"></script>
<script>
    var baseUrl = '<?= $baseUrl ?>';
    var url = '<?= $url ?>';
</script>

    <?php if (isset($scripts) && $this->length($scripts)) { ?>
        <?php foreach ($scripts as $script) { ?>
            <script src="<?= $baseUrl ?>dist/<?= $script['path'] ?>"></script>
        <?php } ?>
    <?php } ?>

</body>
</html>
</body>
</html>