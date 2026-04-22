<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PillarInformation extends Model
{
    use HasFactory;

   protected $fillable = [
    'category_id',
    'plan_number',
    'plan_document', 
    'name',        
    'unit',
    'location',
    'survey',
    'pillar_number',
    'eastings',
    'northings',
    'origin',
    'height',
    'remarks',
];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}