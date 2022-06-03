@extends('layouts.master')
@section('title','Project Work')
@section('parentPageTitle', 'Update Project Work')

@section('css-link')
    @include('layouts.include.form.form_css')
    @include('layouts.include.table.table_css')
@stop

@section('page-style')

@stop

@section('content')
    <!-- BEGIN:content -->


    <div class="card m-2">
        <div class="card-header">
            <div class="row">
                <div class="col-md-7"><h3 class="card-title">{{$pwcourse->title}}</h3></div>
                {{-- @if(\Illuminate\Support\Facades\Auth::user()->user_type != "Admin") --}}
                    <div class="col-md-5">
                        <a href="#!"
                           onclick="forModal('{{ route("pwcourse.classes.create",$course_id) }}', '@translate(Add New Topic)')"
                           class="btn btn-primary mb-2">
                            <i class="la la-plus"></i>
                            @translate(Add New Topic)
                        </a>

                        <a href="#!"
                           onclick="forModal('{{ route("pwcourse.contents.create",$course_id) }}', '@translate(Add New Sub Topic)')"
                           class="btn btn-primary mb-2">
                            <i class="la la-plus"></i>
                            @translate(Add New Sub Topic)
                        </a>
                        
                    </div>
                {{-- @else --}}
               
                {{-- @endif --}}
            </div>
        </div>

        <div class="card-body">
            @foreach ($pwcourse->classesAll as $item)
                <div class="col-xl-12">
                    <div class="card bg-light text-seconday on-hover-action mb-5" id="section-6">
                        <div class="card-body">
                            <h5 class="card-title">
                            
                            <span class="font-weight-light">
                             @translate(Class) {{ $loop->index+ 1 }}</span> :
                                {{ $item->title}}
                              
                                    {{-- @if(\Illuminate\Support\Facades\Auth::user()->user_type != "Admin") --}}
                                        <span class="p-3">
                                    <a href="#!"
                                    onclick="forModal('{{ route('pwcourse.classes.edit',$item->id) }}', '@translate(Edit Title)')">
                                        <i class="feather icon-edit-1"></i>
                                    </a>

                                    <a onclick="confirm_modal('{{ route('pwcourse.classes.destroy',$item->id) }}')" href="#!">
                                        <i class="feather icon-trash"></i>
                                    </a>
                                 
                            </span>

                                {{-- @endif --}}

                            </h5>
                            <div class="clearfix"></div>
                            <div class="col-md-12 table-responsive">

                                <table id="table" class="table table-bordered table-striped">
                                    <tbody class="tablecontents">
                                    @foreach ($item->contentsAll as $content)
                                        <tr class="row bg-white grab mb-2" data-id="{{ $content->id }}">
                                            <td class="w-100">
                                                <i class="fa fa-arrows grab-icon"></i>
                                                {{ $content->title }}
                                                <a href="#!"
                                                onclick="forModal('{{ route("pwclasses.contents.show",$content->id) }}', '{{$content->title}}')">
                                                    <span class="nest-span-eye">
                                                        <i class="feather icon-eye"></i>
                                                    </span>
                                                </a>
                                                <a href="#!"
                                                    onclick="forModal('{{ route("pwclasses.contents.edit",[$content->id, $course_id])}}')">
                                                    <i class="feather icon-edit-1"></i>
                                                </a> 
                                                        
                                                {{-- @if(\Illuminate\Support\Facades\Auth::user()->user_type =="Instructor") --}}
                                                <a onclick="confirm_modal('{{ route('pwclasses.contents.destroy',$content->id) }}')"
                                                    href="#!">
                                                    <span class="nest-span-trash">
                                                        <i class="feather icon-trash"></i>
                                                    </span>
                                                </a>
                                                
                                                {{-- @endif --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div>
            @endforeach

            <!--Webinar Start-->
                <div class="col-xl-12">
                    <div class="card bg-light text-seconday on-hover-action mb-5" id="section-6">
                        <div class="card-body">
                            <h5 class="card-title">
                                @translate(Webinar)
                            </h5>
                            @if(count($webinar)==0)
                                    Webinar not associated yet, click add button
                                    <a href="#!" class="btn btn-primary mb-2"
                                        onclick="forModal('{{ route("webinar.contents.create",[$course_id,$pwcourse->slug]) }}', '@translate(Add Webinar)')">
                                        <i class="la la-plus"></i>  
                                        @translate(Add Webinar)
                                    </a>
                            @else        
                                <div class="clearfix"></div>
                                <a href="#!" class="btn btn-primary mb-2"
                                    onclick="forModal('{{ route("webinar.contents.create",[$course_id,$pwcourse->slug]) }}', '@translate(Add Webinar)')">
                                    <i class="la la-plus"></i>  
                                    @translate(Add More)
                                </a>
                                <div class="row">
                                    @foreach ($webinar as $data)
                                        <div class="col-md-4 mb-3">
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <h4 class="card-title">{{$data->topic}}</h4>
                                                    <img class="card-img" src="{{filePath($data->image)}}" alt="Card image">
                                                    <div class="d-flex align-items-center my-2 justify-content-between">
                                                        <div>
                                                            <span class="font-weight-bold text-success d-block">@translate(Start Date)</span>
                                                            <span class="font-weight-normal text-success">{{$data->start_date}}</span>
                                                        </div>
                                                        <div>
                                                        <span class="font-weight-bold text-danger d-block">@translate(End Date)</span>
                                                            <span class="font-weight-normal text-danger">
                                                                {{$data->end_date}}</span>
                                                        </div>
                                                    </div>
                                                    <p class="card-text"><@translate(Webinar Type :)
                                                    {{$data->type}}</p>
                                                    <p class="card-text">@translate(Presented By :) 
                                                        {{$data->presented_by}}</p>
                                                    @php
                                                        $pwId = getProjectWebinarId($course_id, $data->id);
                                                    @endphp
                                                    @if($pwId>0)
                                                    <div class="dropdown">
                                                        <button class="btn btn-link p-0 font-18 float-right" type="button"
                                                                id="widgetRevenue" data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                            <i class="feather icon-more-horizontal-"></i></button>
                                                            <div class="dropdown-menu dropdown-menu-right st-drop"
                                                                aria-labelledby="widgetRevenue" x-placement="bottom-end">
                                                            <a class="dropdown-item font-13"
                                                                onclick="confirm_modal('{{ route('pwcourse.destroyAssociation',$pwId)}}')"
                                                                href="#!">
                                                                    @translate(Trash)
                                                            </a>
                                                            </div>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif            
                            
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div>
            <!-- Webinar End -->

        </div>
    </div>
    <!-- END:content -->
@endsection

@section('js-link')
    @include('layouts.include.form.form_js')
    @include('layouts.include.table.table_js')
@stop

@section('page-script')
    <script type="text/javascript" src="{{ asset('assets/js/custom/class.js') }}"></script>
    <script type="text/javascript">
        "use strict"
        $(document).ready(function () {
            $(".tablecontents").sortable({
                items: "tr",
                cursor: 'move',
                opacity: 0.6,
                update: function () {
                    @if(\Illuminate\Support\Facades\Auth::user()->user_type == "Instructor")
                    sendOrderToServer();
                    @endif
                }
            });

            function sendOrderToServer() {
                var order = [];
                var token = $('meta[name="csrf-token"]').attr('content');
                $('tr.row').each(function (index, element) {
                    order.push({
                        id: $(this).attr('data-id'),
                        position: index + 1
                    });
                });

                $.ajax({
                    method: "GET",
                    url: "{{ route('content.short') }}",
                    data: {
                        order: order
                    },
                    success: function (response) {
                        //response goes here
                        $('#my_lms_soft').append(response);
                    }
                });
            }
        })

    </script>
@stop
