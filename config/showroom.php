<?php

return [
    'name' => env('APP_NAME', 'Showroom'),
    'whatsapp' => env('SHOWROOM_WHATSAPP'),
    'admin_emails' => array_filter(explode(',', env('ADMIN_EMAILS', ''))),

    /*
    | Daftar outlet. Index 0 = outlet utama (dipakai peta embed).
    */
    'outlets' => [
        [
            'name' => 'Paskah Mobil Serpong',
            'address' => [
                'Belakang Rumah Sakit Bethsaida',
                'Bursa Mobil Paramount, BEZ Auto Centre Blok A No. 7',
                'Gading Serpong, Tangerang',
            ],
            'plus_code' => 'PJVF+QQ',
            'map_query' => '-6.2555661,106.6244215',
            'place_url' => env('SHOWROOM_MAPS_PLACE_URL'),
            'map_embed_url' => env('SHOWROOM_MAP_EMBED_URL'),
        ],
        [
            'name' => 'Paskah Mobil Mangga Dua',
            'address' => [
                'Mall Mangga Dua Square, Lantai LG Lot M 15 & M 16',
                'Jl. Gunung Sahari Raya No.1, Lot M 15–16',
                'RT.11/RW.6, Ancol, Kec. Pademangan',
                'Jakarta Utara, DKI Jakarta 14420',
            ],
            'plus_code' => null,
            // Koordinat Mall Mangga Dua Square (perkiraan pusat mall)
            'map_query' => '-6.1385,106.8400',
            'place_url' => 'https://www.google.com/maps/search/?api=1&query=Mall+Mangga+Dua+Square',
            'map_embed_url' => null,
        ],
    ],

    /*
    | Backward-compatible: outlet utama (index 0)
    | Tetap dipakai oleh Maps.php & kode lama.
    */
    'outlet' => [
        'name' => 'Paskah Mobil Serpong',
        'address' => [
            'Belakang Rumah Sakit Bethsaida',
            'Bursa Mobil Paramount, BEZ Auto Centre Blok A No. 7',
            'Gading Serpong, Tangerang',
        ],
        'plus_code' => 'PJVF+QQ',
        'map_query' => '-6.2555661,106.6244215',
        'place_url' => env('SHOWROOM_MAPS_PLACE_URL'),
        'map_embed_url' => env('SHOWROOM_MAP_EMBED_URL'),
    ],
];