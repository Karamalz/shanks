<?php

namespace App\Repositories;

use App\Astro;

class AstroRepository
{
    public function createAstro($astroContent)
    {
        Astro::updateOrCreate([
            'date' => $astroContent['date'],
            'astro_name' => $astroContent['astro_name'],
            'type' => $astroContent['type'],
        ], $astroContent);
    }
}
