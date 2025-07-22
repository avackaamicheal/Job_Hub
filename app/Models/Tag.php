<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;

    // Eloquent relatioship between job and tag
    public function jobs()
    {
        return $this->belongsToMany(Job::class, relatedPivotKey:'job_listing_id');
    }
}
