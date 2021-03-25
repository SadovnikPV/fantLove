<!DOCTYPE html>
<head>
	<title>GameLove</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<script src="js_scripts.js"></script>

<div class="pagewrap">

	
	<!------------------------------- Лого (header) --------------------------------->
	<div class="header">
		<div id = "logo">
			<div id = "logo_img">
				<img class = "pointer" src = "img/LogoImg.jpg" onclick = "toMainWindow()" title = "На главную" height = "30"> &nbsp
				<img class = "pointer" src = "img/LogoTitle.png" onclick = "toMainWindow()" title = "На главную" height = "30">
			</div>
			<div id = "logo_title">
				321 способ доставить друг другу удовольствие
			</div>
		</div>
		<br>
		<div class = "clear">
		</div>
	</div>

	<!-------------------------------------------------------------------------------->
	<!------------------------ Описание контактов --------------------------------->
	<!-------------------------------------------------------------------------------->
	
		<div class = "main-content-different">
			<div class = "center"> <h3> Контакты </h3> </div>
			<p>Нашли ошибку на сайте?</p>
			<p>У вас есть идеи, какого функционала не хватает на сайте?</p>
			<p>Есть любые другие замечания и предложения?</p>
			<p>Напишите нам на почту "здесь почта" или воспользовавшись формой ниже.</p> 
			<p>Мы рады любому вашему обращению и обязательно ответим вам так быстро, как только сможем!</p>
			<div class = "center"> <button class = "button-basic-blue" onclick = "toMainWindow()"> Вернуться на главную </button> </div> <br>
		</div> <br>
		<div class = "main-content-different">
			<div class = "center"> <h3>Написать разработчикам </h3> </div>
			<form action = "javascript:contactsForm()" name = "mailForm" method = "post">
				Введите адрес вашей электронной почты, чтобы мы моглы ответить вам:<br>
				<div class = "padding_left"> <input type = "text" class="input-style" id = "emailContactsForm"> </div> <br>
				Введите ваше сообщение:<br>
				<div class = "padding_left"> <textarea class = "input-textarea-style" id = "textContactsForm"></textarea> </div> <br>
				<div id = "contactsFormResponse"></div>
				<div class = "center"> <input type = "submit" class = "button-basic-blue" value = "Отправить"> </div>
			</form>
		</div>
			
		</div>

	<br><br>
</div>
	<div class = "footer">
		<a href="about_us.php"> О нас </a><br>
		<a href="contacts.php"> Написать разработчикам </a><br>
		<div class = "center"> &#169; LoveIsGame.ru &nbsp; 2020-2021, &nbsp; 18+ </div>
	</div>




</body>
</html>

