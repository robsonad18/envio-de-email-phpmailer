<?php

namespace App\Dto;

final class SendEmailDTO
{
    public array $address      = [];

    public string $subject     = "";

    public string $body        = "";

    public ?array $attachments = [];

    public ?array $ccs         = [];

    public ?array $bcc         = [];
}
