<?php session_start();
if (file_exists('kernel/kernel.php')){
	require __DIR__ . '/kernel/app.php';
	run();
}
else{
	echo 'FATÁLNÍ CHYBA: Jádro systému nebylo nalezeno. Pro více informací kontaktujte správce systému.';
}