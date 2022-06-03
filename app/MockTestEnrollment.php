<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class MockTestEnrollment extends Model
{
     //
     protected $fillable=['user_id','package_id','mock_test_id','unit_id','chapter_id','mock_test_details','mock_test_duration','test_taken_time','correct_answer','wrong_answer','running_status','test_status','test_type','mock_test_lang','terms_conditions'];
    
     
     public function MockTestEnrollmentAnswer() {

          return $this->hasMany(MockTestEnrollmentAnswer::class,'mock_test_enrollment_id','id');
      }
}
