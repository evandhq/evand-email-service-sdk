<?php

declare(strict_types=1);

namespace Evand\Email\EmailSender;

use Evand\Email\Email;
use GuzzleHttp\Client;

class Sender
{
    const RESOURCE_URI = 'https://kaftar.evand.com/api/send-email';

    private $http;

    public function __construct(Client $http)
    {
        $this->http = $http;
    }

    public function send(Email $email)
    {
        $this->http->request('POST', self::RESOURCE_URI, [
            'json' => [
                'subject' => $email->subject,
                'message' => $email->message,
                'recipient' => [
                    'name' => $email->recipient->name,
                    'email' => (string) $email->recipient->email,
                ],
                'tag' => $email->tag,
            ]
        ]);
    }
}
