<?php

namespace App\Services;

use App\Dto\SendEmailDTO;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;
use Exception;

/**
 * Serviço de envio de email
 */
class EmailService
{
    private string $host        = "";

    private string $user        = "";

    private string $password    = "";

    private string $secure      = "";

    private int $port           = 0;

    private string $charset     = "";

    private string $fromEmail   = "";

    private string $fromName    = "";


    public function __construct()
    {
        $this->host = "smtp.gmail.com";
        $this->user = "";
        $this->password = "";
        $this->secure = "TLS";
        $this->port = 587;
        $this->charset = "UTF-8";
        $this->fromEmail = "";
    }


    /**
     * Envia o email
     *
     * @param SendEmailDTO $obj
     * @return bool
     */
    public function send(SendEmailDTO $obj): bool
    {
        $obMail = new PHPMailer(true);

        try {
            $obMail->isSMTP(true);
            $obMail->Host           = $this->host;
            $obMail->SMTPAuth       = true;
            $obMail->Username       = $this->user;
            $obMail->Password       = $this->password;
            $obMail->SMTPSecure     = $this->secure;
            $obMail->Port           = $this->port;
            $obMail->CharSet        = $this->charset;

            $obMail->setFrom($this->fromEmail, $this->fromName);

            foreach ($obj->address as $value) {
                $obMail->addAddress($value);
            }

            foreach ($obj->attachments as $value) {
                $obMail->addAttachment($value);
            }

            foreach ($obj->ccs as $value) {
                $obMail->addCC($value);
            }

            foreach ($obj->bcc as $value) {
                $obMail->addCC($value);
            }

            $obMail->isHTML(true);
            $obMail->Subject = $obj->subject;
            $obMail->Body    = $obj->body;

            return $obMail->send();
        } catch (PHPMailerException $ex) {
            echo $ex->getMessage();
        }
    }
}
