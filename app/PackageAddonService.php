<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PackageAddonService extends Model
{
    //
    protected $fillable   =[
                                'package_id',
                                'addon_service_id',
                                'price',
                                'description',
                                'status'
                            ];
}
