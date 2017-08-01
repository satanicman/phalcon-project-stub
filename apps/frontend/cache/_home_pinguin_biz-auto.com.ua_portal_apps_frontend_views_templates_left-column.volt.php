<div class="column-left col-sm-2">
    <?php if (isset($subcategories) && $subcategories) { ?>
        <div class="block">
            <div class="block__title">Категории</div>
            <div class="blockleftmenu block__content">
                <ul class="menu">
                    <?= Modules\Models\Tools::makeMenu($subcategories, $selected) ?>
                </ul>
            </div>
        </div>
    <?php } ?>
    <div class="b-left b_6 bnr" data-params='{"id_banner" : 0, "id_position": 6, "id_category": <?php if (isset($category)) { ?><?= $category->id_category ?><?php } else { ?>0<?php } ?>, "google":<?php if (isset($banners[6])) { ?>1<?php } else { ?>0<?php } ?>}'>
        
    </div>
</div>