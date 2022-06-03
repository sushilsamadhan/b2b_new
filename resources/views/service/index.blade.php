@extends('layouts.master')
@section('content')
<style>
    .pagination{
        margin-right: 21px;
        float: right;
    }
</style>
<div class="content-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">OLE</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Services</a></li>
                                <li class="breadcrumb-item active">Services</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Service </h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <h4 class="header-title">Service list</h4>
                            <span class="header-title right-btn">
                               
                                <a class="btn btn-primary" href="{{ route('service.create') }}"><i class="fe-plus-circle"> Create Service</i></a>
                            </span>
                            <p class="sub-header">
                            </p>
                            <table class="table table-striped table-bordered example" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                <th>No</th>
                                <th>Service Name</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 0; @endphp
                                @foreach ($services as $key => $service)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $service->service_name }}</td>
                                    <td>{{ $service->price }}</td>
                                    <td>{{ $service->status == 1 ? 'Active': 'Deactive' }}</td>
                                    <td>
                                        <div class="kanban-menu">
                                            <div class="dropdown">
                                                <button class="btn btn-link p-0 m-0 border-0 l-h-20 font-16" type="button"
                                                        id="KanbanBoardButton1" data-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                                <div class="dropdown-menu dropdown-menu-right action-btn"
                                                    aria-labelledby="KanbanBoardButton1" x-placement="bottom-end">
                                                    <a class="dropdown-item" href="{{ route('service.edit',$service->id) }}">
                                                        <i class="feather icon-edit-2 mr-2"></i>@translate(Edit)</a>
                                                    <a class="dropdown-item"  onclick="confirm_modal('{{ route('service.destroy', $service->id) }}')">
                                                        <i class="feather icon-trash mr-2"></i>@translate(Delete)</a>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            <tbody>
                            </table>
                        </div>
                        {{-- <div class="aa" style="margin-right: 21px; float-right:10px">{!! $data->render() !!} </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')

@endsection



