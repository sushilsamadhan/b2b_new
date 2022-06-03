<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobsData extends Model
{

    protected $table='jobs_datas'; 
    protected $fillable = [
        'title',
        'short_discription',
        'discription',
        'source_url',
        'image',
        'catagry_ids',
        'type',
        'status',
        
    ];
}
