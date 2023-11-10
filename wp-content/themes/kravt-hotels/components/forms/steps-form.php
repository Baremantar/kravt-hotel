<style>
    .kravt_restaraunts_mask-content.steps-form {
        width: 70%;
        margin: 0 auto;
    }

    .kravt_restaraunts_mask-content.steps-form .kravt_restaraunts__controls {
        display: flex;
        justify-content: center;
        margin-top: 40px;
    }

    .kravt_restaraunts_mask-content.steps-form [id*='step'] .kravt_restaraunts_mask-input-box {
        margin-top: 24px;
        height: 48px;
    }

    .kravt_restaraunts_mask-content.steps-form [id*='step'] .kravt_restaraunts_mask-input-box label {
        font-size: 20px;
        line-height: 22px;
    }

    .kravt_restaraunts_mask-content.steps-form [id*='step'] .kravt_restaraunts_mask-input-box input {
        font-size: 24px;
        line-height: 32px;
    }

    .kravt_restaraunts_mask-content.steps-form button {
        width: 200px;
    }

    .kravt_restaraunts__info {
        margin-top: 24px;
        color: rgba(10 10 10 / .6);
        display: inline-block;
        padding: 0 32px;
    }

    .title-center {
        text-align: center;
    }
</style>

<section class="container container-spacing">
    <h2 class="title-center">Оформить сертификат</h2>
    <form class="kravt_restaraunts_mask-content bigger steps-form" enctype="multipart/form-data" method="post">
        <div id="step1">
            <div class="kravt_restaraunts_mask-input-box">
                <label>Фамилия</label>
                <input name="lastName" placeholder="Укажите фамилию" type="text" required="">
            </div>
            <div class="kravt_restaraunts_mask-input-box">
                <label>Имя</label>
                <input name="firstName" placeholder="Укажите имя" type="text" required="">
            </div>
            <div class="kravt_restaraunts_mask-input-box">
                <label>Отчество</label>
                <input name="patronymic" placeholder="Укажите отчество" type="text" required="">
            </div>
            <div class="kravt_restaraunts_mask-input-box">
                <label>Электронная почта</label>
                <input name="email" placeholder="mail@gmail.com" type="email" required="">
            </div>
            <div class="kravt_restaraunts_mask-input-box">
                <label>Телефон</label>
                <input name="tel" placeholder="+7 (999) 999-99-99" type="tel" required="">
            </div>
            <div class="kravt_restaraunts__controls">
                <button type="button" id="nextStep1">Далее</button>
            </div>
        </div>

        <div id="step2" style="display: none;">
            <div class="kravt_restaraunts_mask-input-box select">
                <label>Выберите тип</label>
                <select name="department" required="">
                    <option value="Электронный">Электронный</option>
                    <option value="Бумажный">Бумажный</option>
                </select>
            </div>
            <div class="kravt_restaraunts__info">
                <small>Обращаем внимание, что с помощью данной формы Вы можете оставить заявку на оформление сертификата, но получить бумажный возможно только в KRAVT SPA, а электронный - на e-mail.</small>
            </div>
            <div class="kravt_restaraunts_mask-input-box">
                <label>Сумма</label>
                <input name="summ" type="number" required="">
            </div>
            <div class="kravt_restaraunts_mask-input-box select">
                <label>Процедура</label>
                <select name="department" required="">
                    <option value="SPA-уход Арома | 60 мин | 4 000 ₽">SPA-уход Арома | 60 мин | 4 000 ₽</option>
                    <option value="SPA-уход Арома | 90 мин | 4 800 ₽">SPA-уход Арома | 90 мин | 4 800 ₽</option>
                    <option value="Программа «Скульптор тела» | 100 мин | 7 500 ₽">Программа «Скульптор тела» | 100 мин | 7 500 ₽</option>
                    <option value="SPA-уход Интенсив | 30 мин | 3 200 ₽">SPA-уход Интенсив | 30 мин | 3 200 ₽</option>
                    <option value="SPA-уход Совершенство | 90 мин | 5 500 ₽">SPA-уход Совершенство | 90 мин | 5 500 ₽</option>
                    <option value="Программа для лица Свежесть | 90 мин | 5800 ₽">Программа для лица Свежесть | 90 мин | 5800 ₽</option>
                    <option value="Уход для тела Шоколадное трио| 100 мин | 6500 ₽">Уход для тела Шоколадное трио| 100 мин | 6500 ₽</option>
                    <option value="Скраб для тела | 30 мин | 3 500 ₽">Скраб для тела | 30 мин | 3 500 ₽</option>
                    <option value="Уход Марципановый рай | 90 мин | 5800 ₽">Уход Марципановый рай | 90 мин | 5800 ₽</option>
                    <option value="Программа Детокс | 90 мин | 6500 ₽">Программа Детокс | 90 мин | 6500 ₽</option>
                    <option value="SPA-церемония Пенная рапсодия | 60 мин | 4 500 ₽">SPA-церемония Пенная рапсодия | 60 мин | 4 500 ₽</option>
                    <option value="Уход для лица Секрет молодости | 60 мин | 4 500 ₽">Уход для лица Секрет молодости | 60 мин | 4 500 ₽</option>
                    <option value="Расслабляющий массаж лица | 30 мин | 3 300 ₽">Расслабляющий массаж лица | 30 мин | 3 300 ₽</option>
                    <option value="Расслабляющий уход для кожи головы и волос | 30 мин | 3 300 ₽">Расслабляющий уход для кожи головы и волос | 30 мин | 3 300 ₽</option>
                    <option value="Расслабляющий массаж ног | 30 мин | 3 000 ₽">Расслабляющий массаж ног | 30 мин | 3 000 ₽</option>
                    <option value="Маска для лица | 30 мин | 2 100 ₽">Маска для лица | 30 мин | 2 100 ₽</option>
                    <option value="SPA-пакет Детокс | 3 часа | 7 500 ₽">SPA-пакет Детокс | 3 часа | 7 500 ₽</option>
                    <option value="SPA-пакет Обновление | 3 часа | 7 500 ₽">SPA-пакет Обновление | 3 часа | 7 500 ₽</option>
                    <option value="SPA-пакет Пенное облако | 7 500 ₽">SPA-пакет Пенное облако | 7 500 ₽</option>
                    <option value="SPA-пакет Шоколадное трио | 3 часа | 7 500 ₽">SPA-пакет Шоколадное трио | 3 часа | 7 500 ₽</option>
                    <option value="SPA-пакет Марципановый рай | 2 часа 40 мин | 6500 ₽">SPA-пакет Марципановый рай | 2 часа 40 мин | 6500 ₽</option>
                </select>
            </div>
            <div class="kravt_restaraunts_mask-input-box">
                <input name="comment" placeholder="Комментарий" type="text">
            </div>
            <div class="kravt_restaraunts__controls">
                <button type="button" id="prevStep2">Назад</button>
                <button type="submit" id="restaraunts-submit">Отправить</button>
            </div>
        </div>
    </form>

    <script>
        const step1 = document.getElementById("step1");
        const step2 = document.getElementById("step2");
        const nextStep1Button = document.getElementById("nextStep1");
        const prevStep2Button = document.getElementById("prevStep2");

        nextStep1Button.addEventListener("click", () => {
            step1.style.display = "none";
            step2.style.display = "block";
        });

        prevStep2Button.addEventListener("click", () => {
            step2.style.display = "none";
            step1.style.display = "block";
        });
    </script>
</section>