<div class="page-header">
    <h1 class="page-header--title title title--main"><?= $category->name ?></h1>
</div>
<div class="tab-content">
    <?php foreach ($rubrics as $rubric) { ?>
        <div id="rubric_tab_<?= $rubric['id_rubric'] ?>_<?= $category->id_category ?>" class="tab-pane fade">
            <?php if (isset($rubric['pages']) && $rubric['pages']) { ?>
                <?php $this->partial('templates/news', ['pages' => $rubric['pages']]); ?>
            <?php } elseif ($rubric['description']) { ?>
                <div class="page-text">
                    <?= $rubric['description'] ?>
                </div>
            <?php } ?>
        </div>
    <?php } ?>
    <div id="overlay"></div>
</div>