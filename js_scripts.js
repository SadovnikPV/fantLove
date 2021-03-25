// Глобальные переменные
var level = 0; // Переменная уровня сложности
var curId = 0; // ID текущего задания, показываемого на экране
var show_mode = "";
var favorites = "";

// Переменные - текущее значение настроек
var typeSetAll = "111"; // Строка состояния настроек типов секса. Состоит из трех цифр 1 или 0. Где 1 - выбранный тип, 0 - не выбранный

// Строка состояния настроек вывода. Первая цифра - показывать выполненные. Вторая цифра - показывать невыполненные задания. Третья - избранные задания. 1 - флаг установлен, 0 - снят.
var showSetAll = "111"; 

var typeSetMasturbation = 1;
var typeSetOral = 1;
var typeSetClassic = 1;
var showSetDone = 1;
var showSetNotDone = 1;
var showSetFavorites = 1;

// Переменная идентификатор капчи
var captchaId = "";
var captchaApply = 0;
// Переменные, показывающие вход пользователя на сайт

// Функция показывает/скрывает блок. Входной параметр - id блока
function showHide(element_id) {
	//Если элемент с id-шником element_id существует
	if (document.getElementById(element_id)) { 
		//Записываем ссылку на элемент в переменную obj
		var obj = document.getElementById(element_id); 
		//Если css-свойство display не block, то: 
		if (obj.style.display != "block") { 
			obj.style.display = "block"; //Показываем элемент
        }
        else obj.style.display = "none"; //Скрываем элемент
	}
	//Если элемент с id-шником element_id не найден, то выводим сообщение
	else alert("Элемент с id: " + element_id + " не найден!"); 
}

// Функция показывает/скрывает блок. Входной параметр - id блока
function showBlock(element_id) {
	//Если элемент с id-шником element_id существует
	if (document.getElementById(element_id)) { 
		//Записываем ссылку на элемент в переменную obj
		var obj = document.getElementById(element_id); 
		//Если css-свойство display не block, то: 
		if (obj.style.display != "block") { 
			obj.style.display = "block"; //Показываем элемент
        }
	}
	//Если элемент с id-шником element_id не найден, то выводим сообщение
	else alert("Элемент с id: " + element_id + " не найден!"); 
}

// Функция показывает/скрывает блок. Входной параметр - id блока
function hideBlock(element_id) {
	//Если элемент с id-шником element_id существует
	if (document.getElementById(element_id)) { 
		//Записываем ссылку на элемент в переменную obj
		var obj = document.getElementById(element_id);
	obj.style.display = "none";}
	//Если элемент с id-шником element_id не найден, то выводим сообщение
	else alert("Элемент с id: " + element_id + " не найден!"); 
	
}

// Функция скрывает один блок и показывает другой. Входные параметры: первый - id скрываемого блока, второй - id показываемого блока
// Функция показывает/скрывает блок. Входной параметр - id блока
function showHideTwoBlocks(element1_id, element2_id) {
	//Если элемент с id-шником element_id существует
	if (document.getElementById(element1_id)) { 
		if (document.getElementById(element2_id)) {
		//Записываем ссылку на элемент в переменную obj
		var obj1 = document.getElementById(element1_id); 
		var obj2 = document.getElementById(element2_id);
		obj1.style.display = "none"; // Скрываем первый блок
		obj2.style.display = "block"; // Показываем второй блок
		show_mission();
		}
		//Если элемент с id-шником element_id2 не найден, то выводим сообщение
		else alert("Элемент с id2: " + element2_id + " не найден!");
	}
	//Если элемент с id-шником element_id1 не найден, то выводим сообщение
	else alert("Элемент с id1: " + element1_id + " не найден!"); 
}


/* ---------------------------*/
/* Функции-обработчики кнопок */
/* ---------------------------*/

// Кнопка "Settings"
function buttonSettings() {
	if (document.getElementById('settings')) {
		var settingsObj = document.getElementById('settings');
		if (settingsObj.style.display != "block") {
			settingsObj.style.display = "block";
		}
		else {
			buttonSettingsOk('settings');
		}
	}
}

// Кнопка "Начать"
function buttonHard(element1_id, element2_id) {
	showHideTwoBlocks(element1_id, element2_id);
}

// Кнопка "Выполнено"
function buttonDone() {
	show_mode = "done";
	show_mission(show_mode);
}

// Кнопка "Пропустить"
function buttonSkip() {
	show_mode = "skip";
	show_mission(show_mode);
}

// Кнопка "Невыполнимо"
function buttonImpossible() {
	show_mode = "impossible";
	show_mission(show_mode);
}

// Кнопка "Ок" в окне настроек
// Функция формирует две глобальных строки. typeSetAll - состояние настроек выбранных типов секса. showSetAll - состояние настроек вывода заданий
function buttonSettingsOk(element_id) {
	
	var typeSetMasturbationObj;
	var typeSetOralObj;
	var typeSetClassicObj;
	var showSetDoneObj;
	var showSetNotDoneObj;
	var showSetFavoritesObj;
	typeSetMasturbationObj = document.getElementById('typeSetMasturbation'); // Получение значения из поля checkbox "Мастурбация"
	typeSetOralObj = document.getElementById('typeSetOral'); // Получение значения из поля checkbox "Оральный секс"
	typeSetClassicObj = document.getElementById('typeSetClassic'); // Получение значения из поля checkbox "Классический секс"
	showSetDoneObj = document.getElementById('showSetDone'); // Получение значения из поля checkbox "Выполненные"
	showSetNotDoneObj = document.getElementById('showSetNotDone'); // Получение значения из поля checkbox "Невыполненные"
	showSetFavoritesObj = document.getElementById('showSetFavorites'); // Получение значения из поля checkbox "Избранное"
	// Установка значений 1 и 0 (1 - checkbox отмечен, 0 - не отмечен) в соответствующие переменные и формирование общей строки настроек типов секса typeSetAll
	
	typeSetMasturbation = (typeSetMasturbationObj.checked) ? 1 : 0;
	typeSetOral = (typeSetOralObj.checked) ? 1 : 0;
	typeSetClassic = (typeSetClassicObj.checked) ? 1 : 0;
	
	typeSetAll = "";
	typeSetAll = typeSetAll + typeSetMasturbation + typeSetOral + typeSetClassic;
	
	// Установка значений 1 и 0 (1 - checkbox отмечен, 0 - не отмечен) в соответствующие переменные и формирование общей строки настроек вывода заданий showSetAll
	showSetDone = (showSetDoneObj.checked) ? 1 : 0;
	showSetNotDone = (showSetNotDoneObj.checked) ? 1 : 0;
	showSetFavorites = (showSetFavoritesObj.checked) ? 1 : 0;

	showSetAll = "";
	showSetAll = showSetAll + showSetDone + showSetNotDone + showSetFavorites;
	
	// Если в каждом блоке отмечен хотя бы один пункт - окно настроек закрывается. Иначе выводится сообщение, что надо отметить.
	if (typeSetAll == "000" || showSetAll == "000") {
		alert('В каждом блоке настроек должен быть отмечен хотя бы один пункт');
	}
	else {
		hideBlock(element_id);
	}	
}

/* --- Кнопка "На главную" на главном экране. Срабатывает, при нажатии на логотип --- */
function toMainWindow() {
	document.location.href = "index.php";
}

/* --- Кнопка "Вход" на главном экране. Показывает окно авторизации, скрывает другие окна --- */
function authorizationShow(element1_id, element2_id) {
	showHideTwoBlocks(element1_id, element2_id);
	document.getElementById('main_menu').style.display = "none";
}

/* --- Кнопка "Выход" на главном экране. Очищает LocalStorage, сбрасывает приветствие в окне авторизации --- */
function authorizationLogOut() {
	window.localStorage.setItem('login','');
	window.location.reload();
}

/* --- Кнопка "Узнать" (о регистрации) на странице авторизации пользователя --- */
function buttonAboutRegistration() {
	document.getElementById('about_registration_window').style.display = "block";
	document.location.href = "#about_registration_window";
}

/* --- Кнопка "Понятно" в окне "Что дает регистрация" --- */
function buttonAboutRegistrationClose() {
	document.getElementById('about_registration_window').style.display = "none";
	document.location.href = "#authorization_window";
}

/* --- Кнопка "Зарегистрироваться" в окне авторизации --- */
function buttonRegistration() {
	document.getElementById('authorization_window').style.display = "none";
	document.getElementById('about_registration_window').style.display = "none";
	document.getElementById('registration_window').style.display = "block";
	captchaShow();
}

/* --- Кнопка "Добавить в избранное". Делает пометку в базе данных о том, что текущая миссия отмечается "избранной" --- */
function addFavorites() {
	show_mode = "addFavorites";
	document.getElementById('favorites-button-block-add').style.display = "none";
	document.getElementById('favorites-button-block-delete').style.display = "none";
	document.getElementById('favorites-button-block-loading').style.display = "block";
	var userLogin = window.localStorage.getItem('login');
	http.open('get', 'mission_hard_show.php?show_mode='+show_mode+'&cur_id='+curId+'&typeSetAll='+typeSetAll+'&showSetAll='+showSetAll+'&login='+userLogin,true);
	http.onreadystatechange = addFavoritesResult;
	http.send(null);
}
/* --- Функция обработчик ответа от файла mission_hard_show.php после запроса функции addFavorites() --- */
function addFavoritesResult() {
	if(http.readyState == 4){ 
	var response = http.responseText;
	}
	document.getElementById('favorites-button-block-loading').style.display = "none";
	document.getElementById('favorites-button-block-delete').style.display = "block";
}

/* --- Кнопка "Удалить из избранного". Делает пометку в базе данных о том, что текущая миссия удаляется из "избранных" --- */
function deleteFavorites() {
	show_mode = "deleteFavorites";
	document.getElementById('favorites-button-block-delete').style.display = "none";
	document.getElementById('favorites-button-block-add').style.display = "none";
	document.getElementById('favorites-button-block-loading').style.display = "block";
	var userLogin = window.localStorage.getItem('login');
	http.open('get', 'mission_hard_show.php?show_mode='+show_mode+'&cur_id='+curId+'&typeSetAll='+typeSetAll+'&showSetAll='+showSetAll+'&login='+userLogin,true);
	http.onreadystatechange = deleteFavoritesResult;
	http.send(null);
}
/* --- Функция обработчик ответа от файла mission_hard_show.php после запроса функции deleteFavorites() --- */
function deleteFavoritesResult() {
	if(http.readyState == 4){ 
	var response = http.responseText;
	}
	document.getElementById('favorites-button-block-loading').style.display = "none";
	document.getElementById('favorites-button-block-add').style.display = "block";
}

/* --- Кнопка "Войти" в окне авторизации ----------------------------------------- */
/* --- Сверяет введенные логин и пароль с базой данных --------------------------- */
/* --- В случае успеха скрывает окно авторизации и возвращает на главный экран --- */

function authorization(element1_id, element2_id) {
	var login= encodeURI(document.getElementById('login').value);
	window.localStorage.setItem('login',login);
	var userPassword= encodeURI(document.getElementById('password').value);
	var modeUserQuery = "authorization";
	var loading = "<div class='center'> <img src = 'img/HeartAnimation-3.gif' width=120 height=120> </div>"; // Создание блока с анимацией загрузки
	document.getElementById('authorization_result').innerHTML = loading;
	http.open('get', 'autorization.php?login='+login+'&userPassword='+userPassword+'&modeUserQuery='+modeUserQuery,true);
	http.onreadystatechange = insertReplyAuthorization;
	http.send(null);	
}

/* --- Функция обработки полученных данных из файла authorization.php при авторизации существующего пользователя --- */
function insertReplyAuthorization() {
	if(http.readyState == 4){ 
	var response = http.responseText;
		if (response == 1) {
			document.getElementById('main_menu').style.display = "block";
			var userLogin = window.localStorage.getItem('login');
			loginShow();
			showHideTwoBlocks('authorization_window','all_window');
		}
		else {
		window.localStorage.setItem('login','');
		document.getElementById('authorization_result').innerHTML = "<br>" + response;
		}
	}
	
	BasicButtonShow();
	FavoritesButtonShow();
	SettingsShow();           // Изменить меню настроек
}

/* --------------------- Кнопка "Регистрация" в окне авторизации ---------------------------------- */
/* --- Проверяет, существует ли уже такой логин, проверяет совпадение 1-ого и 2-ого паролей ------- */
/* --- Проверяет правильности капчи. Заносит новую информацию в базу данных ----------------------- */
function registration() {
	var modeUserQuery = "registration";
	var loginReg= encodeURI(document.getElementById('login_reg').value);
	// Проверка корректности введенной почты
	var regularExpressionEmail = /^[\w]{1}[\w-\.]*@[\w-]+\.[a-z]{2,4}$/i; // Регулярное выражение
	var validEmail = regularExpressionEmail.test(loginReg); // true, если почта введена верно и false в ином случае
	if (!validEmail) {
		document.getElementById('registration_result').innerHTML = "<br>Адрес электронной почты введен неверно!";
		return;
	}
	
	captchaApply = 0;
	// Проверка правильности введенной капчи
	captchaCheck();
	if (captchaApply == 0) {
		document.getElementById('registration_result').innerHTML = "<br>Число с изображения введено неверно!";
		captchaShow();
		return;
	}
	
	var userPassword1= encodeURI(document.getElementById('password1').value);
	var userPassword2= encodeURI(document.getElementById('password2').value);
	if (userPassword1 == userPassword2) {
		var userPassword = userPassword1;
		
		// Проверка правильности введенного пароля
		var regularExpressionPassword = /^[\w\d]+$/i // Регулярное выражение для проверки пароля
		var validPassword = regularExpressionPassword.test(userPassword); // true, если пароль введен верно и false в ином случае
		if (!validPassword) {
			document.getElementById('registration_result').innerHTML = "<br>В пароле использованы недопустимые символы!";
			return;
		}
		if (userPassword.length < 8) {
			document.getElementById('registration_result').innerHTML = "<br>Ваш пароль слишком короткий!";
			return;
		}
		
		window.localStorage.setItem('login',loginReg);
		// Если все проверки пройдены, отправляем данные на сервер
		document.getElementById('registration_result').innerHTML = "<br>Загрузка";
		http.open('get', 'autorization.php?login='+loginReg+'&userPassword='+userPassword+'&modeUserQuery='+modeUserQuery,true);
		http.onreadystatechange = insertReplyRegistration;
		http.send(null);
	}
	else {
		document.getElementById('registration_result').innerHTML = "<br>Введенные пароли не совпадают. Пожалуйста, попробуйте еще раз.";
	}
	
	
}

/* --- Функция обработки полученных данных из файла authorization.php при регистрации нового пользователя --- */
function insertReplyRegistration() {
	if(http.readyState == 4){ 
	var response = http.responseText;
		if (response == 1) {
			var userLogin = window.localStorage.getItem('login');
			loginShow();
			showHideTwoBlocks('registration_window','registration_done_window');
		}
		else {
		window.localStorage.setItem('login',''); 
		document.getElementById('registration_result').innerHTML = "<br>" + response;
		}
	}
	BasicButtonShow();
	FavoritesButtonShow();
	SettingsShow();           // Изменить меню настроек
}

// Кнопка "Продолжить" в окне успешной регистрации
function registrationSuccessContinue() {
	document.getElementById('registration_done_window').style.display = "none";
	document.getElementById('main_menu').style.display = "block";
	document.getElementById('all_window').style.display = "block";
}




/* AJAX */
/* XMLHTTPRequest Enable */
/* ---------------------------- */
/* Функции для работы с базой данных */
function createObject() {
	var request_type;
	var browser = navigator.appName;
	if(browser == "Microsoft Internet Explorer"){
	request_type = new ActiveXObject("Microsoft.XMLHTTP");
	}else{
	request_type = new XMLHttpRequest();
	}
	return request_type;
	}
	
var http = createObject();


/* INSERT */
/* -------------------------- */
/* Required: var nocache is a random number to add to request. This value solve an Internet Explorer cache issue */
function show_mission(show_mode) {
	document.getElementById('favorites-button-block-add').style.display = "none";
	document.getElementById('favorites-button-block-delete').style.display = "none";
	document.getElementById('favorites-button-block-loading').style.display = "none";
	
	var loading = "<div class='center'> <img src = 'img/HeartAnimation-3.gif' width=120 height=120> </div>"; // Создание блока с анимацией загрузки
	document.getElementById('show-mission-block').innerHTML = loading;

	var userLogin = window.localStorage.getItem('login');
	http.open('get', 'mission_hard_show.php?show_mode='+show_mode+'&cur_id='+curId+'&typeSetAll='+typeSetAll+'&showSetAll='+showSetAll+'&login='+userLogin,true);
	http.onreadystatechange = insertReply;
	http.send(null);
}
/* --------------------------------------------------------------- */
/* --- Функция получения данных из файла mission_hard_show.php --- */
/* --------------------------------------------------------------- */
function insertReply() {
	if(http.readyState == 4){ 
	var response = http.responseText;
	if (response.length > 0) {
		var i = response.length;
		favorites = response[i-1];
		if (response[i-2] >= '0' && response[i-2] <= '9') {
	var missionId = "";
	var i = response.length;
	while (response[i-2] != "?") {
		missionId = response[i-2] + missionId;
		i = i - 1;
	}
	var k = 0;
	finalResponse = "";
	for (k = 0; k < response.length - missionId.length - 2; k++) {
		finalResponse = finalResponse + response[k];
	}
	curId = missionId;
		}
		else finalResponse = response;
	}
	else finalResponse = response;
	document.getElementById('show-mission-block').innerHTML = finalResponse;
	FavoritesButtonShow();    // Скорректировать вывод кнопки "избранного"
	}
}
/* ----------------------------------------------------------------------------- */
/* --- Функции вывода на экран различных элементов при авторизации и без нее --- */
/* ----------------------------------------------------------------------------- */
 
 /* Функция вывода логина и кнопки вход/выход в header */
function loginShow() {
	var userLogin = window.localStorage.getItem('login');
	if (userLogin != "") {
		document.getElementById('header_autorization_logout').style.display = "none";
		document.getElementById('header_autorization_logon').style.display = "block";
		document.getElementById('header_autorization_logon').insertAdjacentHTML('afterbegin', userLogin);
	}
	else {
		document.getElementById('header_autorization_logout').style.display = "block";
		document.getElementById('header_autorization_logon').style.display = "none";
	}
}

 /* Функция вывода кнопок "следующая" или "выполнено" и "пропустить" в основном окне */
function BasicButtonShow() {
	var userLogin = window.localStorage.getItem('login');
	if (userLogin != "") {
		document.getElementById('button-basic-block_logout').style.display = "none";
		document.getElementById('button-basic-block_logon').style.display = "block";
	}
	else {
		document.getElementById('button-basic-block_logout').style.display = "block";
		document.getElementById('button-basic-block_logon').style.display = "none";
	}
}

 /* Функция вывода кнопок "добавить в избранное" и "удалить из избранного" */
function FavoritesButtonShow() {
	var userLogin = window.localStorage.getItem('login');
	if (userLogin != "") {
		if (favorites == "0" || favorites == "2") {
			document.getElementById('favorites-button-block-add').style.display = "block";
			document.getElementById('favorites-button-block-delete').style.display = "none";
			document.getElementById('favorites-button-block-loading').style.display = "none";
		}
		if (favorites == "1" || favorites == "3") {
			document.getElementById('favorites-button-block-add').style.display = "none";
			document.getElementById('favorites-button-block-delete').style.display = "block";
			document.getElementById('favorites-button-block-loading').style.display = "none";
		}
	}
	else {
		document.getElementById('favorites-button-block-add').style.display = "none";
		document.getElementById('favorites-button-block-delete').style.display = "none";
		document.getElementById('favorites-button-block-loading').style.display = "none";
	}
}

function SettingsShow() {
	var userLogin = window.localStorage.getItem('login');
	if (userLogin != "") {
		document.getElementById('show-settings-login').style.display = "block";
		document.getElementById('show-settings-logout').style.display = "none";
	}
	else {
		document.getElementById('show-settings-login').style.display = "none";
		document.getElementById('show-settings-logout').style.display = "block";
	}
}

// Функции вывода капчи на экран
// Посылка запроса
function captchaShow() {
	http.open('get', "captcha.php?mode=query",false);
	http.onreadystatechange = captchaReply;
	http.send(null);
}

// Обработка ответа и вывод на экран
function captchaReply() {
	if(http.readyState == 4){
		var response = http.responseText;
		var captchaImg = "<img class = 'captcha' src = '" + response + "'>";
		document.getElementById('captcha').innerHTML = captchaImg;
		captchaId = "";
		var i = response.length - 1;
		while (response[i] != "/") {
			captchaId = response[i] + captchaId;
			i = i - 1;
		}
	}
}

// Функции проверки правильности капчи
function captchaCheck() {
	var captchaText = encodeURI(document.getElementById('captchaInput').value);
	http.open('get', "captcha.php?mode=answer&captchaText="+captchaText+"&captchaId="+captchaId,false);
	http.onreadystatechange = captchaCheckReply;
	http.send(null);
}

function captchaCheckReply() {
	if(http.readyState == 4){
		var response = http.responseText;
		captchaApply = response;
	}
}

// Показывает или убирает logo_title в зависимости от разрешения экрана
/*function logoTitleResize() {
	if (innerWidth <= 800) {
		document.getElementById('logo_title').style.display = "none";
	}
	if (innerWidth > 800) {
		document.getElementById('logo_title').style.display = "block";
	}
} */

//window.addEventListener('resize',logoTitleResize);

function contactsForm() {
	var emailContactsForm = encodeURI(document.getElementById('emailContactsForm').value);
	var textContactsForm = encodeURI(document.getElementById('textContactsForm').value);
	if (emailContactsForm == "") {
		document.getElementById('contactsFormResponse').innerHTML = "Пожалуйста, введите адрес вашей электронной почты";
		return;
	}
	if (textContactsForm == "") {
		document.getElementById('contactsFormResponse').innerHTML = "Невозможно отправить пустое сообщение";
		return;
	}
	var loading = "<div class='center'> <img src = 'img/HeartAnimation-3.gif' width=100 height=100> </div>"; // Создание блока с анимацией загрузки
	document.getElementById('contactsFormResponse').innerHTML = loading;
	http.open('get', 'contactsForm.php?email='+emailContactsForm+'&text='+textContactsForm,true);
	http.onreadystatechange = insertReplyContactsForm;
	http.send(null);
}

function insertReplyContactsForm() {
	if(http.readyState == 4){
		var response = http.responseText;
		document.getElementById('contactsFormResponse').innerHTML = response;
	}
	else {
		document.getElementById('contactsFormResponse').innerHTML = "Произошла какая-то ошибка и ваше сообщение не было отправлено. Пожалуйста, попробуйте еще раз или напишите нам на электронную почту.";
	}
		
}