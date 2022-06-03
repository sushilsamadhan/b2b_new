<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PwCourse extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];



    /*Check the course is published*/
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }


    /*Check the course is published*/
    public function scopeNotFree($query)
    {
        return $query->where('is_free', false);
    }

    // relationBetweenCategory
    public function relationBetweenCategory()
    {
        return $this->belongsTo(PwCategory::class, 'category_id', 'id');
    }

    // relationBetweenLanguage
    public function relationBetweenLanguage()
    {
        return $this->hasOne(Language::class, 'id', 'language');
    }

    public function relationBetweenInstructorUser()
    {

        return $this->belongsTo(User::class, 'user_id', 'id')->where('user_type', 'Instructor');
    }

    // classes
    public function classes()
    {
        return $this->hasMany(PwClasses::class, 'course_id', 'id')
            ->where('is_published', true)
            ->with('contents');
    }

    public function classesAll()
    {
        return $this->hasMany(PwClasses::class, 'course_id', 'id')->orderBy('priority','asc')
            ->with('contentsAll');
    }

    //enroll
    public function enrollClasses()
    {
        return $this->hasMany(PwClasses::class, 'course_id', 'id')
            ->where('is_published', true)
            ->with('enrollContents');
    }

    // category
    public function category()
    {
        return $this->belongsTo(PwCategory::class, 'category_id', 'id');
    }

    // enrollment
    public function enrollment()
    {
        return $this->belongsTo(PwEnrollment::class)->where('project_work_id', 'id');
    }

    // meeting
    public function meeting()
    {
    	return $this->hasOne('App\Meeting','course_id','id');
    }

    // subscription
    public function subscription()
    {
    	return $this->hasOne('App\SubscriptionCourse','course_id','id');
    }

    //webinar association
    public function webinar()
    {
        return $this->hasMany(PwWebinar::class, 'project_work_id', 'id')
            ->where('status', 1);
    }

    //mentor
    public function mentor()
    {
        return $this->belongsTo(Mentor::class, 'mentor_id', 'id');
    }
    //END
}
