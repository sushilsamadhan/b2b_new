<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class MockTestSection extends Model
{
    //
    protected $fillable = ['mock_test_master_id','section_name','no_of_question','section_time','question_value','negative_marking_value','status'];

}
