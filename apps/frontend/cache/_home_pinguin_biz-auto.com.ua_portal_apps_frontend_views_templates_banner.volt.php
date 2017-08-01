<?php if (isset($banners) && isset($banners[$position])) { ?>
    <?php if ($banners[$position]['link']) { ?>
        <a href="<?= $banners[$position]['link'] ?>" title="<?= $banners[$position]['name'] ?>">
    <?php } ?>
    <?= $banners[$position]['description'] ?>
    <?php if ($banners[$position]['link']) { ?>
        </a>
    <?php } ?>
<?php } ?>