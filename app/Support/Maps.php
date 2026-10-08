<?php

namespace App\Support;

class Maps
{
    /** Koordinat lat,lng (tanpa zoom). */
    public static function query(): string
    {
        return (string) config('showroom.outlet.map_query');
    }

    /** Plus Code outlet. */
    public static function plusCode(): string
    {
        return (string) config('showroom.outlet.plus_code');
    }

    /** Tautan buka lokasi di Google Maps. */
    public static function searchUrl(): string
    {
        $place = config('showroom.outlet.place_url');

        if ($place) {
            return $place;
        }

        return 'https://www.google.com/maps/search/?' . http_build_query([
            'api' => 1,
            'query' => self::query(),
        ]);
    }

    /** Tautan petunjuk arah. */
    public static function directionsUrl(): string
    {
        return 'https://www.google.com/maps/dir/?' . http_build_query([
            'api' => 1,
            'destination' => self::query(),
        ]);
    }

    /**
     * Sumber iframe peta.
     * Prioritas: map_embed_url dari .env → fallback koordinat + zoom.
     */
    public static function embedUrl(): string
    {
        $embed = config('showroom.outlet.map_embed_url');

        if ($embed) {
            return $embed;
        }

        // Fallback yang stabil (lat,lng + zoom 17)
        return 'https://maps.google.com/maps?' . http_build_query([
            'q' => self::query(),
            'hl' => 'id',
            'z' => 17,
            'output' => 'embed',
        ]);
    }
}