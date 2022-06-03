@extends('layouts.master')
@include('layouts.include.form.form_css')
@section('content')
    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h3>View Board Analytics</h3>
            </div>
        </div>

        <div class="card-body">
            <div class="container">                    
                    <div class="row">
                    <h2> {{$board_name}} / {{$class_name}}</h2>
                    </div>
            </div>
        </div>
        <!-- Course -->
         <div class="container">                    
            <div class="row">
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-hover text-center">
                        <thead>
                        <tr>
                            <th>S/L</th>
                            <th>@translate(Course Name)</th>
                            <th>@translate(Total Units)</th>
                            <th>@translate(Total Chapters)</th>
                            <th>@translate(Total Videos)</th>
                            <th>@translate(Total PDFs)</th>
                            <th>@translate(Total Mind Maps)</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($courses)>0)    
                        @foreach($courses as  $item)
                @php
                    $string = \App\Http\Controllers\DataAnalyticController::getAnalyticalCount($item->id);
                    $allCounts = (explode('|',$string));
                @endphp
                            <tr>
                                <td>{{ ($loop->index+1) + ($courses->currentPage() - 1)*$courses->perPage() }}</td>
                                <td>{{$item->title}}</td>
                                <td>{{$allCounts[0]}}</td>
                                <td>{{$allCounts[1]}}</td>
                                <td>{{$allCounts[2]}}</td>
                                <td>{{$allCounts[3]}}</td>
                                <td>{{$allCounts[4]}}</td>
                            </tr>
                            @endforeach 
                            @else
                            <tr></tr>
                            <tr></tr>
                            <tr>
                                <td><h3 class="text-center">No Data Found</h3></td>
                            </tr>
                            <tr></tr>
                            <tr></tr>
                            <tr></tr>
                        @endif
                        </tbody>
                        @if(count($courses)>0)    
                        <div class="float-left">
                            {{ $courses->links() }}
                        </div>
                        @endif
                    </table>
                </div>
            </div>
        </div>
        <!-- Course End-->
    </div>

@endsection

@section('scripts')

@endsection
