<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Admin';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    /* Базовый контейнер табов */
    .tabs {
        min-width: 320px;
        max-width: 800px;
        padding: 0px;
        margin: 0 auto;
    }
    /* Стили секций с содержанием */
    .tabs>section {
        display: none;
        padding: 15px;
        background: #fff;
        border: 1px solid #ddd;
    }
    .tabs>section>p {
        margin: 0 0 5px;
        line-height: 1.5;
        color: #383838;
        /* прикрутим анимацию */
        -webkit-animation-duration: 1s;
        animation-duration: 1s;
        -webkit-animation-fill-mode: both;
        animation-fill-mode: both;
        -webkit-animation-name: fadeIn;
        animation-name: fadeIn;
    }
    /* Описываем анимацию свойства opacity */

    @-webkit-keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }
    /* Прячем чекбоксы */
    .tabs>input {
        display: none;
        position: absolute;
    }
    /* Стили переключателей вкладок (табов) */
    .tabs>label {
        display: inline-block;
        margin: 0 0 -1px;
        padding: 15px 25px;
        font-weight: 600;
        text-align: center;
        color: #aaa;
        border: 0px solid #ddd;
        border-width: 1px 1px 1px 1px;
        background: #f1f1f1;
        border-radius: 3px 3px 0 0;
    }
    /* Шрифт-иконки от Font Awesome в формате Unicode */
    .tabs>label:before {
        font-family: fontawesome;
        font-weight: normal;
        margin-right: 10px;
    }
    .tabs>label[for*="1"]:before {
        content: "\f152";
    }
    .tabs>label[for*="2"]:before {
        content: "\f21d";
    }
    .tabs>label[for*="3"]:before {
        content: "\f013";
    }
    .tabs>label[for*="4"]:before {
        content: "\f13c";
    }
    /* Изменения стиля переключателей вкладок при наведении */

    .tabs>label:hover {
        color: #888;
        cursor: pointer;
    }
    /* Стили для активной вкладки */
    .tabs>input:checked+label {
        color: #555;
        border-top: 1px solid #009933;
        border-bottom: 1px solid #fff;
        background: #fff;
    }
    /* Активация секций с помощью псевдокласса :checked */
    #tab1:checked~#content-tab1, #tab2:checked~#content-tab2, #tab3:checked~#content-tab3, #tab4:checked~#content-tab4 {
        display: block;
    }
    /* Убираем текст с переключателей
    * и оставляем иконки на малых экранах
    */

    @media screen and (max-width: 680px) {
        .tabs>label {
            font-size: 0;
        }
        .tabs>label:before {
            margin: 0;
            font-size: 18px;
        }
    }
    /* Изменяем внутренние отступы
    *  переключателей для малых экранов
    */
    @media screen and (max-width: 400px) {
        .tabs>label {
            padding: 15px;
        }
    }
</style>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="tabs">
        <input id="tab1" type="radio" name="tabs" checked>
        <label for="tab1" title="Вкладка 1">Стримы</label>

        <input id="tab2" type="radio" name="tabs">
        <label for="tab2" title="Вкладка 2">Подписки</label>

        <input id="tab3" type="radio" name="tabs">
        <label for="tab3" title="Вкладка 3">Категории</label>

        <section id="content-tab1">
            <p>
                <?= Html::a('Создать стрим', ['create'], ['class' => 'btn btn-success']) ?> <?= Html::a('Список стримов', ['view_posts'], ['class' => 'btn btn-success']) ?>
            </p>
        </section>
        <section id="content-tab2">
            <p>
                <?= Html::a('Создать подписку', ['create_mail'], ['class' => 'btn btn-success']) ?> <?= Html::a('Список подписчиков', ['view_mails'], ['class' => 'btn btn-success']) ?>
            </p>
        </section>
        <section id="content-tab3">
            <p>
                <?= Html::a('Создать категорию', ['create_category'], ['class' => 'btn btn-success']) ?> <?= Html::a('Список категорий', ['view_category'], ['class' => 'btn btn-success']) ?>
            </p>
        </section>
    </div>

</div>
