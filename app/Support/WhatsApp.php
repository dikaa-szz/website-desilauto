<?php

namespace App\Support;

class WhatsApp
{
    public static function link(?string $message = null): string
    {
        $number = preg_replace('/\D+/', '', (string) config('showroom.whatsapp'));

        // 0852... menjadi 62852...
        if (str_starts_with($number, '0')) {
            $number = '62' . substr($number, 1);
        }

        $url = "https://wa.me/{$number}";

        return $message ? $url . '?text=' . rawurlencode($message) : $url;
    }
}