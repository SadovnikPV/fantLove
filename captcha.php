<?php
$mode = $_GET['mode'];

if ($mode == 'query') {
	$captcha_background_count = 4; // Количество различных фонов
	$captcha_background = rand(1,$captcha_background_count); // Выбор случайного фона
	$img = "captcha/background/captcha_background_".$captcha_background.".png"; // Ссылка на фон капчи
	$pic = imagecreatefrompng($img); // Функция создания изображения
	$text = 0; // Текст капчи, пока пустой
	$x = rand(20,40); // Начальное смещение слева (координата x) 
	$x_rand = 0; // Смещение до следующей буквы
	$pic_result = "captcha/temporary_captcha/captcha".time().".png"; // Путь к готовой капче
	imagepng($pic, $pic_result); // Первоначальное сохранение рисунка
	imagedestroy($pic); // Освобождение памяти и закрытие рисунка
	$digit = rand(1,9); // Генерация первой случайной цифры капчи
	
	// Генерация капчи, состоящей из четырех цифр
	for ($i = 0; $i < 4; $i++) {
		$text = $text*10 + $digit; // Собираем из сгенерированных чисел итоговое число, которое будет на капче
		$font = "captcha/fonts/arial-black.ttf"; // Ссылка на шрифт
		$font_size = rand(40,52); // Размер шрифта
		$degree = rand(-30,30); // Угол поворота текста в градусах
		$y = rand(50,70); // Смещение сверху (координата y)
		$x = $x + $x_rand; // Смещение слева (координата x)
		$x_rand = rand(38,58); // Смещение до следущей буквы
		$pic = imagecreatefrompng($pic_result); // Функция создания изображения
		$color = imagecolorallocate($pic, rand(0,255), rand(0,255), rand(0,255)); // Функция выделения цвета для текста
	
		imagettftext($pic, $font_size, $degree, $x, $y, $color, $font, $digit); // Функция нанесения текста
		imagepng($pic, $pic_result); // Сохранение рисунка
		imagedestroy($pic); // Освобождение памяти и закрытие рисунка
		$digit = rand(0,9); // Генерация новой случайной цифры капчи
	}
	// В переменной $text содержится текст капчи
	
	// Запись текста капчи в файл во временной директории
	$fp = fopen($pic_result.".dat", 'w'); // Создание и открытие файла
	$test = fwrite($fp, $text); // Запись данных в файл
	fclose($fp); //Закрытие файла
	
	echo $pic_result;
}

if ($mode == 'answer') {
	$captchaIdImg = $_GET['captchaId']; // Имя файла изображения
	$captchaId = $_GET['captchaId'].'.dat'; // Имя файла с числом, которое на изображении
	$captchaText = $_GET['captchaText']; // Число, которое ввел пользователь
	$fp = fopen("captcha/temporary_captcha/".$captchaId, 'r');
	$rightAnswer = fgets($fp, 5);
	if ($rightAnswer == $captchaText) {
		echo 1; // Если проверка прошла
	}
	else {
		echo 0; // Если проверка не прошла
	}
	fclose($fp);
	unlink("captcha/temporary_captcha/".$captchaIdImg);
	unlink("captcha/temporary_captcha/".$captchaId);
}
?>


