<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MockTestMaster extends Model
{
    //
    protected $fillable=['test_type','test','name','course_type','category_id','total_no_of_question','total_time','available_on','status'];
    

    public function mockTestSection() {

        return $this->hasMany(MockTestSection::class,'mock_test_master_id','id');
    }
}
