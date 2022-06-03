@extends('layouts.master')
@section('title','Student')
@section('parentPageTitle', 'All Student')
@section('content')
    <div class="card mx-2 mb-3">
        <div class="card-header">
            <div class="float-left">
                <h3>@translate(All Students)</h3>
            </div>
            <div class="float-right">
                <div class="row">
                    <div class="col">
                        <form method="get" action="">
                            <div class="input-group">
                                <input type="text" name="search" class="form-control col-12"
                                       placeholder="@translate(Search by name or course)"
                                       value="{{Request::get('search')}}">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">@translate(Search)</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover text-center">
                <thead>
                    <tr>
                        <th>S/L</th>
                        <th>@translate(Name)</th>
                        <th>@translate(Father Name)</th>
                        <th>@translate(Phone)</th>
                        <th>@translate(Course Enrolled)</th>
                        <th>@translate(Assessment Status)</th>
                        <th>@translate(Enrollment Amount)</th>
                        <th>@translate(Enrollment Date)</th>
                        <th>@translate(Action)</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($enroll as  $item)
                    <tr>
                        <td>{{ ($loop->index+1) + ($enroll->currentPage() - 1)*$enroll->perPage() }}</td>
                        <td>{{$item->student->name}}</td>
                        <td>{{$item->student->father_name ?? 'N/A'}}</td>
                        <td>{{$item->student->email ?? 'N/A'}}</td>
                        <td>
                            {{$item->course->title ?? 'N/A'}}
                        </td>
                        <td>
                            {{$item->assessment_status ? $item->assessment_status : 'N/A'}}
                        </td>
                        <td>
                            {{--(isset($item->course) && $item->course->is_free == 0) ? $item->course->price : 'Free'--}}
                            {{ ($item->amount != 0) ? $item->amount : 'Free' }}
                        </td>
                        <td> {{$item->created_at ?? 'N/A'}}</td>
                        <td>
                            @if($item->assessment_status)
                                @if($item->assessment_status == 'pass')
                                    <a target="_blank" href="{{ route('certificate.get', [$item->course_id, $item->user_id]) }}">
                                        @translate(View Certificate)
                                    </a>
                                @else
                                    <span>Certificate not generated</span>
                                @endif
                            @else
                                <span>N/A</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr></tr>
                    <tr></tr>
                    <tr>
                        <td><h3 class="text-center">No Data Found</h3></td>
                    </tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                @endforelse
                </tbody>
                <div class="float-left">
                    {{ $enroll->links() }}
                </div>
            </table>
        </div>
    </div>

@endsection
