<?php if (isset($rubrics) && $rubrics) { ?>
    <?php $this->partial('templates/pages/blog', ['rubrics' => $rubrics]); ?>
<?php } elseif (isset($pages) && $pages) { ?>
    <?php if ($this->length($pages) > 1) { ?>
        <?php $this->partial('templates/news', ['pages' => $pages]); ?>
    <?php } else { ?>
        <?php $this->partial('templates/pages/singl', ['page' => $pages[0]]); ?>
    <?php } ?>
<?php } else { ?>
    <div class="page-header">
        <h1 class="page-header--title title title--main"><?= $category->name ?></h1>
    </div>
    <div class="page-text">
        <?= $category->description ?>
    </div>
<?php } ?>