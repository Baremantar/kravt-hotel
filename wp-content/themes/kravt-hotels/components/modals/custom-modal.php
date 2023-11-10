<?php 
$title = '';
$modal_type = '';
switch (explode('/', $_SERVER['REQUEST_URI'])[1]) {
    case 'offers':
        $title = 'Забронировать предложение';
        $modal_type = 'offers';
    break;
    case 'services':
        $title = 'Забронировать';
        $modal_type = 'services';
        break;
    case 'events':
        $title = 'Забронировать событие';
        $modal_type = 'events';
        break;
    default:
        $title = 'Забронировать стол';
        $modal_type = 'restaurant';
        break;
}
?>

<div class="kravt_restaraunts_mask" id="mask_container">
    <form class="kravt_restaraunts_mask-content" id="mask_content" data-typeModal='<?= $modal_type ?>' data-hotel='<?= get_bloginfo('name') ?>' data-title = "<?= the_title() ?>">
        <p><?= $title ?></p>
        <div class="kravt_restaraunts_mask-input-box">
            <label>Ваше имя</label>
            <input name="firstName" id="restaraunts-name" placeholder="Укажите ваше имя" type="text" required />
        </div>
        <div class="kravt_restaraunts_mask-input-box">
            <label>Ваш телефон</label>
            <input name="tel" id="restaraunts-number" placeholder="8 (999) 999-99-99" type="tel" required />
        </div>
        <div class="kravt_restaraunts_mask-input-box _input-box-date">
            <div>
                <label>Время и дата визита</label>
                <input name="date" id="datepicker_restaraunts" placeholder="Выберите дату и время" readonly type="text" required />
            </div>
        </div>
        <div class="kravt_restaraunts_mask-input-box">
            <input name="comment" placeholder="Ваш комментарий" id="restaraunts-comment" type="text" />
        </div>
        <button id="restaraunts-submit">Отправить</button>
    </form>
    <div class="kravt-submit">
        <h3>Благодарим Вас за запрос!</h3>
        <p>Специалист выбранного подразделения свяжется с Вами в ближайшее время</p>
        <button type="button">Закрыть окно</button>
    </div>
</div>