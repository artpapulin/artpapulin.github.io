<?php

	if (isset($_POST['name']) && $_POST['name'] != "")
		$name = $_POST['name'];
	else die ("Не заполнено поле \"Имя\"");

	if (isset($_POST['email']) && $_POST['email'] != "")
		$email = $_POST['email'];
	else die ("Не заполнено поле \"Email\"");

	if (isset($_POST['message']) && $_POST['message'] != "") 
		$message = $_POST['message'];
	else die ("Не заполнено поле \"Сообщение\"");


$to = 'artur.metkov@mail.ru';
$header ='Website User';

$mes = "Имя: $name \nE-mail: $email \nТекст: $message";
// Если нужно, чтобы письма всё время уходили на ваш адрес — замените первую переменную $email на свой адрес электронной почты
$send = mail($to, $header, $mes, "Content-type:text/plain; charset = UTF-8\r\nFrom:$email");

if ($send == 'true') {echo "Сообщение отправлено";}

else {echo "Ой, что-то пошло не так";}





?>
