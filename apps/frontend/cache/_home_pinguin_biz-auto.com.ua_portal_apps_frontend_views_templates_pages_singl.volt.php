<div class="page-header">
    <h1 class="page-header--title title title--main"><?= $page['name'] ?></h1>
    <div class="page-header--info">
                            <span class="page-header--info-date page-header--info-content"><i
                                        class="icon clock-icon"></i><span
                                        class="page-header--info-value"><?= $page['create_date'] ?></span></span>
        <span class="page-header--info-chat page-header--info-content"><i class="icon chat-icon"></i><span
                    class="page-header--info-value"><?= $page['totalComments'] ?></span></span>
        
                    
        </span>
    </div>
</div>
<div class="page-text">
    <?= $page['description'] ?>
</div>
<p>Поделиться</p>
<div class="share42init"></div>