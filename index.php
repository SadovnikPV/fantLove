<!DOCTYPE html>
<head>
	<title>Фанты </title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<meta name="description" content="Фанты" />
	<meta http-equiv="Content-Language" content="ru">
	<meta name="robots" content="index, follow" />
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<script src="js_scripts.js"></script>

<div class="pagewrap">

	
	<!------------------------------- Логотип (header) --------------------------------->
	<div class="header">
		<div id = "logo">
			<div id = "logo_img">
				<img class = "main_logo" src = "img/LogoImg.jpg" onclick = "toMainWindow()" title = "На главную"> &nbsp
				<img class = "main_logo" src = "img/LogoTitle.png" onclick = "toMainWindow()" title = "На главную">
			</div>
			<div id = "logo_title">
				
			</div>
		</div>
		<br>
		<div class = "clear">
		</div>
	</div>
	
	<!------------------------------- Меню ------------------------------------------->
	<div id = "main_menu">
		<div id="header_settings">
			<a href="javascript:void(0)" onclick="buttonSettings()"><img class="button-settings" src="img/ButtonSettings_icon.png"></a>
		</div>
		<div id="header_autorization">
			<div id="header_autorization_logon"> 
				<button class = "login-button" onclick="javascript:authorizationLogOut()"><img class = "authorization_button_img" src="img/Logout-1_icon.png"> Выход </button>				
			</div>
			<div id="header_autorization_logout">
				<button class = "login-button" onclick="javascript:authorizationShow('all_window','authorization_window')"><img class = "authorization_button_img" src="img/Autorization-1_icon.png"> Вход </button>
			</div>
			<script type="text/javascript"> loginShow() </script>
		</div>
		<div class = "clear">
		</div>
	</div>
	
	<!-------------------------- Окно авторизации ----------------------------->
	<div id="authorization_window">
		<div class = "close_window">
			<a href="javascript:void(0)" onclick="toMainWindow()"> <img class = "close_icon" src = "img/close_icon.png"> </a>
		</div>
		<form action="javascript:authorization('authorization_window','all_window')" method="post">
		Логин: <br>
		<input type="text" class="input-style" name="login" id="login"> <br>
		Пароль: <br>
		<input type="password" class="input-style" name="password" id="password"> <br>
		<a href=""> Забыли пароль? </a> <br>
		<div id="authorization_result"> </div>
		<br>
		<input type="submit" class = "button-basic-blue" name="submit" value="Войти">
		</form>
		<br>
		<span> Еще не зарегистрированы? </span> <br>
		<a href="javascript:void(0)" onclick="buttonRegistration()"> Зарегистрироваться </a> <br><hr>
		<span> Что дает регистрация? </span> <a href="javascript:void(0)" onclick="buttonAboutRegistration()"> Узнать </a>
	</div>
	
	<div id="about_registration_window">
		<p class = "center"><b> Что дает регистрация? </b></p>
		Бесплатная регистрация позволит Вам: <br>
		 - Отмечать задания, как выполненные <br>
		 - Добавлять понравившиеся задания в избранное <br>
		 - Выбирать, какие задания вы хотите видеть - выполненные, невыполненные или избранные <br>
		 <!-- - Добавлять свои собственные задания, которые будут видны только Вам или всем пользователям <br>
		 - Смотреть статистику по заданиям <br> -->
		 <p class = "center"><button class = "button-basic-blue" onclick = "buttonAboutRegistrationClose()"> Понятно </button></p>
	</div>
	
	<!-------------------------- Окно регистрации ----------------------------->
	<div id="registration_window">
		<div class = "close_window">
			<a href="javascript:void(0)" onclick="toMainWindow()"> <img class = "close_icon" src = "img/close_icon.png"> </a>
		</div>
		<form action="javascript:registration()" method="post">
		Ваша почта: <br>
		<input type="text" class="input-style" name="login_reg" id="login_reg"> <br>
		<img class="tip_icon" src="img/tip_icon.png" alt="Подсказка" title="Пароль должен содержать минимум 8 символов. Допустимо использовать буквы латинского алфавита, цифры и нижнее подчеркивание">  Пароль: <br>
		<input type="password" class="input-style" name="password1" id="password1"> <br>
		Повторите пароль: <br>
		<input type="password" class="input-style" name="password2" id="password2"> <br>
		Введите число с картинки: <br>
		<div id = "captcha">
			
		</div>
		<img class = "reload_icon" src = "img/Reload-1_icon.png" title = "Обновить изображение" onclick = "captchaShow()">	<br>		
		<input type="text" class="input-style" name="captchaInput" id="captchaInput"> <br>
		<div id="registration_result"> </div>
		<br>
		<input type="submit" class = "button-basic-blue" name="submit" value="Зарегистрироваться">
		</form>
		<br>
	</div>	
	
	<!-------------- Окно подтверждения успешной регистрации (Поздравляем, вы успешно зарегистрированы...) -------------->
	<div id="registration_done_window">
		<br>
		Поздравляем!!! Вы успешно зарегистрировались! <br><br>
		<img src = "img/HappyHeart.png" width = "170"> <br><br>
		<button class = "button-basic-blue" onclick = "registrationSuccessContinue()"> Продолжить </button>
		<br>
	</div>
	
	
	<!-- Все окна (настройки, контент) -->
	<div id="all_window">
	
	
	<!-------------------------------------------------------------------------------->
	<!----------------------------- Окно настроек ------------------------------------>
	<!-------------------------------------------------------------------------------->

	<div id="settings">
	    <div class="center_bold">
		    Настройки
		</div>
		Выберите, задания какого типа вы хотите видеть: <br>
		<form name="settings">
			<input class="checkbox-settings-style" type="checkbox" checked id="typeSetMasturbation" value="1"> Для одного <br>
			<input class="checkbox-settings-style" type="checkbox" checked id="typeSetOral" value="1"> Для двоих <br>
			<input class="checkbox-settings-style" type="checkbox" checked id="typeSetClassic" value="1"> Для компании <br>
			<hr>
			<div id = "show-settings-login">                               <!--Блок настроек для авторизированного пользователя-->
				Показывать задания: <br>
				<input class="checkbox-settings-style" type="checkbox" checked id="showSetDone" value="1"> Выполненные <br>
				<input class="checkbox-settings-style" type="checkbox" checked id="showSetNotDone" value="1"> Невыполненные <br>
				<input class="checkbox-settings-style" type="checkbox" checked id="showSetFavorites" value="1"> Избранное <br>
			</div>
			<div id = "show-settings-logout">                              <!--Блок настроек для неавторизированного пользователя-->
				Показывать задания: <br>
				<input class="checkbox-settings-style" type="checkbox" id="showSetDone" disabled> Выполненные 
				<img class="tip_icon" src="img/tip_icon.png" alt="Подсказка" title="Доступно после бесплатной регистрации"> <br>
				<input class="checkbox-settings-style" type="checkbox" id="showSetNotDone" disabled> Невыполненные
				<img class="tip_icon" src="img/tip_icon.png" alt="Подсказка" title="Доступно после бесплатной регистрации"> <br>
				<input class="checkbox-settings-style" type="checkbox" id="showSetFavorites" disabled> Избранное
				<img class="tip_icon" src="img/tip_icon.png" alt="Подсказка" title="Доступно после бесплатной регистрации"> <br>
			</div>
			<script type = "text/javascript"> SettingsShow() </script>     <!--Скрипт определения, авторизирован ли пользователь-->
			<div class="center">
			    <input class="button-settings-ok" onclick="buttonSettingsOk('settings')" type="button" value="Ок" >
			</div>
		</form>
	</div>
	
	
	<!-------------------------------------------------------------------------------->
	<!---------------------------- Стартовое окно ------------------------------------>
	<!-------------------------------------------------------------------------------->
	
	<div id="start_window">
		<div class="button-basic-block">
			<!-- <button class = "button-basic" onclick="showHideTwoBlocks('start_window', 'mission_window')"> Light </button> <br> -->
			<button class = "button-basic" onclick="buttonHard('start_window', 'mission_window')"> Начать </button>
		</div>
	</div>
	

	<!-------------------------------------------------------------------------------->
	<!------------------------ Основное окно с заданиями ----------------------------->
	<!-------------------------------------------------------------------------------->
	
	<div id="mission_window">
		<div id = "main-content">
			<div id = "show-mission-block">
			<!-- Здесь выводятся задания -->
			</div>
			<br>
			<div id = "favorites-button-block-add">
				<br><br>
				<button class = "favorites-button" onclick="addFavorites()"><img class ="favorites-button-img" src="img/RedHeart-1_icon.png"> Добавить в избранное </button>
			</div>
			<div id = "favorites-button-block-delete">
				<br>
				<button class = "favorites-button" onclick="deleteFavorites()"><img class ="favorites-button-img" src="img/RedHeart-1_icon.png"> Удалить из избранного </button>
			</div>
			<div id = "favorites-button-block-loading">
				<br>
				Загрузка...
			</div>
			<script type="text/javascript"> FavoritesButtonShow() </script>
		</div>
		<br>
		<div id = "button-basic-block_logon">
			<button class = "button-basic" onclick="buttonDone()"> Выполнено </button> <br>
			<button class = "button-basic" onclick="buttonSkip()"> Пропустить </button> <br>
			<!-- <button class = "button-basic" onclick="buttonImpossible()"> Невыполнимо </button> -->
		</div>
		<div id = "button-basic-block_logout">
			<button class = "button-basic" onclick="buttonSkip()"> Следующее </button> <br>
		</div>
		<script type="text/javascript"> BasicButtonShow() </script>
	</div>
	</div>

	<br><br>
</div>


	<!------------------------------- Служебная информация (Footer) --------------------------------->
	<div class = "footer">
		<a href="about_us.php"> О нас </a><br>
		<a href="contacts.php"> Написать разработчикам </a><br>
		<div class = "center"> &#169; LoveIsGame.ru &nbsp; 2020-2021, &nbsp; 18+ </div>
	</div>




</body>
</html>

