<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    public static function send(array $array)
    {

        $to = $array[0];
        $subject = $array[1];
        $message = $array[2];
        $headers = 'From: ' . $array[3] . "\r\n" .
        'Reply-To: ' . $array[0] . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);

        return 'true';
    }
}
