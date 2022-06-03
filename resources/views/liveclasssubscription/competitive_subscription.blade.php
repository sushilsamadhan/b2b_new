@extends('layouts.master')
@section('title','Subscriber List')
@section('parentPageTitle', 'All Subscribers')
@section('content')
<div class="card mx-2 mb-3">
    <div class="card-header">
        <div class="float-left">
            <h3>@translate(Competitive Subscribers)</h3>
        </div>
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
    </div>

    <div class="card-body table-responsive">
        <table class="table table-hover table-bordered">
            <thead>
                <tr class="text-center">
                    <th>S/L</th>
                    <th>
                        @translate(Name)
                    </th>
                    <th>
                        @translate(Email)</th>
                    <th>
                        @translate(Phone)</th>
                    <th>
                        @translate(State)</th>
                    {{--<th>
                        @translate(Class)</th>--}}
                    <th>
                        @translate(Stream)</th>
                    <th>
                        @translate(Created Date)</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @forelse($subscribers as $item)
                <tr>
                    <td>{{ ($loop->index+1) + ($subscribers->currentPage() - 1)*$subscribers->perPage() }}</td>
                    <td class="text-center">
                     {{ $item->name }}
                    </td>
                    <td>
                        {{ ($item->email) ? $item->email : '' }}
                    </td>
                    @if(Auth::user()->user_type == "Instructor" && Auth::user()->is_external == "3")
                        <td>XXXXXXXXXX</td> 
                    @else 
                        <td>{{$item->phone}}</td>
                    @endif
                    <td>{{$item->state}}</td>
                    {{--<td>{{$item->class }}</td>--}}
                    <td>{{$item->stream }}</td>
                    <td>{{$item->created_at }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="7"><h3 class="text-center">No Data Found</h3></td>
                </tr>
                @endforelse
            </tbody>
            <div class="float-left">
                {{ $subscribers->links() }}
            </div>
        </table>
    </div>
</div>

@endsection
