<?php

namespace App\Support;

class WhatsApp
{
    public static function link(?string $message = null): string
    {
        $number = preg_replace('/\D+/', '', (string) config('showroom.whatsapp'));
        $url = "https://wa.me/{$number}";

        return $message ? $url . '?text=' . rawurlencode($message) : $url;
    }
}