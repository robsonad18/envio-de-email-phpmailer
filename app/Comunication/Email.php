<?php

namespace App\Comunication;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;


class Email
{
    const HOST      = 'smtp.gmail.com';

    const USER      = 'seuemail';

    const PASS      = 'suasenha';

    const SECURE    = 'TLS';

    const PORT      = 587;

    const CHARSET   = 'UTF-8';

    const FROM_EMAIL = 'seuemail';
    const FROM_NAME  = 'seunome';

    private string $error;

    public function getError()
    {
        return $this->error;
    }

    public function sendEmail($address, $subject, $body, $attachments = [], $ccs = [], $bcc = [])
    {
        $this->error = '';

        $obMail = new PHPMailer(true);

        try {
            $obMail->isSMTP(true);
            $obMail->Host           = self::HOST;
            $obMail->SMTPAuth       = true;
            $obMail->Username       = self::USER;
            $obMail->Password       = self::PASS;
            $obMail->SMTPSecure     = self::SECURE;
            $obMail->Port           = self::PORT;
            $obMail->CharSet        = self::CHARSET;

            $obMail->setFrom(self::FROM_EMAIL, self::FROM_NAME);

            // ENDEREÇOS
            $address = is_array($address) ? $address : [$address];
            foreach ($address as $key => $value) {
                $obMail->addAddress($value);
            }

            // ANEXOS
            $attachments = is_array($attachments) ?  $attachments : [$attachments];
            foreach ($attachments as $key => $value) {
                $obMail->addAttachment($value);
            }

            // CC
            $ccs = is_array($ccs) ?  $ccs : [$ccs];
            foreach ($ccs as $key => $value) {
                $obMail->addCC($value);
            }

            // BCC
            $bcc = is_array($bcc) ?  $bcc : [$bcc];
            foreach ($bcc as $key => $value) {
                $obMail->addCC($value);
            }

            // CONTEUDO DO EMAIL
            $obMail->isHTML(true);
            $obMail->Subject = $subject;
            $obMail->Body    = $body;

            // ENVIA EMAIL
            return $obMail->send();
        } catch (PHPMailerException $e) {
            $this->error = $e->getMessage();
            return false;
        }
    }
}
