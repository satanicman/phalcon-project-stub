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