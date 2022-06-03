<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    protected $table = "agents";
    protected $fillable = ['agent_name','agent_contact_array','agent_code','access_key','status'];
    
}
