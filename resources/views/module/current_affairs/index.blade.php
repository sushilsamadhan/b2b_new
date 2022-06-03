@extends('layouts.master')
@section('title','Course Index')
@section('parentPageTitle', 'All Course')
@section('css-link')
    @include('layouts.include.form.form_css')
@stop
@section('page-style')
@stop
@section('content')
    <!-- BEGIN:content -->
    <div class="card m-b-30">
        <div class="row px-3 pt-3">
            <h3 class="col-md-6">
                @translate(All Courses)
            </h3>
            <div class="col-md-6">
                <form method="get" action="">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control"
                               placeholder="@translate(Search Courses)" value="{{Request::get('search')}}">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                @translate(Search)
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table foo-filtering-table ">
                    <thead class="">
                    <tr class="footable-header">
                        <th data-breakpoints="xs" class="footable-first-visible">
                            @translate(S/L)
                        </th>
                        <th>
                            @translate(Date)
                        </th>
                        <th class="">
                            @translate(Title)
                        </th>
                       <th>
                            @translate(File)
                        </th>
                        {{-- @if(\Illuminate\Support\Facades\Auth::user()->user_type != "Admin")
                            <th>@translate(Action)</th>
                        @endif --}}

                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($courses as $course)
                        <tr>
                            <td class="footable-first-visible">
                                {{ ($loop->index+1) + ($courses->currentPage() - 1)*$courses->perPage() }}
                            </td>
                            <td class="text-left">
                                {{ dateForUserView($course->course_date)}}
                            </td>
                            <td class="">
                            <h5 class="card-title font-16">{{ $course->title }}</h5>
                            <div class="">
                                                        <span
                                                            class="badge badge-{{ $course->is_published == true ? 'success'  : 'primary' }} p-2">{{ $course->is_published == true ? 'Published'  : 'Not Published' }}</span>
                                                        @if ($course->is_discount == true )
                                                            <span>{{ formatPrice($course->discount_price) }}</span>
                                                            <span> <del> {{ formatPrice($course->price) }} </del> </span>
                                                        @else
                                                            <span>{{ $course->price != null ? formatPrice($course->price)  : 'Free' }}</span>
                                                        @endif
                           </div>
                            </td>
                            
                            <td>
                            <a href="{{ asset($course->file) }}" target="_blank">Download File</a> 
                        </td>

                             
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-link p-0 font-18 float-right" type="button"
                                            id="widgetRevenue" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        <i class="feather icon-more-horizontal-"></i></button>
                                    <div class="dropdown-menu dropdown-menu-right st-drop"
                                         aria-labelledby="widgetRevenue" x-placement="bottom-end">
                                       
                                        <a class="dropdown-item font-13"
                                           href="{{ route('currentaffairs.edit',[$course->id,$course->slug])}}">
                                            
                                            @translate(Edit)
                                        </a>
                                        
                                        <a class="dropdown-item font-13"
                                            onclick="confirm_modal('{{ route('currentaffairs.destroy',[$course->id,$course->slug])}}')"
                                            href="#!">
                                            @translate(Trash)
                                        </a>
                                        
                                    </div>
                                </div>
                            </td>
                           
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6">
                                <img src="{{ filePath('no-course-found.jpg') }}" class="img-fluid w-100" alt="#No COurse Found">
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                    <div class="float-left">
                        {{ $courses->links() }}
                    </div>
                </table>
            </div>
        </div>
    </div>
    <!-- END:content -->
@endsection
@section('js-link')

@stop
@section('page-script')
@stop
