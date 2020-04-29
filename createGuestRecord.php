<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)    die();

use GuestBook\General;

global $USER;

?>
<!doctype html>
<html lang="ru">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?$APPLICATION->ShowTitle();?></title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
</head>
<body> 
<section id="guestbook">
    <div class="container">
        <h1>Гостевая книга</h1>
        <form action="#" @submit="submitForm">
            <div class="form-group">
                <input type="text" class="form-control" name="NAME" ref="nameField" v-model="name" <?=($USER->IsAuthorized()) ? 'value="'.$USER->GetFullName().'" readonly' : ''?> required placeholder="Введите ваше имя">
            </div>
            <div class="form-group">
                <textarea class="form-control" name="COMMENT" v-model="comment" required placeholder="Введите ваш комментарий" rows="10"></textarea>
            </div>
            <?if($USER->IsAuthorized()):?>
                <div class="form-group">
                    <input type="file" class="form-control" name="FILE" ref="file">
                </div>
            <?endif;?>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>
    <div class="container">
        <h2>Комментарии</h2>
        <div class="records">
                <records-item
                    v-for="record in records"
                    v-bind:record="record"
                    v-bind:key="record.ID"
                ></records-item>
            </div>
        </div>
    </div>
</section>
<script src="script.js"></script>
</body>
</html>
