<?php

namespace App\Services;

use Throwable;
use Illuminate\Support\Facades\Http;

class Bitly
{
    // public static function convert($link)
    // {
    //     try {
    //         $response =  Http::accept('application/json')
    //             ->withToken('71a976489caed36b43228223aefcba5240518ee4')
    //             ->post('https://api-ssl.bitly.com/v4/shorten', 
    //                 "domain" => "bit.ly",
    //                 "long_url" => $link,
    //             ]);

    //         $body = $response->json();

    //         return $body['link'];
    //     } catch (Throwable $e) {
    //         return 'invalid url';
    //     }
    // }
}