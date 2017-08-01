<h1 class="title title--green"><?= $category->name ?></h1>
<div class="calculator clearfix">
    <div class="calculator__col col-xs-5">
        <div class="calculator-col">
            <div class="calculator-col__line">
                <p class="calculator-line-title">Количественные показатали</p>
            </div>
            <div class="calculator-col__line">
                <label class="calculator-line">
                    <div class="calculator-line__title"><span
                                class="calculator-title">Кол-во топлива, л</span></div>
                    <div class="calculator-line__input"><input type="text" name="fuel_col" id="fuel_col"
                                                               class="calculator-input" value="" onchange="calculateL(); calculateC(); calculateG();"></div>
                </label>
            </div>
            <div class="calculator-col__line">
                <label class="calculator-line">
                    <div class="calculator-line__title"><span class="calculator-title">Расход топлива, л</span>
                    </div>
                    <div class="calculator-line__input"><input type="text" name="fuel_cons" id="fuel_cons"
                                                               class="calculator-input" value="" onchange="calculateL(); calculateN();"></div>
                </label>
            </div>
            <div class="calculator-col__line">
                <label class="calculator-line">
                    <div class="calculator-line__title"><span class="calculator-title">Расстояние, км</span>
                    </div>
                    <div class="calculator-line__input"><input type="text" name="fuel_dist" id="fuel_dist"
                                                               class="calculator-input" value="" onchange="calculateN(); calculateG();"></div>
                </label>
            </div>
            <div class="calculator-col__line">
                <label class="calculator-line">
                    <div class="calculator-line__title"><span
                                class="calculator-title">Путь, км на 1 литре</span></div>
                    <span class="calculator-line__input"><input type="text" name="fuel_way" id="fuel_way"
                                                                class="calculator-input" value="" disabled="disabled"></span>
                </label>
            </div>
        </div>
    </div>
    <div class="calculator__col calculator__col_sm col-xs-2">
        <a onclick="calculate($(this))" title="Расчитать" class="play calculator__btn"></a>
        <strong>Расчитать</strong>
    </div>
    <div class="calculator__col col-xs-5">
        <div class="calculator-col">
            <div class="calculator-col__line">
                <p class="calculator-line-title">Финансовые показатели, грн</p>
            </div>
            <div class="calculator-col__line">
                <label class="calculator-line">
                    <div class="calculator-line__title"><span
                                class="calculator-title">Стоимость топлива, грн.</span></div>
                    <div class="calculator-line__input"><input type="text" name="fuel_price" id="fuel_price"
                                                               class="calculator-input" value="" onchange="calculateC(); calculateN()"></div>
                </label>
            </div>
            <div class="calculator-col__line">
                <label class="calculator-line">
                    <div class="calculator-line__title"><span
                                class="calculator-title">Общая стоимость, грн.</span></div>
                    <div class="calculator-line__input"><input type="text" name="fuel_price_total"
                                                               id="fuel_price_total" class="calculator-input" value="" onfocus="checkPrice();" onchange="calculateN();">
                    </div>
                </label>
            </div>
            <div class="calculator-col__line">
                <label class="calculator-line">
                    <div class="calculator-line__title"><span class="calculator-title">Стоимость километра пути, грн/км</span>
                    </div>
                    <div class="calculator-line__input"><input type="text" name="fuel_price_way"
                                                               id="fuel_price_way" class="calculator-input" value="" disabled="disabled"></div>
                </label>
            </div>
            <div class="calculator-col__line">
                <label class="calculator-line">
                    <div class="calculator-line__title"><span class="calculator-title">Путь, км за 1 грн</span>
                    </div>
                    <div class="calculator-line__input"><input type="text" name="fuel_total" id="fuel_total"
                                                               class="calculator-input" value="" disabled="disabled"></div>
                </label>
            </div>
        </div>
    </div>
</div>
