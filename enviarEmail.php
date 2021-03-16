<?php

require __DIR__ . '/vendor/autoload.php';

use App\Comunication\Email;

$address = 'seuemail';
$subject = 'Ola mundo';
$body    = '<b>Ola mundo</b>';

$obMail = new Email;

$sucesso = $obMail->sendEmail($address, $subject, $body);

echo $sucesso ? 'Enviada com sucesso!' : $obMail->getError();
