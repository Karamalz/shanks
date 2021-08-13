<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Astro extends Model
{
    protected $fillable = [
        'date', 'astro_name', 'type', 'score',
        'img_url', 'score_text', 'content'
    ];
}
