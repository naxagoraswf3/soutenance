<?php

if (!class_exists('CaptchaConfiguration')) {return;}

// BotDetect PHP Captcha configuration options
return [
	// Captcha configuration for example form
	'ValidationForm' => [
		'UserInputID' => 'captchaCode',
		'ImageWidth' => 250,
		'ImageHeight' => 50,
	],
];//Je définis la taille de l'image du capthca et son ID