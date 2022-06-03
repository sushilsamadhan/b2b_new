@extends('layouts.master')
@include('layouts.include.form.form_js')

@section('content')

    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h3>Create Package Setting</h3>
            </div>
            
        </div>

        <div class="card-body">
            <form action="{{ route('packagesettings.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                 
                <div class="container">   
                    <div class="row">
                    <div class="form-group col-md-7 p-3">
                            <label class="" for="pkg_name">
                                @translate(Package Name) <span class="text-danger">*</span></label>
                                <div class="bootstrap-tagsinput">
                                    <input type="text"  class="form-control langr" placeholder="@translate(Enter Package Name)"  id="pkg_name" name="pkg_name" value="{{old('pkg_name')}}">
                                </div>
                        </div>
                       <!-- 
                        <div class="form-group col-md-4 p-3">
                            <label class="" for="pkg_image">
                                @translate(Package Image) <span class="text-danger"></span></label>
                                <div class="bootstrap-tagsinput">
                                    <input type="file"  class="form-control langr" placeholder="@translate(Select Package Image)"  id="pkg_image" name="pkg_image" value="{{old('pkg_image')}}">
                                </div>
                        </div> -->
                    <div class="form-group col-md-4 p-3">
                            <label class="" for="package_type">
                                @translate(Content Type) <span class="text-danger">*</span></label>
                            <div class="">
                                <select class="form-control langr selectpicker" id="package_type" name="package_type">
                                    <option value=""> @translate(Please Select Content Type)</option>
                                    <option value="board" {{ (old('package_type') == 'board')?'selected':'' }}>Board</option>
                                    <option value="competitive-courses" {{ (old('package_type') == 'competitive-courses')?'selected':'' }}>Competitive Courses</option>
                                </select>
                            </div>
                    </div>
                        {{-- Category --}}
                        <div class="form-group col-md-4 p-3">
                            <label class="" for="val-category_id">@translate(Board/Exam) <span class="text-danger">*</span></label>
                            <div class="">
                                <select class="form-control langr @error('category_id') is-invalid @enderror"
                                        id="val-category_id" name="category_id">
                                        <option value=""> @translate(Please Select)</option>
                                </select>
                            </div>
                    </div>   


                    {{-- Sub Category --}}
                        <div class="form-group col-md-4 p-3" id="sub_category_id_display">
                            <label class="" for="val-sub_category_id">@translate(Class) <span class="text-danger">*</span></label>
                            <div class="">
                                <select class="form-control langr @error('sub_category_id') is-invalid @enderror"
                                        id="val-sub_category_id" name="sub_category_id">
                                        <option value=""> @translate(Please Select Classes)</option>
                                </select>
                            </div>
                    </div>
                    
                    {{-- Subjects --}}
                        <div class="form-group col-md-4 p-3" id="board_view">
                            <label class="" for="val-course_id">@translate(Subject) <span class="text-danger"></span></label>
                            <div class="">
                                <select class="form-control langr @error('course_id') is-invalid @enderror"
                                        id="val-course_id" name="course_id">
                                        <option value=""> @translate(Please Select Subject)</option>
                                </select>
                            </div>
                    </div>

                    <div class="form-group col-md-4 p-3">
                            <label class="" for="quarterly_course_coverage">
                                @translate(Quarterly Course Coverage)(%) <span class="text-danger"></span></label>
                                <div class="bootstrap-tagsinput">
                                    <input type="number"  class="form-control langr" placeholder="@translate(Enter Quarterly Course Coverage(%))"  id="quarterly_course_coverage" name="quarterly_course_coverage" value="{{old('quarterly_course_coverage')}}">
                                </div>
                        </div>
                        <div class="form-group col-md-4 p-3">
                            <label class="" for="halfyrly_course_coverage">
                                @translate(Half Yearly Course Coverage)(%) <span class="text-danger"></span></label>
                                <div class="bootstrap-tagsinput">
                                    <input type="number"  class="form-control langr" placeholder="@translate(Enter Half Yearly Course Coverage(%))"  id="halfyrly_course_coverage" name="halfyrly_course_coverage" value="{{old('halfyrly_course_coverage')}}">
                                </div>
                        </div>

                        <div class="form-group col-md-4 p-3">
                            <label class="" for="annually_course_coverage">
                                @translate(Annually Course Coverage)(%) <span class="text-danger"></span></label>
                                <div class="bootstrap-tagsinput">
                                    <input type="number"  class="form-control langr" placeholder="@translate(Enter Annually Course Coverage(%))"  id="annually_course_coverage" name="annually_course_coverage" value="100">
                                </div>
                        </div>

                        <div class="form-group col-md-4 p-3">
                            <label class="" for="quarterly_coverage_price">
                                @translate(Quarterly Coverage Price) <span class="text-danger"></span></label>
                                <div class="bootstrap-tagsinput">
                                    <input type="number"  class="form-control langr" placeholder="@translate(Enter Quarterly Coverage Price)"  id="quarterly_coverage_price" name="quarterly_coverage_price" value="{{old('quarterly_coverage_price')}}">
                                </div>
                        </div>
                        <div class="form-group col-md-4 p-3">
                            <label class="" for="halfyrly_coverage_price">
                                @translate(Half Yearly Coverage Price) <span class="text-danger"></span></label>
                                <div class="bootstrap-tagsinput">
                                    <input type="number"  class="form-control langr" placeholder="@translate(Enter Half Yearly Coverage Price)"  id="halfyrly_coverage_price" name="halfyrly_coverage_price" value="{{old('halfyrly_coverage_price')}}">
                                </div>
                        </div>
                        <div class="form-group col-md-4 p-3">
                            <label class="" for="annually_coverage_price">
                                @translate(Annullay Coverage Price) <span class="text-danger"></span></label>
                                <div class="bootstrap-tagsinput">
                                    <input type="number"  class="form-control langr" placeholder="@translate(Enter Annullay Coverage Price)"  id="annually_coverage_price" name="annually_coverage_price" value="{{old('annually_coverage_price')}}">
                                </div>
                        </div>
                        <div class="form-group col-md-4 p-3">
                            <label class="" for="default_discount">
                                @translate(Default Discount)(%) <span class="text-danger"></span></label>
                                <div class="bootstrap-tagsinput">
                                    <input type="number"  class="form-control langr" placeholder="@translate(Enter Default Discount)"  id="default_discount" name="default_discount" value="{{old('default_discount')}}">
                                </div>
                        </div>
                        
                        <div class="form-group col-md-4 p-3">
                            <label class="" for="annually_coverage_price">
                                @translate(Member Discount)(%) <span class="text-danger"></span></label>
                                <div class="bootstrap-tagsinput">
                                    <input type="number"  class="form-control langr" placeholder="@translate(Enter Member Discount)"  id="member_discount" name="member_discount" value="{{old('member_discount')}}">
                                </div>
                        </div>
                        <div class="form-group col-md-4 p-3">&nbsp;</div>   
                        <div class="form-group col-md-4 p-3"  id="chapter">
                            <label class="" for="annually_coverage_price">
                                @translate(Number Of Chapter Test) <span class="text-danger"></span></label>
                                <div class="bootstrap-tagsinput">
                                    <input type="number"  class="form-control langr" title="@translate(Enter Number Of Chapter Test for competitive.)" placeholder="@translate(Enter Number Of Chapter Test for competitive.)"  id="no_of_test" name="no_of_test" value="{{old('no_of_test')}}">
                                </div>
                        </div>

                        <div class="form-group col-md-4 p-3" id="unit">
                            <label class="" for="no_of_practice_test">
                                @translate(Number Of Unit Test) <span class="text-danger"></span></label>
                                <div class="bootstrap-tagsinput">
                                    <input type="number"  class="form-control langr" title="@translate(Enter Number Of Unit Test for k-12)" placeholder="@translate(Enter Number Of Unit Test for k-12)"  id="no_of_practice_test" name="no_of_practice_test" value="{{old('no_of_practice_test')}}">
                                </div>
                        </div>

                        <div class="form-group col-md-4 p-3">
                            <label class="" for="no_of_sectional_test">
                                @translate(Number Of Subject Test) <span class="text-danger"></span></label>
                                <div class="bootstrap-tagsinput">
                                    <input type="number"  class="form-control langr" title="@translate(Enter Number Of Subject Test for competitive and k-12)" placeholder="@translate(Enter Number Of Subject Test for competitive and k-12)"  id="no_of_sectional_test" name="no_of_sectional_test" value="{{old('no_of_sectional_test')}}">
                                </div>
                        </div>
                        <div class="form-group col-md-4 p-3">
                            <label class="" for="no_of_test_questions">
                                @translate(Number Of Test Questions) <span class="text-danger">*</span></label>
                                <div class="bootstrap-tagsinput">
                                    <input type="number"  class="form-control langr" placeholder="@translate(Enter Number Of Test question for K-12 segment else 0)"  id="no_of_test_questions" name="no_of_test_questions" value="{{ (old('no_of_test_questions') == '0')?'0':old('no_of_test_questions') }}">
                                </div>
                        </div>
                        <div class="form-group col-md-4 p-3">
                            <label>Choose Status?<span class="text-danger">*</span></label>
                            <div class="form-group">
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status"
                                        value="0" {{ (old('status') == '0')?'checked':'' }}>
                                    <span class="form-check-label">In-Active</span>
                                </label>
                                <label class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="status"
                                        value="1" {{ (old('status') == '1')?'checked':'' }}>
                                    <span class="form-check-label"> Active</span>
                                </label>
                                
                            </div> <!-- form-group end.// -->
                        </div> <!-- form-group end.// -->



                        

                        {{-- Course Thumbnail --}}
                            <div class="form-group  col-md-5 p-3">
                                <label class="col-lg-5 col-form-label" for="val-img">
                                    @translate(Package Image) <span class="text-danger"></span></label>
                                <div class="col-lg-9">
                                    <input type="hidden" required value="{{ old('pkg_image') }}" class="form-control course_image @error('pkg_image') is-invalid @enderror" id="val-img" name="pkg_image">
                                    <img class="w-100 course_thumb_preview rounded shadow-sm d-none" src="" alt="#Course thumbnail">
                                    @error('image') <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span> @enderror

                                    <input type="hidden" name="course_thumb_url" class="course_thumb_url" value="">
                                    <br>

                                    @if (MediaActive())
                                    {{-- media --}}
                                    <a href="javascript:void()" onclick="openNav('{{ route('media.slide') }}', 'thumbnail')" class="btn btn-primary media-btn mt-2 p-2">Upload From Media <i class="fa fa-cloud-upload ml-2" aria-hidden="true"></i> </a>
                                    @endif
                                </div>
                            </div>

                            
                            <div class="form-group col-md-7 p-3">
                            <label class="" for="addon_service_id">
                                @translate(Add On Services) <span class="text-danger"></span></label>
                                <div class="bootstrap-tagsinput">
                                    <select class="form-control" id="addon_service_id" name="addon_service_id[]" size="5" multiple="multiple" onChange="addOnServices(this.value)">
                                        <option value="err"> @translate(Use Ctrl To Choose Multiple Service)</option>
                                            @foreach($service as $serviceVal)

                                                <option value="{{$serviceVal->id.'__'.$serviceVal->price}}">{{$serviceVal->service_name}} - &#x20B9;{{round($serviceVal->price,2)}}</option>

                                            @endforeach
                                    </select>                                
                                </div>
                    <div class="row">
                        <div class="form-group col-md-12 p-3">
                        <a href="javascript:void(0)" class="btn btn-info" onclick="addOnServices(this.value)">Calculate</a>
                        <table class="table table-success table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Duration</th>
                                    <th scope="col">Non-Member Price</th>
                                    <th scope="col">Member Price</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                         
                                <tr>
                                    <td scope="row">QTR</td>
                                    <td scope="row" id="qtr_non"></td>
                                    <td scope="row" id="qtr_mem"></td>
                                </tr>
                                <tr>
                                    <td scope="row">HLF</td>
                                    <td scope="row" id="half_non"></td>
                                    <td scope="row" id="half_mem"></td>
                                </tr>
                                <tr>
                                    <td scope="row">YRL</td>
                                    <td scope="row" id="yr_non"></td>
                                    <td scope="row" id="yr_mem"></td>
                                </tr>
                                   
                            <tbody>
                        </table> 
                        </div>
                        </div></div>
                        <div class="form-group col-md-4 p-3" id="free_view_subject">
                                <label class="" for="val-free_subject">@translate(Free Subject) <span class="text-danger"></span></label>
                                <div class="">
                                    <select class="form-control langr @error('free_subject') is-invalid @enderror"
                                            id="val-free_subject" name="free_subject[]" row="5" multiple>
                                            <option value=""> @translate(Please Select Free Subject)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-8 p-3">
                                <label class="" for="val-free_subject">@translate(Coverage) <span class="text-danger"></span></label>
                                <div class="">
                                   <!-- Coverage will be ramain in the paid subject in the package. However selection of subject not applicable.-->
                                   The coverage of paid subjects will be there in the package. However, the subject selection is not applicable.
                                </div>
                            </div>
                        <div class="form-group col-md-12 p-3">
                            <label class="" for="short_desc">
                                @translate(Short Description) </label>
                                <div class="">
                                    <textarea class="form-control langr" placeholder="@translate(Enter Package Short Description)"  id="short_desc" name="short_desc">{{old('short_desc')}}</textarea>
                                </div>
                        </div> 
                        <div class="form-group col-md-12 p-3">
                            <label class="" for="pkg_desc">
                                @translate(Description) <span class="text-danger"></span></label>
                                <div class="bootstrap-tagsinput">
                                    <textarea class="form-control langr" placeholder="@translate(Enter Package Description)"  id="pkg_desc" name="pkg_desc" value="{{old('pkg_desc')}}"></textarea>
                                </div>
                        </div> 
                        
                        </div>
                                        <div class="col-sm-12 text-center">  
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label" for="example"></label>
                                                <div class="col-md-6">
                                                    <button type="submit" class="btn waves-effect waves-light btn-primary">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

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
    $(document).on('change', '#package_type', function(){    
    var course_type = $(this).val();
    //alert(course_type);
               
            $.ajax({
                type:'POST',
                url:'{{ route("categoriesByCourseType") }}',
                headers : {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data:{'course_type':course_type},
                success: function (response) {                    
                    var optstring = '<option value="">Please Select</option>'+"\r\n";
                    $(response.data).each(function(key,val){
                        if(val.child.length!=0)
                        {
                            if(val.name!='Blog')
                            {
                                optstring += '<optgroup Label="'+val.name+'">';
                            }
                        }else{
                            if(val.name!='Blog')
                            {
                                optstring += '<option value="'+val.id+'">'+val.name+'</option>'+"\r\n";
                            }
                        }
                        
                        if(val.child.length!=0){
                            $(val.child).each(function(key1,val1)
                            {
                                if(val1.name!='Blog')
                                {
                                    optstring += '<option value="'+val.id+'-'+val1.id+'">'+val1.name+'</option>'+"\r\n";
                                }
                            });
                            optstring += '</optgroup>';
                        }
                    });
                    $('#val-category_id').html(optstring);           
                }
            });

    
        });
</script>


<script type='text/javascript'>
   
        $(document).ready(function(){
            $("#package_type").change(function () {
                //alert()
                var competitive_courses = $('#package_type').val();
                if(competitive_courses =='competitive-courses' ) {
                    $('#chapter').hide();
                    $('#unit').hide();
                } else {
                    $('#chapter').show();
                    $('#unit').show();
                }
            //$("#layout_select").children('option').hide();
            //$("#layout_select").children("option[value^=" + $(this).val() + "]").show()
        });
            $('#val-category_id').change(function(){
            var categoryId      = $('#val-category_id').val(); 
            var category        = categoryId.split('-');
            var category_id     = category[1];
            var competitive_courses = $('#package_type').val();
            if(category_id && competitive_courses!='competitive-courses')
            {  
                $("#sub_category_id_display").css("display", "block");
                $("#board_view").css("display","block");
                $.ajax({
                type:"get",
                url:"{{url('dashboard/packagesettings/categoriesById')}}/"+category_id,
                success:function(res)
                {       
                    if(res)
                    {
                        $("#val-sub_category_id").empty();
                        $("#val-sub_category_id").append('<option>Select Sub Category</option>');
                        $.each(res,function(key,value){
                            $("#val-sub_category_id").append('<option value="'+key+'">'+value+'</option>');
                        });
                    }
                }

                });
                }else{
                    $("#sub_category_id_display").css("display", "none");
                    $("#board_view").css("display","block");
                    
                    var categoryId = $('#val-category_id').val(); 
                    var category = categoryId.split('-');
                    var category_id = category[1];
                    var categoryid = category_id; 
                    var course_type = $('#package_type').val();


                    $.ajax({
                            type:"get",
                            url:"{{url('dashboard/packagesettings/categoriesByCourseId')}}/"+category_id,
                            success:function(res)
                            {     
                                //alert(res);  
                                if(res!='')
                                {
                                    $("#val-course_id").empty();
                                    $("#val-course_id").append('<option>Select Subject</option>');
                                    $("#val-course_id").append('<option value="0">All subject</option>');
                                    $.each(res,function(key,value){
                                        $("#val-course_id").append('<option value="'+key+'">'+value+'</option>');
                                    });
                                }else{

                                    $("#val-course_id").empty();
                                    $("#val-course_id").append('<option>Select Subject</option>');

                                }
                            }

                            });
                 /*   $.ajax({
                            type:"get",
                            url:"{{url('dashboard/packagesettings/categoriesByCourseParentType')}}/"+categoryid,
                            success:function(res)
                            {     
                                

                                if(res)
                                {
                                    $("#val-free_subject").empty();
                                    $("#val-free_subject").append('<option>Please Select</option>');
                                    $.each(res,function(key,value){
                                       // alert(value);
                                        $("#val-free_subject").append('<option value="'+key+'">'+value+'</option>');
                                    });
                                }
                            }

                        });  */
//===================
                }

            });


        //Courses

        $('#val-sub_category_id').change(function(){
            var category_id = $('#val-sub_category_id').val();
            if(category_id){  
            
                $.ajax({
                type:"get",
                url:"{{url('dashboard/packagesettings/categoriesByCourseId')}}/"+category_id,
                success:function(res)
                {       
                    if(res)
                    {
                        $("#val-course_id").empty();
                        $("#val-course_id").append('<option>Select Subject</option>');
                        $("#val-course_id").append('<option value="0">All subject</option>');
                        $.each(res,function(key,value){
                            $("#val-course_id").append('<option value="'+key+'">'+value+'</option>');
                        });
                    }
                }

                });
                }

            });


    $('#val-course_id').change(function(){
        
        var course_type = $('#package_type').val();
        if(course_type=='board')
        {
            var course_id = $('#val-course_id').val();
            var category_id = $('#val-sub_category_id').val();

                if(course_id)
                {  
                    var commnId = category_id+'_'+course_id;
                    $.ajax({
                        type:"get",
                        url:"{{url('dashboard/packagesettings/categoriesByFreeCourseId')}}/"+commnId,
                        success:function(res)
                        {      
                            //alert(res);
                            if(res)
                            {
                                $("#val-free_subject").empty();
                                $("#val-free_subject").append('<option>Select Free Subject</option>');
                                $.each(res,function(key,value)
                                {
                                    $("#val-free_subject").append('<option value="'+key+'">'+value+'</option>');
                                });
                            }
                        }

                    });
                }
        }else{


            var course_id = $('#val-course_id').val();
            var categoryId = $('#val-category_id').val(); 
            var category = categoryId.split('-');
            var category_id = category[1];

                if(course_id)
                {  
                    var commnId = category_id+'_'+course_id;
                    $.ajax({
                        type:"get",
                        url:"{{url('dashboard/packagesettings/categoriesByFreeCourseId')}}/"+commnId,
                        success:function(res)
                        {      
                            //alert(res);
                            if(res)
                            {
                                $("#val-free_subject").empty();
                                $("#val-free_subject").append('<option>Select Free Subject</option>');
                                $.each(res,function(key,value)
                                {
                                    $("#val-free_subject").append('<option value="'+key+'">'+value+'</option>');
                                });
                            }
                        }

                    });
                }

        }

    });




//val-free_subject   val-category_id         


 });


</script>


<script language="JavaScript" type="text/javascript">

function addOnServices()
{
  //Get data
  var quarterlyPrice        = $('#quarterly_coverage_price').val();
  var halfyrlyPrice         = $('#halfyrly_coverage_price').val();
  var annuallyPrice         = $('#annually_coverage_price').val();
  var default_discount      = $('#default_discount').val();
  var member_discount       = $('#member_discount').val();
  //Chk Selected
  var selObj                = document.getElementById('addon_service_id');
  var i;
  var count                 = 0;
  //Define default value
  var qtr_nonArray          = 0;
  var qtr_memArray          = 0;
  var half_nonArray         = 0;
  var half_memArray         = 0;
  var yr_nonArray           = 0;
  var yr_memArray           = 0;

  for (i=0; i<selObj.options.length; i++) 
   {
        if (selObj.options[i].selected) 
        {
            var price = selObj.options[i].value.split('__');
            //Add Price
            qtrAdd  = parseFloat(price[1]) + parseFloat(quarterlyPrice);
            halfAdd = parseFloat(price[1]) + parseFloat(halfyrlyPrice);
            yrAdd   = parseFloat(price[1]) + parseFloat(annuallyPrice);
            //QTR Non Member
            qtrN        = parseFloat(qtrAdd) * default_discount / 100; 
            qtrNonPrice = parseFloat(qtrAdd) - parseFloat(qtrN);  
            qtr_nonArray  += qtrNonPrice;
            //QTR  Member
           // qtrM        = parseFloat(qtrAdd) * member_discount / 100; 
            //qtrM        = parseFloat(qtrNonPrice) * member_discount / 100; 
            qtrM        = parseFloat(qtrNonPrice) * member_discount / 100; 
            qtrMemPrice = parseFloat(qtrNonPrice) - parseFloat(qtrM);
            qtr_memArray  += qtrMemPrice;
            //Half Non Member
            halfN        = parseFloat(halfAdd) * default_discount / 100; 
            halfNonPrice = parseFloat(halfAdd) - parseFloat(halfN);
            half_nonArray += halfNonPrice;
            //Half  Member
           // halfM        = parseFloat(halfAdd) * member_discount / 100;
            halfM        = parseFloat(halfNonPrice) * member_discount / 100; 
            halfMemPrice = parseFloat(halfNonPrice) - parseFloat(halfM);
            half_memArray += halfMemPrice;
            //Yr Non Member
            yrN        = parseFloat(yrAdd) * default_discount / 100; 
            yrNonPrice = parseFloat(yrAdd) - parseFloat(yrN); 
            yr_nonArray += yrNonPrice;
            //Yr  Member
            //yrM             = parseFloat(yrAdd) * member_discount / 100; 
            yrM             = parseFloat(yrNonPrice) * member_discount / 100; 
            yrMemPrice      = parseFloat(yrNonPrice) - parseFloat(yrM);
            yr_memArray += yrMemPrice; 

            // selectedArray[count] = selObj.options[i].value;
            count++;
        }
    }
//Get result
        $('#qtr_non').html(qtr_nonArray.toFixed(2));
        $('#qtr_mem').html(qtr_memArray.toFixed(2));
        $('#half_non').html(half_nonArray.toFixed(2)); 
        $('#half_mem').html(half_memArray.toFixed(2));
        $('#yr_non').html(yr_nonArray.toFixed(2)); 
        $('#yr_mem').html(yr_memArray.toFixed(2));  

}

</script>
<script src="{{asset('assets/plugins/tinymce/tinymce4/tinymce.min.js')}}"></script>
<script async="" type="text/javascript" src="https://latex.codecogs.com/editor3.js"></script>
  <script src="{{asset('assets/plugins/tinymce/tinymce4/plugins/tiny_mce_wiris/integration/WIRISplugins.js')}}"></script>
<script type="text/javascript">
var dir = 'ltr';
tinymce.init({
            selector: "#pkg_desc",            
            height : 100,
           // auto_focus:true,
            directionality : dir,
            menubar : 'table',
            plugins: 'image , media, table,codesample',   
            file_picker_types: 'image',        
            toolbar: 'code,|,bold,italic,u code imagenderline,|,cut,copy,paste,|,search,|,undo,redo,|,forecolor,backcolor,|,justifyleft,justifycenter,justifyright,fontselect,fontsizeselect,|,tiny_mce_wiris_formulaEditor,tiny_mce_wiris_formulaEditorChemistry,|,fullscreen,|,codesample',
            wirisimagebgcolor: '#FFFFFF',
            wirisimagesymbolcolor: '#000000',
            wiristransparency: 'true',
            wirisimagefontsize: '16',
            wirisimagenumbercolor: '#000000',
            wirisimageidentcolor: '#000000',            
            setup : function(ed)
            {
                ed.on('init', function()
                {
                    this.getDoc().body.style.fontSize = '16px';
                    this.getDoc().body.style.fontFamily = 'Arial, "Helvetica Neue", Helvetica, sans-serif';
                });
            },
        });

        

</script>
 @endsection

@section('scripts')

@endsection

