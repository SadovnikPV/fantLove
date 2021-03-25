<!-- Include Database connections info. -->
<?php

include('config.php');

// Подключение к базе данных
$link = mysqli_connect($db_host, $db_user, $db_password, $db_base);
if (!$link) {
    echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
    echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
//echo "Соединение с MySQL установлено!" . PHP_EOL;

$db_table_users = 'users'; // Имя таблицы с пользователями

// Модификатор вывода:
// done - кнопка "выполнено". Установка значения 1 в поле status записи с id равным curId
// skip - кнопка "пропустить". Просто вывод нового задания
// impossible - кнопка "невыполнимо". Установка значения 2 в поле status записи с id равным curId
//echo $_GET['show_mode']; 

// id текущего задания
$cur_id_php = $_GET['cur_id'];

// mode (режим) нажатой кнопки --done/skip/impossible--
$show_mode_php = $_GET['show_mode'];

// Введенный логин
$user_login_php = $_GET['login'];

// Текущие настройки выбранных типов секса
$type_set_all_php = $_GET['typeSetAll'];

// Текущие настройки вывода задания
$show_set_all_php = $_GET['showSetAll'];

// Формирование строки настроек типов секса для создания запроса
$type_set_query_php = "";
if ($type_set_all_php == "001") {
	$type_set_query_php = " AND type='Для компании'";
}
if ($type_set_all_php == "010") {
	$type_set_query_php = " AND type='Для двоих'";
}
if ($type_set_all_php == "011") {
	$type_set_query_php = " AND (type='Для двоих' OR type='Для компании')";
}
if ($type_set_all_php == "100") {
	$type_set_query_php = " AND type='Для одного'";
}
if ($type_set_all_php == "101") {
	$type_set_query_php = " AND (type='Для одного' OR type='Для компании')";
}
if ($type_set_all_php == "110") {
	$type_set_query_php = " AND (type='Для одного' OR type='Для двоих')";
}
if ($type_set_all_php == "111") {
	$type_set_query_php = "";
}

// Формирование строки настроек вывода для создания запроса
$show_set_query_php = "";
if ($show_set_all_php == "010") {
	$show_set_query_php = "0";
}
if ($show_set_all_php == "100") {
	$show_set_query_php = "2";
}
if ($show_set_all_php == "101") {
	$show_set_query_php = "3";
}


/*----------------------------------------------------------------------------*/
/*--- Обработка кнопки skip (кнопка "Следущее" при успешной авторизации) -----*/
/*----------------------------------------------------------------------------*/
	
if (($show_mode_php == "skip") || ($show_mode_php == "undefined")) {
	
	// Создание запроса на выборку из базы данных
	$result = mysqli_query($link,"SELECT id,type,who_does,pose_woman,pose_man,attribute,description,img_mission,status FROM ".$db_table." WHERE status=1".$type_set_query_php);
	if ($result == true){
	//echo "Запрос успешен";
	} else {
		echo $result;
		echo "Запрос не выполнен!";
	}

	//Подсчет количества выбранных записей
	$count_record = 0; // Общее количество записей, удовлетворяющих запросу, инициализация переменной
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$arr[] = $row;
		$count_record++; // Подсчет общего количества записей, удовлетворяющих запросу
	}

	$favorites = 2; // Значение, если пользователь не залогинен
	// Проверяем, не находится ли данное задание в "избранном", если пользователь залогинен
	if ($user_login_php != '') {
		$result_favorites = mysqli_query($link,"SELECT favorites FROM ".$db_table_users." WHERE login='".$user_login_php."'"); // Запрос на получение строки favorites
		$result_favorites_mas = mysqli_fetch_array($result_favorites);
		$result_favorites_string = $result_favorites_mas[0];    // $result_favorites_string - строка из поля favorites
		
		// Формирование конечного массива, удовлетворяющего настройкам, из которого будет выбираться случайное задание
		$final_array_length = 0;
		for ($i = 0; $i < $count_record; $i++) {
			$current_id = $arr[$i]['id'];
			
			if ($show_set_all_php == "001") {
				if ($result_favorites_string[$current_id] == "1" || $result_favorites_string[$current_id] == "3") {
					$final_array[] = $arr[$i];
					$final_array_length++;
				}
			}
			
			if ($show_set_all_php == "011") {
				if ($result_favorites_string[$current_id] == "0" || $result_favorites_string[$current_id] == "1" || $result_favorites_string[$current_id] == "3") {
					$final_array[] = $arr[$i];
					$final_array_length++;
				}
			}
			
			if ($show_set_all_php == "110") {
				if ($result_favorites_string[$current_id] == "0" || $result_favorites_string[$current_id] == "2") {
					$final_array[] = $arr[$i];
					$final_array_length++;
				}
			}
			
			if ($show_set_all_php == "111") {
					$final_array[] = $arr[$i];
					$final_array_length++;
			}
			
			if ($show_set_all_php != "001" && $show_set_all_php != "110" && $show_set_all_php != "111") {
				if ($result_favorites_string[$current_id] == $show_set_query_php) {
					$final_array[] = $arr[$i];
					$final_array_length++;
				}
			}
		}
		
	}
	
	if ($user_login_php == '') {
		$final_array_length = $count_record;
		$final_array = $arr;
	}
	
	//Генерация рандомного числа - номера записи для вывода на экран
	$show_record = rand(0,$final_array_length-1); // Номер записи, которая будет выведена на экран
	
	if ($user_login_php != '') {
		$current_id = $final_array[$show_record]['id'];
		if ($result_favorites_string[$current_id] == '1' || $result_favorites_string[$current_id] == '3') {
			$favorites = 1; // Если задание в избранном
		}
		else {
			$favorites = 0; // Если задание нет в избранном
		}
	}
	
	if ($final_array_length != 0) {
		// Вывод задания на экран
		echo "<b>Тип: </b>";
		echo $final_array[$show_record]['type'];
		echo "<br>";
		if ($final_array[$show_record]['attribute'] != "") {
			echo "<b>Дополнительные условия: </b>";
			echo $final_array[$show_record]['attribute'];
			echo "<br>";
		}
		if ($final_array[$show_record]['description'] != "") {
			echo "<b>Описание задания: </b>";
			echo $final_array[$show_record]['description'];
		}
		if ($final_array[$show_record]['img_mission'] != "") {
			echo "<div class = 'img_mission_div'> 
					<img class = 'image_mission' src = 'img/img_mission/".$final_array[$show_record]['img_mission']."'> 
				 </div>";
		}
		echo "?";
		echo $final_array[$show_record]['id'];
		echo $favorites;
	}
	else {
		echo "<div class = 'center'> По заданным настройкам не получилось подобрать ни одного задания.<br><br>";
		echo "<img src = 'img/BrokenHeart-1.png' width = '100' align = 'center'></div>";
	}
}

/*----------------------------------------------------------------------------*/
/*-----------------------Обработка кнопки done--------------------------------*/
/*----------------------------------------------------------------------------*/

if ($show_mode_php == "done") {
	// Создание запроса на изменение поля favorites
	// Если задание выполнено и не добавлено в избранное, то ставится 2
	// Если задание выполнено и добавлено в избранное, то ставится 3
	$result_favorites = mysqli_query($link,"SELECT favorites FROM ".$db_table_users." WHERE login='".$user_login_php."'"); // Запрос на получение строки favorites
	$result_favorites_mas = mysqli_fetch_array($result_favorites);
	$result_favorites_string = $result_favorites_mas[0];    // $result_favorites_string - строка из поля favorites
	if ($result_favorites_string[$cur_id_php] == 0) {
		$result_favorites_string[$cur_id_php] = 2;
	}
	if ($result_favorites_string[$cur_id_php] == 1) {
		$result_favorites_string[$cur_id_php] = 3;
	}
	$result_favorites = mysqli_query($link,"UPDATE ".$db_table_users." SET favorites='".$result_favorites_string."' WHERE login='".$user_login_php."'"); // Записываем измененную строку
	
	// Создание запроса на выборку из базы данных
	$result = mysqli_query($link,"SELECT id,type,who_does,pose_woman,pose_man,attribute,description,img_mission,status FROM ".$db_table." WHERE status=1".$type_set_query_php);
	if ($result == true){
	//echo "Запрос успешен";
	} else {
		echo $result;
		echo "Запрос не выполнен!";
	}

	//Подсчет количества выбранных записей
	$count_record = 0; // Общее количество записей, удовлетворяющих запросу, инициализация переменной
	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
		$arr[] = $row;
		$count_record++; // Подсчет общего количества записей, удовлетворяющих запросу
	}


	$favorites = 2; // Значение, если пользователь не залогинен
	// Проверяем, не находится ли данное задание в "избранном", если пользователь залогинен
	if ($user_login_php != '') {
		$result_favorites = mysqli_query($link,"SELECT favorites FROM ".$db_table_users." WHERE login='".$user_login_php."'"); // Запрос на получение строки favorites
		$result_favorites_mas = mysqli_fetch_array($result_favorites);
		$result_favorites_string = $result_favorites_mas[0];    // $result_favorites_string - строка из поля favorites
		
		// Формирование конечного массива, удовлетворяющего настройкам, из которого будет выбираться случайное задание
		$final_array_length = 0;
		for ($i = 0; $i < $count_record; $i++) {
			$current_id = $arr[$i]['id'];
			
			if ($show_set_all_php == "001") {
				if ($result_favorites_string[$current_id] == "1" || $result_favorites_string[$current_id] == "3") {
					$final_array[] = $arr[$i];
					$final_array_length++;
				}
			}
			
			if ($show_set_all_php == "011") {
				if ($result_favorites_string[$current_id] == "0" || $result_favorites_string[$current_id] == "1" || $result_favorites_string[$current_id] == "3") {
					$final_array[] = $arr[$i];
					$final_array_length++;
				}
			}
			
			if ($show_set_all_php == "110") {
				if ($result_favorites_string[$current_id] == "0" || $result_favorites_string[$current_id] == "2") {
					$final_array[] = $arr[$i];
					$final_array_length++;
				}
			}
			
			if ($show_set_all_php == "111") {
					$final_array[] = $arr[$i];
					$final_array_length++;
			}
			
			if ($show_set_all_php != "001" && $show_set_all_php != "110" && $show_set_all_php != "111") {
				if ($result_favorites_string[$current_id] == $show_set_query_php) {
					$final_array[] = $arr[$i];
					$final_array_length++;
				}
			}
		}
		
	}
	
	//Генерация рандомного числа - номера записи для вывода на экран
	$show_record = rand(0,$final_array_length-1); // Номер записи, которая будет выведена на экран
	
	if ($user_login_php != '') {
		$current_id = $final_array[$show_record]['id'];
		if ($result_favorites_string[$current_id] == '1' || $result_favorites_string[$current_id] == '3') {
			$favorites = 1; // Если задание в избранном
		}
		else {
			$favorites = 0; // Если задание нет в избранном
		}
	}
	
	if ($final_array_length != 0) {
		// Вывод задания на экран
		echo "<b>Тип: </b>";
		echo $final_array[$show_record]['type'];
		echo "<br>";
		if ($final_array[$show_record]['attribute'] != "") {
			echo "<b>Дополнительные условия: </b>";
			echo $final_array[$show_record]['attribute'];
			echo "<br>";
		}
		if ($final_array[$show_record]['description'] != "") {
			echo "<b>Описание задания: </b>";
			echo $final_array[$show_record]['description'];
		}
		if ($final_array[$show_record]['img_mission'] != "") {
			echo "<div class = 'img_mission_div'> 
					<img class = 'image_mission' src = 'img/img_mission/".$final_array[$show_record]['img_mission']."'> 
				 </div>";
		}
		echo "?";
		echo $final_array[$show_record]['id'];
		echo $favorites;
	}
	else {
		echo "<div class = 'center'> По заданным настройкам не получилось подобрать ни одного задания.<br><br>";
		echo "<img src = 'img/BrokenHeart-1.png' width = '100' align = 'center'></div>";
	}
}

/*----------------------------------------------------------------------------*/
/*------------------------- Обработка кнопки impossible ----------------------*/
/*----------------------------------------------------------------------------*/

if ($show_mode_php == "impossible") {
	// Создание запроса на изменение поля status. Установка в поле значения 1 
	$result = mysqli_query($link,"UPDATE ".$db_table." SET status=2 WHERE id=".$cur_id_php);
	if ($result == true){
		//echo "Запрос успешен";
	}
	else {
		echo $result;
		echo "Запрос не выполнен!";
	}
	
	// Создание запроса на выборку из базы данных
$result = mysqli_query($link,"SELECT id,type,who_does,pose_woman,pose_man,attribute,description,status FROM ".$db_table." WHERE status=0".$type_set_query_php.$show_set_query_php);
if ($result == true){
	//echo "Запрос успешен";
}else{
	echo $result;
	echo "Запрос не выполнен!";
}

//Подсчет количества выбранных записей
$count_record = 0; // Общее количество записей, удовлетворяющих запросу, инициализация переменной
while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
	$arr[] = $row;
	$count_record++; // Подсчет общего количества записей, удовлетворяющих запросу
}

//Генерация рандомного числа - номера записи для вывода на экран
$show_record = rand(0,$count_record); // Номер записи, которая будет выведена на экран


// Вывод задания на экран
echo "<b>Тип: </b>";
echo $arr[$show_record]['type'];
echo "<br>";
echo "<b>Задание для: </b>";
echo $arr[$show_record]['who_does'];
echo "<br>";
echo "<b>Поза девушки: </b>";
echo $arr[$show_record]['pose_woman'];
echo "<br>";
echo "<b>Поза парня: </b>";
echo $arr[$show_record]['pose_man'];
echo "<br>";
if ($arr[$show_record]['attribute'] != "") {
echo "<b>Дополнительные условия: </b>";
echo $arr[$show_record]['attribute'];
echo "<br>";
}
if ($arr[$show_record]['description'] != "") {
	echo "<b>Описание задания: </b>";
	echo $arr[$show_record]['description'];
}
echo "?";
echo $arr[$show_record]['id'];
}


/*----------------------------------------------------------------------------*/
/*---------------- Обработка кнопки "Добавить в избранное" -------------------*/
/*----------------------------------------------------------------------------*/

if ($show_mode_php == "addFavorites") {
	// Создание запроса на изменение поля favorites
	$result_favorites = mysqli_query($link,"SELECT favorites FROM ".$db_table_users." WHERE login='".$user_login_php."'"); // Запрос на получение строки favorites
	$result_favorites_mas = mysqli_fetch_array($result_favorites);
	$result_favorites_string = $result_favorites_mas[0];    // $result_favorites_string - строка из поля favorites
	if ($result_favorites_string[$cur_id_php] == 0) {
		$result_favorites_string[$cur_id_php] = 1;
	}
	if ($result_favorites_string[$cur_id_php] == 2) {
		$result_favorites_string[$cur_id_php] = 3;
	}
	$result_favorites = mysqli_query($link,"UPDATE ".$db_table_users." SET favorites='".$result_favorites_string."' WHERE login='".$user_login_php."'"); // Записываем измененную строку
}

/*----------------------------------------------------------------------------*/
/*---------------- Обработка кнопки "Удалить из избранного" ------------------*/
/*----------------------------------------------------------------------------*/

if ($show_mode_php == "deleteFavorites") {
	// Создание запроса на изменение поля favorites
	$result_favorites = mysqli_query($link,"SELECT favorites FROM ".$db_table_users." WHERE login='".$user_login_php."'"); // Запрос на получение строки favorites
	$result_favorites_mas = mysqli_fetch_array($result_favorites);
	$result_favorites_string = $result_favorites_mas[0];    // $result_favorites_string - строка из поля favorites
	if ($result_favorites_string[$cur_id_php] == 1) {
		$result_favorites_string[$cur_id_php] = 0;
	}
	if ($result_favorites_string[$cur_id_php] == 3) {
		$result_favorites_string[$cur_id_php] = 2;
	}
	$result_favorites = mysqli_query($link,"UPDATE ".$db_table_users." SET favorites='".$result_favorites_string."' WHERE login='".$user_login_php."'"); // Записываем измененную строку
}
?>