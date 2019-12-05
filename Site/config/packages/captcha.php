<?php
// app/config/packages/captcha.php
if (!class_exists('CaptchaConfiguration')) {return;}

// BotDetect PHP Captcha configuration options
return [
	// Captcha configuration for example form
	'ValidationForm' => [
		'UserInputID' => 'captchaCode',
		'ImageWidth' => 250,
		'ImageHeight' => 50,
	],

	'formCaptcha' => [
		'UserInputID' => 'captchaCode',
		'ImageWidth' => 150,
		'ImageHeight' => 50,
	],

];