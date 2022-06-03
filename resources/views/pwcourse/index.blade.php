@extends('layouts.master')
@section('title','Project Work Index')
@section('parentPageTitle', 'All Project Work')
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
                @translate(All Project Works)
            </h3>
            <div class="col-md-6">
                <form method="get" action="">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" autocomplete="off"
                               placeholder="@translate(Search Project Work)" value="{{Request::get('search')}}">
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
                <table class="table foo-filtering-table text-center">
                    <thead class="text-center">
                    <tr class="footable-header">
                        <th data-breakpoints="xs" class="footable-first-visible">
                            @translate(S/L)
                        </th>
                        <th>
                            @translate(Title)
                        </th>
                        <th>
                            @translate(Category)
                        </th>
                        <th data-breakpoints="xs">
                            @translate(Info)
                        </th>
                        @if(\Illuminate\Support\Facades\Auth::user()->user_type == "Admin")
                            <th>@translate(Published)</th>
                        @endif
                        <th data-breakpoints="xs">
                            @translate(Enrolled Students)
                        </th>
                        <th>@translate(Action)</th>
                        {{-- @if(\Illuminate\Support\Facades\Auth::user()->user_type != "Admin")
                            <th>@translate(Action)</th>
                        @endif --}}

                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($pwcourses as $pwcourse)
                        <tr>
                            <td class="footable-first-visible">
                                {{ ($loop->index+1) + ($pwcourses->currentPage() - 1)*$pwcourses->perPage() }}
                            </td>
                            <td class="w-45 text-left">
                                <a href="{{  route('pwcourse.show',[$pwcourse->id,$pwcourse->slug]) }}">
                                    <div class="card">
                                        <div class="row no-gutters">
                                            <div class="col-md-4 overflow-auto my-auto">
                                                <img src="{{filePath($pwcourse->image)}}" class="card-img avatar-xl"
                                                     alt="Card image">
                                            </div>
                                            <div class="col-md-8">
                                                <div class="card-body">
                                                    <h5 class="card-title font-16">{{ $pwcourse->title }}</h5>
                                                    <p class="text-secondary">{{$pwcourse->level}}</p>
                                                    <p class="card-text">{{-- $pwcourse->relationBetweenInstructorUser->name --}}</p>
                                                    <div class="d-flex justify-content-between">
                                                        <span
                                                            class="badge badge-{{ $pwcourse->is_published == true ? 'success'  : 'primary' }} p-2">{{ $pwcourse->is_published == true ? 'Published'  : 'Not Published' }}</span>
                                                        @if ($pwcourse->is_discount == true )
                                                            <span>{{ formatPrice($pwcourse->discount_price) }}</span>
                                                            <span> <del> {{ formatPrice($pwcourse->price) }} </del> </span>
                                                        @else
                                                            <span>{{ $pwcourse->price != null ? formatPrice($pwcourse->price)  : 'Free' }}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </td>
                            <td>
                           
                            <span class="badge badge-info">
                            {{ $pwcourse->relationBetweenCategory->category_name }}</span>
                        </td>
                            <td>
                                @translate(Classes)- {{ $pwcourse->classes->count() }}
                                @php
                                    $total_count = 0;
                                @endphp
                                @foreach($pwcourse->classes as $item)
                                    <input type="hidden" value="{{$total_count += $item->contents->count()}}"/>
                                @endforeach
                                <br>
                                @translate(Contents)- {{ $total_count }}
                            </td>
                            @if(\Illuminate\Support\Facades\Auth::user()->user_type == "Admin")
                               @if(App\Model\PwEnrollment::where('project_work_id' , $pwcourse->id)->count() > 0 )
                                    <td>
                                         <p class="text-primary">@translate(Enrolled)</p>
                                    </td>
                                @else
                                    <td>
                                        <div class="switchery-list">
                                            <input type="checkbox" data-url="{{route('pwcourse.publish')}}"
                                                   data-id="{{$pwcourse->id}}"
                                                   class="js-switch-primary"
                                                   id="category-switch" {{$pwcourse->is_published == true ? 'checked' : null}} />
                                        </div>
                                    </td>
                                @endif
                            @endif
                            <td>{{ $s = App\Model\PwEnrollment::where('project_work_id' , $pwcourse->id)->count() }} </td>

                             {{-- @if(\Illuminate\Support\Facades\Auth::user()->user_type != "Admin") --}}
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-link p-0 font-18 float-right" type="button"
                                            id="widgetRevenue" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        <i class="feather icon-more-horizontal-"></i></button>
                                    <div class="dropdown-menu dropdown-menu-right st-drop"
                                         aria-labelledby="widgetRevenue" x-placement="bottom-end">
                                        <a class="dropdown-item font-13"
                                           href="{{ route('pwcourse.show',[$pwcourse->id,$pwcourse->slug])}}">
                                            @translate(Details)
                                        </a>
                                        <!-- @if($pwcourse->is_published==1)
                                        <a class="dropdown-item font-13"
                                           href="{{-- route('pwcourse.lesson_details',[$pwcourse->slug]) --}}">
                                            @translate(Lesson Details)
                                        </a>
                                        @endif -->
                                        <a class="dropdown-item font-13"
                                           href="{{ route('pwcourse.edit',[$pwcourse->id,$pwcourse->slug])}}">
                                            {{-- Auth::user()->user_type == 'Admin' ? '@translate(Details)' : '@translate(Edit)' --}}
                                            @translate(Edit)
                                        </a>
                                        @if($s >= 0)
                                            <a class="dropdown-item font-13"
                                               onclick="confirm_modal('{{ route('course.destroy',[$pwcourse->id,$pwcourse->slug])}}')"
                                               href="#!">
                                                @translate(Trash)
                                            </a>
                                        @endif
                                        <a class="dropdown-item font-13"
                                           href="{{route('pwcourse.create.assesment',[$pwcourse->slug])}}">
                                            @translate(Assesment)
                                        </a>
                                    </div>
                                </div>
                            </td>
                            {{-- @endif --}}
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
                        {{ $pwcourses->links() }}
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
