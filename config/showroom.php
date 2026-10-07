<?php

return [
    'name' => env('APP_NAME', 'Showroom'),
    'whatsapp' => env('SHOWROOM_WHATSAPP'),
    'address' => env('SHOWROOM_ADDRESS', 'Paskah Mobil Bez Auto Center A7, Gading, serpong, Kabupaten Tangerang, Banten 15810'),
    'admin_emails' => array_filter(explode(',', env('ADMIN_EMAILS', ''))),
];