<?php
include('config.php');
$db_table = "users";

// Подключение к базе данных
$link = mysqli_connect($db_host, $db_user, $db_password, $db_base);
if (!$link) {
    echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
    echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
//echo "Соединение с MySQL установлено!" . PHP_EOL;

// Введенный логин
$user_login_php = $_GET['login'];

// Введенный пароль
$user_password_php = $_GET['userPassword'];

// Введенный пароль
$modeUserQuery_php = $_GET['modeUserQuery'];
//echo $modeUserQuery_php;


// ------------------ Вспомогательные функции --------------------------------

// ------------------ Добавление новых элементов в строку favorites в БД, если -----------------------------
// ---------- общее количество заданий там изменилось после последнего входа пользователя ------------------
function AddFavorites($link,$db_table,$user_login_php) {
			$result_count = mysqli_query($link,"SELECT COUNT(id) FROM mission_hard"); 										// Узнаем количество записей в таблице
			$row_count = mysqli_fetch_array($result_count);
			$total_count = $row_count[0];                                             										// $total_count - число искомых записей
			$login_favorites = mysqli_query($link,"SELECT favorites FROM ".$db_table." WHERE login='".$user_login_php."'"); // Берем значение поля favorites
			$login_favorites_mas = mysqli_fetch_array($login_favorites);
			$login_favorites_string = $login_favorites_mas[0];                                                              // Строка со значением поля favorites
			$add_favorites_length = $total_count - strlen($login_favorites_string);   										// Вычисляем разность между количеством заданий в БД и длиной строки favorites
			for ($i = 0; $i < $add_favorites_length; $i++)
			{
				$login_favorites_string = $login_favorites_string."0";				  										// Добавляем столько нулей, сколько новых заданий появилось
			}
			$result_update_favorites = mysqli_query($link,"UPDATE ".$db_table." SET favorites='".$login_favorites_string."' WHERE login='".$user_login_php."'"); // Записываем получившуюся строку в БД
}



// -------------------------- Авторизация существующего пользователя -------------------------

if ($modeUserQuery_php == "authorization") {
	// Поиск введенного логина в БД
	$result = mysqli_query($link,"SELECT id,login,password FROM ".$db_table." WHERE login='".$user_login_php."'");
	if ($result == true){
		//echo "Запрос успешен";
	}else {
		echo $result;
		echo "Запрос не выполнен!";
	}

	// Проверка логина и пароля
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	if ($row) {                                       // Если пользователь существует
		if ($user_password_php == $row['password']) { // Проверяем пароль
			AddFavorites($link,$db_table,$user_login_php);
			echo "1";                                 // Передаем единицу в случае успешного входа
		}
		else {
			echo "Неверный пароль";					  // Или комментарий об ошибке в случае неверного ввода пароля
		}
	}
	else {
		echo "Пользователь с такой почтой не зарегистрирован!";  // Если пользователь не найден в базе
	}
}

// -------------------------- Регистрация нового пользователя --------------------------------------

if ($modeUserQuery_php == "registration") {
	// Поиск введенного логина в БД
	$result = mysqli_query($link,"SELECT login FROM ".$db_table." WHERE login='".$user_login_php."'");
	if ($result == true){
		//echo "Запрос успешен";
	}else {
		echo $result;
		echo "Запрос не выполнен!";
	}

	// Проверка, существует ли уже такой логин
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	if (!$row) {                                       // Если пользователь не существует, создаем новую запись в БД
		$result = mysqli_query($link,"INSERT INTO ".$db_table." (`id`,`login`,`password`,`status`,`favorites`,`done`) VALUES (NULL,'".$user_login_php."','".$user_password_php."','user','','')");
		if ($result == true){
			AddFavorites($link,$db_table,$user_login_php);
			echo "1";                                  // Передаем единицу в случае успешной регистрации
	}else {
		echo $result;
		echo "Запрос не выполнен! Ошибка обращения к базе данных(";
	}
	}
	else {
		echo "Пользователь с такой почтой уже зарегистрирован!";  // Если введенная почта найдена в базе
	}
}



?>