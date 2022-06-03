<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UrlPermission extends Model
{
    protected $guarded  = ['id'];
    protected $table    = "url_permissions";
    protected $fillable = ['user_id','site_url'];
}
