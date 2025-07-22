<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Job extends Model {

    use HasFactory;

    protected $table ='job_listings';

    protected $guarded = [];

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }


    // eloquent relationship, many jobs can be associated with one tag.
    public function tags()
    {
        return $this->belongsToMany(Tag::class, foreignPivotKey: 'job_listing_id');
    }

}
