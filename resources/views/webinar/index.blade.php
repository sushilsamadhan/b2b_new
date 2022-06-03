@extends('layouts.master')
@section('title','Webinar Index')
@section('parentPageTitle', 'All Webinars')
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
                @translate(All Webinars)
            </h3>
            <div class="col-md-6">
                <form method="get" action="">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" autocomplete="off"
                               placeholder="@translate(Search Webinar)" value="{{Request::get('search')}}">
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
                        <th>
                            @translate(S/L)
                        </th>
                        <th>&nbsp;</th>
                        <th>
                            @translate(Topic)
                        </th>
                        <th>
                            @translate(Start Date)
                        </th>
                        <th>
                            @translate(End Date)
                        </th>
                        <th>
                            @translate(Type)
                        </th>
                        <th>
                            @translate(Is Live)
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($webinars as $webinar)
                        <tr>
                            <td class="footable-first-visible">
                                {{ ($loop->index+1) + ($webinars->currentPage() - 1)*$webinars->perPage() }}
                            </td>
                            <td class="w-10 text-left">
                            <img src="{{filePath($webinar->image)}}" class="card-img avatar-xl" alt="Card image">
                            
                            </td>
                            <td>{{ $webinar->topic }}</td>
                            <td>{{ $webinar->start_date }}</td>
                            <td>{{ $webinar->end_date }}</td>
                            <td>{{ $webinar->type }}</td>
                            <td>{{ $webinar->is_live }}</td>

                             {{-- @if(\Illuminate\Support\Facades\Auth::user()->user_type != "Admin") --}}
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-link p-0 font-18 float-right" type="button"
                                            id="widgetRevenue" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        <i class="feather icon-more-horizontal-"></i></button>
                                    <div class="dropdown-menu dropdown-menu-right st-drop"
                                         aria-labelledby="widgetRevenue" x-placement="bottom-end">
                                        <!-- <a class="dropdown-item font-13"
                                           href="{{ route('webinar.index',[$webinar->id]) }}">
                                            @translate(Details)
                                        </a> -->
                                    
                                        <a class="dropdown-item font-13"
                                           href="{{ route('webinar.edit',[$webinar->id])}}">
                                            {{-- Auth::user()->user_type == 'Admin' ? '@translate(Details)' : '@translate(Edit)' --}}
                                            @translate(Edit)
                                        </a>
                                        @if($webinar->id >= 0)
                                            <a class="dropdown-item font-13"
                                               onclick="confirm_modal('{{ route('webinar.destroy',[$webinar->id])}}')"
                                               href="#!">
                                                @translate(Trash)
                                            </a>
                                        @endif
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
                        {{ $webinars->links() }}
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
