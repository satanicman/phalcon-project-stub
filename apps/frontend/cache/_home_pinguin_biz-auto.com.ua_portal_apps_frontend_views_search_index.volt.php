<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    
    <title>Поиск</title>
    <meta name="description" content="Поиск <?= $search_query ?>">
    

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
        <div class="row">
            <?php if (isset($category)) { ?>
                <?php $c_id = $category->id_category; ?>
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
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
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
                        
                        
                    </div>
                    <div class="clearfix column-wrap row">
                        <?php $left = 2; ?>
                        <?php $right = 3; ?>
                        <?php $center = 12; ?>
                        
    <?php $left = 0; ?>
    <?php $right = 0; ?>

                        <?php if ($left && $right) { ?><?php $center = $center - ($left + $right); ?><?php } elseif ($left) { ?><?php $center = $center - $left; ?><?php } elseif ($right) { ?><?php $center = $center - $right; ?><?php } ?>
                        
                        
                        <div class="column-center col-sm-<?= $center ?>">
                            
    <?php if (isset($pages) && $pages) { ?>
        <ul class="news-list">
    <?php foreach ($pages as $page) { ?>
    <li class="news-item news-item_news clearfix">
        <div class="news-img col-md-4"><a href="<?= $link->getPageLink($page['id_page']) ?>"><img src="<?= $link->getPageImage($page, 'blog') ?>" alt="<?= $page['name'] ?>" title="<?= $page['name'] ?>" class="img-responsive"></a></div>
        <div class="news-text col-md-8">
            <div class="page-header news-text--header clearfix">
                <h3 class="page-header--title news-text--title"><a href="<?= $link->getPageLink($page['id_page']) ?>"><?= $page['name'] ?></a></h3>
                <div class="page-header--info">
                    <?php if ($page['edit_date']) { ?>
                        <?php $page_date = $page['edit_date']; ?>
                    <?php } else { ?>
                        <?php $page_date = $page['create_date']; ?>
                    <?php } ?>
                            <span class="page-header--info-date page-header--info-content"><i
                                        class="icon clock-icon"></i><span
                                        class="page-header--info-value"><?= Modules\Models\Tools::getDate($page_date) ?></span></span>
                    <span class="page-header--info-chat page-header--info-content"><i class="icon chat-icon"></i><span
                                class="page-header--info-value"><?= $page['totalComments'] ?></span></span>
                    
                                
                    </span>
                </div>
            </div>
            <p class="news-text--content"><?= Modules\Models\Tools::truncate(strip_tags($page['description']), 96, '') ?> <a href="<?= $link->getPageLink($page['id_page']) ?>" class="more-link">(Подробнее...)</a></p>
        </div>
    </li>
    <?php } ?>
</ul>
    <?php } else { ?>
        <?= $this->flash->output() ?>
    <?php } ?>

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