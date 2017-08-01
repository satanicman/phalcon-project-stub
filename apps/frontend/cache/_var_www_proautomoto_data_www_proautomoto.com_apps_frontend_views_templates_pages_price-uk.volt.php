<h1 class="title title--green"><?= $category->name ?></h1>
<div class="fuel-country">
    <div class="fuel-country__header">
        <div class="fuel-country-header">
            <?php if (isset($dates) && $dates) { ?>
            <div class="fuel-country-header__col">
                <div class="fuel-country-col">
                    <label for="datepicker" class="fuel-country-col__title">
                        <span class="fuel-country-title">Дата:</span>
                    </label>
                    <div class="fuel-country-col__select">
                        <input type="text" id="datepicker" class="fuel-country-select fuel-country-select__input">
                        
                            
                                
                            
                        
                    </div>
                </div> <!-- fuel-country-col -->
            </div> <!-- fuel-country-header__col -->
            <?php } ?>
            <?php if (isset($regions) && $regions) { ?>
            <div class="fuel-country-header__col">
                <div class="fuel-country-col">
                    <label for="country_name" class="fuel-country-col__title">
                        <span class="fuel-country-title">Область:</span>
                    </label>
                    <div class="fuel-country-col__select">
                        <select name="country_name" id="country_name" class="fuel-country-select" onchange="changeRegion(this.value)">
                            <?php foreach ($regions as $r) { ?>
                                <option value="<?= $r['id_region'] ?>"<?php if ($r['id_region'] == $id_region) { ?> selected="selected"<?php } ?>><?= $r['name'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>  <!-- fuel-country-col -->
            </div> <!-- fuel-country-header__col -->
            <?php } ?>
        </div> <!-- fuel-country-header -->
    </div> <!-- fuel-country__header -->
    <div class="fuel-country__prices">
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
    </div>
</div>
<?php if ($category->description) { ?>
    <div class="page-text">
        <?= $category->description ?>
    </div>
<?php } ?>
