<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class MockTestEnrollmentAnswer extends Model
{        
    protected $fillable = ['user_id','mock_test_enrollment_id','package_id','section_id','question_id','answer_id','answer_time','attempt_status','reply_time','question_marks','question_negative_marks','error_type' ,'error_detail'];
}
