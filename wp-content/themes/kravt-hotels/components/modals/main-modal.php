<div class="kravt_restaraunts_mask full" id="mask_container">
    <form class="kravt_restaraunts_mask-content bigger" id="mask_content" enctype="multipart/form-data" method="post">
        <p>Отправить запрос</p>
        <div class="kravt_restaraunts_mask-input-box select">
            <label>Выберите подразделение</label>
            <select name="department" required>
                <option value="<?= $GLOBALS['cgv']['base_department']?>" selected hidden>Выберите подразделение</option>
                <option value="<?= $GLOBALS['cgv']['booking_department']?>">Отдел бронирования</option>
                <option value="<?= $GLOBALS['cgv']['sales_department']?>">Отдел продаж</option>
                <option value="<?= $GLOBALS['cgv']['hr_department']?>">HR-отдел</option>
                <option value="<?= $GLOBALS['cgv']['legal_department']?>">Юридический отдел</option>
                <option value="<?= $GLOBALS['cgv']['pr_department']?>">PR-отдел</option>
                <option value="<?= $GLOBALS['cgv']['marketing_department']?>">Маркетинговый отдел</option>
                <option value="<?= $GLOBALS['cgv']['it_department']?>">IT отдел</option>
                <option value="<?= $GLOBALS['cgv']['purchase_department_spb']?>">Отдел закупок Санкт-Петербург</option>
                <option value="<?= $GLOBALS['cgv']['purchase_department_kzn']?>">Отдел закупок Казань</option>
            </select>
        </div>
        <div class="kravt_restaraunts_mask-input-box">
            <label>Ваше имя</label>
            <input name="firstName" placeholder="Укажите ваше имя" type="text" required/>
        </div>
        <div class="kravt_restaraunts_mask-input-box">
            <label>Ваша фамилия</label>
            <input name="lastName" placeholder="Укажите вашу фамилию" type="text" required/>
        </div>
        <div class="kravt_restaraunts_mask-input-box">
            <label>Ваш телефон</label>
            <input name="tel" placeholder="+7 (999) 999-99-99" type="tel" required/>
        </div>
        <div class="kravt_restaraunts_mask-input-box">
            <label>Электронная почта</label>
            <input name="email" placeholder="mail@gmail.com" type="email" required/>
        </div>
        <div class="kravt_restaraunts_mask-input-box">
            <input name="comment" placeholder="Ваш комментарий" type="text" />
        </div>
        <div class="kravt_restaraunts_mask-input-box file">
            <label for="file">
                <input type="file" name="file" />
                <span class="input-file-text">Загрузите файл</span>
                <?= file_get_contents(get_template_directory_uri().'/build/img/icons/download.svg') ?>
            </label>
        </div>
        <button type="submit" id="restaraunts-submit">Отправить</button>
    </form>
    <div class="kravt-submit">
        <h3>Благодарим Вас за запрос!</h3>
        <p>Специалист выбранного подразделения свяжется с Вами в ближайшее время</p>
        <button type="button">Закрыть окно</button>
    </div>
</div>