<?php foreach ($comments as $comment) { ?>
    <li class="comments-item">
        <div class="comments-icon"><i class="user-icon icon"></i></div>
        <div class="comments-text">
            <div class="comments-text--title"><span class="comments-text--name"><?= $comment['name'] ?></span><span class="comments-text--time"><?= Modules\Models\Tools::getDate($comment['date_add']) ?></span></div>
            <p class="comments-text--comment"><?= $comment['description'] ?></p>
        </div>
        <?php if (isset($comment['children']) && $comment['children']) { ?>
            <ul class="comments-children">
                <?php $this->partial('templates/comments/item', ['comments' => $comment['children']]); ?>
            </ul>
        <?php } ?>
    </li>
<?php } ?>