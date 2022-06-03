<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ComprehensionQuestion;
class MockTestSectionQuestion extends Model
{
    //
    protected $fillable = ['mock_test_master_id','mock_test_section_id','student_test_question_id','question_type','status'];

    function comprehensionq()
    {
        return $this->hasMany(ComprehensionQuestion::class,'student_test_question_id','student_test_question_id');
    } 
}
