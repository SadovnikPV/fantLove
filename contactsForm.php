<?php
include('config.php');
$db_table = "messagesfromusers";

// Подключение к базе данных
$link = mysqli_connect($db_host, $db_user, $db_password, $db_base);
if (!$link) {
    echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
    echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
//echo "Соединение с MySQL установлено!" . PHP_EOL;

// Введенный email
$email = $_GET['email'];

// Введенный текст сообщения
$text = $_GET['text'];

// Добавление сообщения в базу данных
$result = mysqli_query($link,"INSERT INTO ".$db_table." (`id_messages`,`email_user`,`message_user`,`response`,`notes`) VALUES (NULL,'".$email."','".$text."','0','0')");
	if ($result == true){
		echo "Спасибо! Ваше сообщение отправлено. Мы скоро ответим вам!";
	}else {
		echo $result;
		echo "К сожалению, ваше сообщение не удалось отправить. Попробуйте еще раз или напишите нам по электронной почте";
	}


?>