<?php

	require_once('phpmailer/PHPMailerAutoload.php');
	$mail = new PHPMailer;
	$mail->CharSet = 'utf-8';

	$mail->isSMTP();                               
	$mail->Host = 'smtp.mail.ru';
	$mail->SMTPAuth = true;                               
	$mail->Username = 'artur-arturov-71@mail.ru';
	$mail->Password = 'nbuhYKwy7XgXAXjduu3F'; 
	$mail->SMTPSecure = 'ssl';
	$mail->Port = 465; 

	function reCaptcha($recaptcha){
  	$secret = "SECRET";
  	$ip = $_SERVER['REMOTE_ADDR'];

	$postvars = array("secret"=>$secret, "response"=>$recaptcha, "remoteip"=>$ip);
	$url = "https://www.google.com/recaptcha/api/siteverify";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_TIMEOUT, 10);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postvars);
	$data = curl_exec($ch);
	curl_close($ch);

  return json_decode($data, true);
}

	if (isset($_POST['name']) && $_POST['name'] != "")
		$name = $_POST['name'];
	else die ("Не заполнено поле \"Имя\"");

	if (isset($_POST['email']) && $_POST['email'] != "")
		$email = $_POST['email'];
	else die ("Не заполнено поле \"Email\"");

	if (isset($_POST['message']) && $_POST['message'] != "") 
		$message = $_POST['message'];
	else die ("Не заполнено поле \"Сообщение\"");

	$recaptcha = $_POST['g-recaptcha-response'];
	$res = reCaptcha($recaptcha);
	if($res['success']){
		$mail->setFrom('artur-arturov-71@mail.ru'); 
		$mail->addAddress('art.papulin@gmail.com');    

		$mail->isHTML(true);                            

		$mail->Subject = 'CONTACT FORM [artpapulin.github.io]';
		$mail->Body    = 'Name: ' .$name . '<br>E-mail: ' .$email. '<br>Message: ' .$message;
		$mail->AltBody = '';

		if(!$mail->send()) {
		    echo 'Error';
		} else {
		    echo 'Success';
		}
	}else{
	  die ("Нет капчи \"Сообщение\"");
	}









?>