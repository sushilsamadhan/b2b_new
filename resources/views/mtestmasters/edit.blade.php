@extends('layouts.master')
@include('layouts.include.form.form_css')
@section('content')

    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h3>Create Mock Test Section</h3>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('mtestmasters.update',$mtestmaster->id) }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{$mtestmaster->id}}">
                <div class="container">   
                    <div class="row">
                        <div class="accordion" id="accordionExample" style="width:100% !important;">
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">
                                        <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#collapseOne" style="float: right !important;width: 100%!important;"><i class="fa fa-plus"></i> Masters</button>									
                                    </h2>
                                </div>
                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                        <div class="card-body">
                                            <div class="container">                    
                                                <div class="row">

                                                <div class="form-group col-md-6 p-3">
                                                    <label class="" for="test_type">
                                                        @translate(Test Type) <span class="text-danger">*</span></label>
                                                    <div class="">
                                                        <select class="form-control langr selectpicker" id="test_type" name="test_type">
                                                            <option value=""> @translate(Please Select Test Type)</option>
                                                            <option value="Mock" {{ ($mtestmaster->test_type == 'Mock')?'selected':'' }}>Mock Test</option>
                                                            <option value="Practice" {{ ($mtestmaster->test_type == 'Practice')?'selected':'' }}>Practice Test</option>
                                                            <option value="Sectional" {{ ($mtestmaster->test_type == 'Sectional')?'selected':'' }}>Sectional Test</option>

                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="form-group col-md-6 p-3">
                                                    <label class="" for="test">
                                                        @translate(Test) <span class="text-danger">*</span></label>
                                                    <div class="">
                                                        <select class="form-control langr selectpicker" id="test" name="test">
                                                            <option value=""> @translate(Please Select Test)</option>
                                                            <option value="Chapter" {{ ($mtestmaster->test == 'Chapter')?'selected':'' }}>Chapter</option>
                                                            <option value="Full" {{ ($mtestmaster->test == 'Full')?'selected':'' }}>Full</option>
                                                            <option value="Sectional" {{ ($mtestmaster->test == 'Sectional')?'selected':'' }}>Sectional</option>

                                                        </select>
                                                    </div>
                                                </div>

                                                    <div class="form-group col-md-8">
                                                        <label class="" for="name">@translate(Mock Test Name) <span class="text-danger">*</span></label>
                                                        <div class="">
                                                            <input type="text"  class="form-control langr" placeholder="@translate(Enter Mock Test Name)"  id="name" name="name" value="{{$mtestmaster->name}}">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label class="" for="course_type">
                                                            @translate(Content Type) <span class="text-danger">*</span></label>
                                                        <div class="">
                                                            <select class="form-control langr selectpicker" id="course_type" name="course_type" {{ ($mtestmaster->course_type == 'project_work')?'readonly':'' }}>
                                                                <option value=""> @translate(Please Select Content Type)</option>
                                                                <option value="board" {{ ($mtestmaster->course_type == 'board')?'selected':'' }}>Board</option>
                                                                <option value="competitive-courses" {{ ($mtestmaster->course_type == 'competitive-courses')?'selected':'' }}>Competitive Courses</option>
                                                                <option value="project_work" {{ ($mtestmaster->course_type == 'project_work')?'selected':'' }}>Project Work</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                        {{-- Category --}}
                                                    <div class="form-group col-md-6">
                                                        <label class="" for="val-category_id">
                                                            @translate(Category) <span class="text-danger">*</span></label>
                                                        <div class="">
                                                        <select class="form-control langr @error('category_id') is-invalid @enderror"
                                                                id="val-category_id" name="category_id" {{ ($mtestmaster->course_type == 'project_work')?'readonly':'' }}>
                                                            @foreach ($categories as $category)
                                                                <option
                                                                    value="{{ $category->id }}" {{$mtestmaster->category_id == $category->id ? 'selected':null}}>{{ $category->name }}</option>
                                                            @endforeach
                                                        </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label class="" for="total_no_of_question">@translate(No. Of Question) <span class="text-danger">*</span></label>
                                                        <div class="">
                                                            <input type="number"  class="form-control" placeholder="@translate(Enter No. Of Question)"  id="total_no_of_question" name="total_no_of_question" value="{{$mtestmaster->total_no_of_question}}">
                                                        </div>
                                                    </div>
                                                       <div class="form-group col-md-4 p-3">
                                                           <label class="" for="total_no_of_question">@translate(Total Time)(HH:MM) <span class="text-danger"></span></label>
                                                           <div class="">
                                                              <input type="text"  class="form-control" placeholder="HH:MM"  id="total_time" name="total_time" value="{{$mtestmaster->total_time}}">
                                                            </div>
                                                       </div>


                                                      
                                                    <div class="col form-group">
                                                        <label>Choose Status Type?</label>
                                                        <div class="form-group">
                                                            <label class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="status"
                                                                    value="0" {{ ($mtestmaster->status == '0')?'checked':'' }}>
                                                                <span class="form-check-label"> Draft</span>
                                                            </label>
                                                            <label class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="status"
                                                                    value="1" {{ ($mtestmaster->status == '1')?'checked':'' }}>
                                                                <span class="form-check-label"> Publish</span>
                                                            </label>
                                                            <label class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="status"
                                                                    value="2" {{ ($mtestmaster->status == '2')?'checked':'' }}>
                                                                <span class="form-check-label"> Un-Publish</span>
                                                            </label>
                                                        </div> <!-- form-group end.// -->
                                                    </div> <!-- form-group end.// -->


                                                    <div class="col form-group">
                                                        <label>Choose Available Type?</label>
                                                        <div class="form-group">
                                                            <label class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="available_on"
                                                                    value="0" {{ ($mtestmaster->available_on == '0')?'checked':'' }}>
                                                                <span class="form-check-label"> Free</span>
                                                            </label>
                                                            <label class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="available_on"
                                                                    value="1" {{ ($mtestmaster->available_on == '1')?'checked':'' }}>
                                                                <span class="form-check-label"> Paid</span>
                                                            </label>
                                                        
                                                        </div> <!-- form-group end.// -->
                                                    </div> <!-- form-group end.// -->
                                                </div>
                                            </div><!-- Container end.// -->
                                        </div>
                                    </div>
                                </div>
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h2 class="mb-0">
                                        <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" style="float: right !important;width: 100%!important;"><i class="fa fa-plus"></i>Sections</button>
                                    </h2>
                                </div>
                                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <div class="container">                    
                                            <div class="row">
                                                <div class="form-group col-md-8">
                                                    <label class="" for="section_name">@translate(Section Name) <span class="text-danger"></span></label>
                                                    <div class="">
                                                        <input type="text"  class="form-control langr" placeholder="@translate(Enter Section Name)"  id="section_name" name="section_name" value="{{old('section_name')}}">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label class="" for="no_of_question">@translate(Number of Question) <span class="text-danger"></span></label>
                                                    <div class="">
                                                        <input type="number"  class="form-control langr" placeholder="@translate(Enter Number of Question)"  id="no_of_question" name="no_of_question" value="{{old('no_of_question')}}">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label class="" for="section_time">@translate(Section Time) (HH:MM)<span class="text-danger"></span></label>
                                                    <div class="">
                                                        <input type="text"  class="form-control langr" placeholder="HH:MM"  id="section_time" name="section_time" value="{{old('section_time')}}">
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <label class="" for="question_value">@translate(Per Question Value) <span class="text-danger"></span></label>
                                                    <div class="">
                                                        <input type="text"  class="form-control langr" placeholder="@translate(Enter Section Value)"  id="question_value" name="question_value" value="{{old('question_value')}}">
                                                    </div>
                                                </div>


                                                <div class="form-group col-md-4">
                                                    <label class="" for="question_value">@translate(Negative Marking) <span class="text-danger"></span></label>
                                                    <div class="">
                                                        <input type="text"  class="form-control langr" placeholder="@translate(Enter -Ve Marking Value)"  id="negative_marking_value" name="negative_marking_value" value="{{old('negative_marking_value')}}">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label class="" for="status">@translate(Status) <span class="text-danger"></span></label>
                                                    <div class="">
                                                        <select class="form-control langr selectpicker" id="section_status" name="section_status">
                                                            <option value="">Select Status</option>
                                                            <option value="1" {{ (old('section_status') == '1')?'selected':'' }}>Active</option>
                                                            <option value="0" {{ (old('section_status') == '0')?'selected':'' }}>In-Active</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>  
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">   
                    <div class="row">
                        <div class="col-sm-4 text-center">  
                            <div class="form-group row">
                                <label class="col-md-2 col-form-label" for="example"></label>
                                <div class="col-md-6">
                                    <button type="submit" class="btn waves-effect waves-light btn-primary">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </form>

        
    </div>
    
</div>

<!-- Start:Section List -->
<div class="card m-2">

<div class="card-body">
<div class="contentbar">
        <div class="card m-b-30">
            <h4 class="card-header">@translate(All Sections)</h4>
            <div class="card-body mx-3">
            <table class="table table-striped- table-bordered table-hover text-center">
                            <thead>
                            <tr>
                            <th>S.No.</th>
                            <th>@translate(Section Name)</th>
                            <th>@translate(Est. No. Of Question)</th>
                            <th>@translate(Actual No. Of Question)</th>
                            <th>@translate(Section Time)</th>
                            <th>@translate(Question Value)</th>
                            <th>@translate(-Ve Marking)</th>
                            <th>@translate(Action)</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($mtestsection as  $item)

                            @php  $total = getTotalSectionwiseQuestion($item->id); 
                            
                            $totalSingleCount   = $total->count();
                            $totalPassageCount = 0;
                            if($totalSingleCount>0){

                            foreach($total as $val){
                                $totalPassageCount +=$val->comprehensionq->count();
                            }
                        }
                           // $totalPassageCount = $total[0]->comprehensionq->count();
                            
                            $totalCount = $totalSingleCount + $totalPassageCount;
                            @endphp
                                <tr>
                                    <td>{{$loop->index+1}}</td>
                                    <td>{{$item->section_name}}</td>
                                    <td>{{$item->no_of_question}}</td>
                                    <td>{{$totalCount}}</td>
                                    <td>{{$item->section_time}}</td>
                                    <td>{{$item->question_value}}</td>
                                    <td>{{$item->negative_marking_value}}</td>
                                    <td>{{$item->status =  $item->status == '1' ? 'Active' : 'In-Active'}}</td>
                                    <td>
                                    <div class="kanban-menu">
                                                        <div class="dropdown">
                                                            <button class="btn btn-link p-0 m-0 border-0 l-h-20 font-16" type="button"
                                                                    id="KanbanBoardButton1" data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                                            <div class="dropdown-menu dropdown-menu-right action-btn"
                                                                aria-labelledby="KanbanBoardButton1" x-placement="bottom-end">
                                                                <a class="dropdown-item" href="{{ route('mtestmasters.viewAddedQuestion',$item->id) }}">
                                                                    <i class="feather icon-edit-2 mr-2"></i>@translate(View)</a>
                                                                <a class="dropdown-item" href="{{ route('mtestsections.edit',$item->id) }}">
                                                                    <i class="feather icon-edit-2 mr-2"></i>@translate(Edit)</a>

                                                                <a class="dropdown-item" href="{{ route('mtestquestions.create',$item->id) }}">
                                                                    <i class="feather icon-edit-2 mr-2"></i>@translate(Add Question)</a>    
                                                                <a class="dropdown-item"
                                                                onclick="confirm_modal('{{ route('mtestsections.destroy', $item->id) }}')" href="#!">
                                                                    <i class="feather icon-trash mr-2"></i>@translate(Delete)</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                    </td>
                                </tr>
                            @empty

                                <tr></tr>

                                <tr>
                                    <td colspan="7"><h5 class="text-center">@translate(No Data Found)</h5></td>
                                </tr>
                                <tr></tr>
                                <tr></tr>
                                <tr></tr>

                            @endforelse
                            </tbody>
                        </table>
            </div>  <!-- End List section  -->
            </div>  <!-- End card  -->
            </div>  <!-- End card  -->
@endsection

@section('scripts')

@endsection

<style>
    .bs-example{
        margin: 20px;
    }
    .accordion .fa{
        margin-right: 0.5rem;
    }
</style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $(document).ready(function(){
        // Add minus icon for collapse element which is open by default
        $(".collapse.show").each(function(){
        	$(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus");
        });
        
        // Toggle plus minus icon on show hide of collapse element
        $(".collapse").on('show.bs.collapse', function(){
        	$(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus");
        }).on('hide.bs.collapse', function(){
        	$(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus");
        });
    });
</script>
<script type='text/javascript'>
    $(document).on('change', '#course_type', function(){    
    var course_type = $(this).val();
               
            $.ajax({
                type:'POST',
                url:'{{ route("categoriesByCourseType") }}',
                headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:{'course_type':course_type},
                success: function (response) {                    
                    var optstring = '<option value="">Please Select</option>'+"\r\n";
                    $(response.data).each(function(key,val){
                        if(val.child.length!=0){
                            optstring += '<optgroup Label="'+val.name+'">';
                        }else{
                            optstring += '<option value="'+val.id+'">'+val.name+'</option>'+"\r\n";
                        }
                        
                        if(val.child.length!=0){
                            $(val.child).each(function(key1,val1){
                                optstring += '<option value="'+val1.id+'">'+val1.name+'</option>'+"\r\n";
                            });
                            optstring += '</optgroup>';
                        }
                    });
                    $('#val-category_id').html(optstring);           
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) 
                { 
                    var msg=(JSON.parse(XMLHttpRequest.responseText).message);
                } 
            });
        });
</script>