<?php if (isset($fuels) && $fuels) { ?>
    <div class="fuel-country-prices">
        <ul class="nav nav-tabs fuel-country-prices__tabs">
            <?php foreach ($fuels as $name => $fuel) { ?>
                <li><a data-toggle="tab" href="#fuel_tabs_<?= $fuel['id'] ?>"><?= $name ?></a></li>
            <?php } ?>
        </ul>
        <div class="tab-content  fuel-country-prices__tabs-content">
            <?php foreach ($fuels as $name => $fuel) { ?>
                <?php if (isset($fuel['azses']) && $this->length($fuel['azses'])) { ?>
                    <div id="fuel_tabs_<?= $fuel['id'] ?>" class="tab-pane fade fuel">
                        <div class="fuel__list">
                            <ul class="fuel-list">
                                <?php foreach ($fuel['azses'] as $azs) { ?>
                                    <li class="fuel-list__item">
                                        <p class="fuel-item">
                                            <span class="fuel-item__name"><span class="fuel-name"><?= $azs['name'] ?></span></span><span class="fuel-item__price"><span class="fuel-price"><?= $azs['price'] ?></span> <span class="fuel-currency">Грн.</span></span>
                                        </p>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </div> <!-- fuel-country-prices -->
<?php } else { ?>
    <p class="page-text">Нет результатов...</p>
<?php } ?>