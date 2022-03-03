<?php

require __DIR__ . '/vendor/autoload.php';

use App\Dto\SendEmailDTO;
use App\Services\EmailService;

new class
{
    public function __construct()
    {
        try {
            $sendEmailDTO = new SendEmailDTO();
            $sendEmailDTO->address = "seuemail";
            $sendEmailDTO->subject = "Olá mundo";
            $sendEmailDTO->body = "<strong>E-mail de teste</strong>";

            if ((new EmailService())->send($sendEmailDTO)) {
                echo "E-mail enviado com sucesso";
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
};
