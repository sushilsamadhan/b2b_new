@extends('layouts.master')
@section('title','Instructor List')
@section('parentPageTitle', 'All Student')
@section('content')
<div class="card mx-2 mb-3">
    <div class="card-header">
        <div class="float-left">
            <h3>@translate(Change Instructor Course Access)</h3>
        </div>
        {{--
        <div class="float-right">
            <div class="row">
                <div class="col">
                    <form method="get" action="">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control col-12" placeholder="@translate(Search by name)" value="{{Request::get('search')}}">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    @translate(Search)</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        --}}
    </div>

    <div class="card-body table-responsive">
            <form class="form-validate" action="{{ route('instructor.course.update')}}" method="post"
                    enctype="multipart/form-data">
                @csrf
               
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label" for="course">
                        @translate(Select Course) <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <select class="form-control langr selectpicker" id="course" name="course" autofocus required>
                            <option value="" class="mb-2">
                            @translate(Please select Course)</option>
                            @foreach($courses as $course)
                            @php
                                $parent_id = $course->relationBetweenCategory->parent_category_id;
                                $parentCategoryName = '';
                                $categoryDetail1 = \App\Model\Category::find($course->category_id);
                                $categoryName = $categoryDetail1->name;
                                if($parent_id!='0'){
                                    $categoryDetail = \App\Model\Category::find($parent_id);
                                    $parentCategoryName = $categoryDetail->name??'';
                                    
                                    if(isset($categoryDetail) && $categoryDetail->is_compitative=='1'){
                                        $categoryName = 'Competitive';
                                    }elseif(isset($categoryDetail) && $categoryDetail->is_free_study=='1'){
                                        $categoryName = 'Free Study Material';
                                    }elseif(isset($categoryDetail) && $categoryDetail->is_current_affairs=='1'){
                                        $categoryName = 'Current Affairs';
                                    }elseif(isset($categoryDetail) && $categoryDetail->is_project_works=='1'){
                                        $categoryName = 'Project Works';
                                    }
                                }
                            @endphp
                                <option value="{{$course->id}}"> 
                                    {{ ($parentCategoryName!='')?$parentCategoryName.'/':''}}
                                    {{ ($categoryName!='')?$categoryName.'/':''}}
                                    {{$course->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-lg-3 col-form-label" for="instructor">
                        @translate(Select Instructor) <span class="text-danger">*</span></label>
                    <div class="col-lg-9">
                        <select class="form-control langr selectpicker" id="instructor" name="instructor" required>
                            <option value="" class="mb-2">
                            @translate(Please select Instructor)</option>
                            @foreach($instructors as $instructor)
                                <option value="{{$instructor->user_id}}">{{$instructor->name??'None'}}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="form-group row">
                    <label class="col-lg-3 col-form-label"></label>
                    <div class="col-lg-8">
                        <button type="submit" class="btn btn-primary">
                            @translate(Submit)
                        </button>
                    </div>
                </div>

                
            </form> 

            <div class="table-responsive">
                <table class="table foo-filtering-table text-center">
                    <thead class="text-center">
                    <tr class="footable-header">
                        <th data-breakpoints="xs" class="footable-first-visible">
                            @translate(S/L)
                        </th>
                        <th>
                            @translate(Corse Title)
                        </th>
                        <th>
                            @translate(Instructor Name)
                        </th>
                    </tr>
                    @forelse ($courses as $course)
                    @php
                        $parent_id = $course->relationBetweenCategory->parent_category_id;
                        $parentCategoryName = '';
                        $categoryDetail1 = \App\Model\Category::find($course->category_id);
                        $categoryName = $categoryDetail1->name;
                        if($parent_id!='0'){
                            $categoryDetail = \App\Model\Category::find($parent_id);
                            $parentCategoryName = $categoryDetail->name??'';
                            
                            if(isset($categoryDetail) && $categoryDetail->is_compitative=='1'){
                                $categoryName = 'Competitive';
                            }elseif(isset($categoryDetail) && $categoryDetail->is_free_study=='1'){
                                $categoryName = 'Free Study Material';
                            }elseif(isset($categoryDetail) && $categoryDetail->is_current_affairs=='1'){
                                $categoryName = 'Current Affairs';
                            }elseif(isset($categoryDetail) && $categoryDetail->is_project_works=='1'){
                                $categoryName = 'Project Works';
                            }
                        }
                    @endphp
                    <tr>
                        <td class="footable-first-visible">
                            {{ ($loop->index+1)}}
                        </td>
                        <td class="footable-first-visible">
                        <span class="badge badge-info">{{ ($parentCategoryName!='')?$parentCategoryName.'/':''}}
                        {{ ($categoryName!='')?$categoryName.'/':''}}</span>
                        {{$course->title }}
                        </td>
                        <td class="footable-first-visible">
                            <?php $user = \App\User::find($course->user_id);?>
                            {{$user->name??'none'}}
                        </td>
                    </tr>
                                
                    @empty
                    @endforelse
                    
            </div>
    </div>
</div>

@endsection
