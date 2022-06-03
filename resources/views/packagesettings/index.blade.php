@extends('layouts.master')
@section('content')
    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h3>Package Settings</h3>
            </div>
            <div class="float-right">
           
                <div class="row">
                 
                    <div class="col">
                    <a href="{{route('packagesettings.create')}}"
                           class="btn btn-primary">
                            <i class="la la-plus"></i>
                            Add Package Settings
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered example" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Name/Updated On</th>
                        <th>Type</th>
                        <th>Courses</th>
                        <th>Coverage Price</th>
                        <th>Discount</th>
                        <th>Member Discount</th> 
                        <th>With Add-On Price</th>
                        <th>Status</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                 @if(count($packagesettings)>0)  
                            @foreach ($packagesettings as $key => $packagesetting)

                                @php
                                $addon = \App\PackageAddonService::where(['package_id' => $packagesetting->id])->get();
                                
                                    if(count($addon)>0)
                                    {
                                        $qtr_nonArray          = 0;
                                        $qtr_memArray          = 0;
                                        $half_nonArray         = 0;
                                        $half_memArray         = 0;
                                        $yr_nonArray           = 0;
                                        $yr_memArray           = 0;
                                        foreach($addon as $valT)
                                        {
                                            $qtrAdd  = ($packagesetting->quarterly_coverage_price) + ($valT->price);
                                            $halfAdd = ($packagesetting->halfyrly_coverage_price) + ($valT->price);
                                            $yrAdd   = ($packagesetting->annually_coverage_price) + ($valT->price);
                                        
                                            //quarterly_coverage_price halfyrly_coverage_price annually_coverage_price
                                                //QTR Non Member
                                                $qtrN        = ($qtrAdd) * $packagesetting->default_discount / 100; 
                                                $qtrNonPrice = ($qtrAdd) - ($qtrN);  
                                                $qtr_nonArray  += $qtrNonPrice;

                                                //QTR  Member
                                                $qtrM        = ($qtrNonPrice) * $packagesetting->member_discount / 100; 
                                                $qtrMemPrice = ($qtrNonPrice) - ($qtrM);
                                                $qtr_memArray  += $qtrMemPrice;

                                                //Half Non Member
                                                $halfN        = ($halfAdd) * $packagesetting->default_discount / 100; 
                                                $halfNonPrice = ($halfAdd) - ($halfN);
                                                $half_nonArray += $halfNonPrice;

                                                //Half  Member
                                                $halfM        = ($halfNonPrice) * $packagesetting->member_discount / 100; 
                                                $halfMemPrice = ($halfNonPrice) - ($halfM);
                                                $half_memArray += $halfMemPrice;

                                                //Yr Non Member
                                                $yrN        = ($yrAdd) * $packagesetting->default_discount / 100; 
                                                $yrNonPrice = ($yrAdd) - ($yrN); 
                                                $yr_nonArray += $yrNonPrice;


                                                //Yr  Member
                                                $yrM             = ($yrNonPrice) * $packagesetting->member_discount / 100; 
                                                $yrMemPrice      = ($yrNonPrice) - ($yrM);
                                                $yr_memArray += $yrMemPrice; 
                                        
                                        
                                        }

                                        $withAddOn_qtr1 = ($qtrAdd) * $packagesetting->default_discount / 100;
                                        $withAddOn_qtr1 = ($qtrAdd) - ($withAddOn_qtr1);

                                        $withAddOn_qtr2 = ($withAddOn_qtr1) * $packagesetting->member_discount / 100;
                                        $withAddOn_qtr = ($withAddOn_qtr1) - ($withAddOn_qtr2);

                                        $withAddOn_haf1 = ($halfAdd) * $packagesetting->default_discount / 100;
                                        $withAddOn_haf1 = ($halfAdd) - ($withAddOn_haf1);
                                        
                                        $withAddOn_haf2 = ($withAddOn_haf1) * $packagesetting->default_discount / 100;
                                        $withAddOn_haf = ($withAddOn_haf1) - ($withAddOn_haf2);


                                        $withAddOn_anl1 = ($yrAdd) * $packagesetting->default_discount / 100;
                                        $withAddOn_anl1 = ($halfAdd) - ($withAddOn_anl1);
                                       
                                        $withAddOn_anl2 = ($withAddOn_anl1) * $packagesetting->default_discount / 100;
                                        $withAddOn_anl = ($withAddOn_anl1) - ($withAddOn_anl2);

                                    }else{


                                        $withAddOn_qtr = '0.00';
                                        $withAddOn_haf = '0.00';
                                        $withAddOn_anl = '0.00';
                                    }
                                @endphp





                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>
                                        <img src="{{ filePath($packagesetting->pkg_image) }}" width="50" height="auto" alt="photo">
                                    <br/>{{$packagesetting->pkg_name}}<br>@php echo date('d, M-Y H:i',strtotime($packagesetting->updated_at)); @endphp
                                    </td>
                                        <td>{{ucfirst($packagesetting->package_type)}}</td>
                                        <td>@if($packagesetting->package_type=='board')
                                            @if($packagesetting->title && $packagesetting->is_all_subject != 1)
                                            {{$packagesetting->title}}
                                            @else

                                            All Subject

                                            @endif
                                          
                                            <br/>
                                        
                                       <span class="badge badge-secondary"> {{$packagesetting->name}}</span>&nbsp;/&nbsp;<span class="badge badge-secondary">{{$packagesetting->subCat}}</span>
                                        @else
                                        {{$packagesetting->name}}
                                        
                                        @endif
                                    </td>
                                        <td>QTR: &#x20B9;{{round($packagesetting->quarterly_coverage_price,2)}}<br/>
                                        HLF: &#x20B9;{{round($packagesetting->halfyrly_coverage_price,2)}}<br/>
                                        YRL: &#x20B9;{{round($packagesetting->annually_coverage_price,2)}}</td>
                                       <!-- <td>{{$packagesetting->halfyrly_course_coverage}}%</td>
                                        <td>{{$packagesetting->annually_course_coverage}}%</td>
                                        <td>{{$packagesetting->quarterly_coverage_price}}</td>
                                        <td>{{$packagesetting->halfyrly_coverage_price}}</td>
                                        <td>{{$packagesetting->annually_coverage_price}}</td>-->
                                        <td>{{$packagesetting->default_discount}}%</td>
                                        <td>{{$packagesetting->member_discount}}%</td> 
                                        <td>QTR: &#x20B9;{{round($withAddOn_qtr,2)}}<br/>
                                        HLF: &#x20B9;{{round($withAddOn_haf,2)}}<br/>
                                        YRL: &#x20B9;{{round($withAddOn_anl,2)}}</td>
                                        <td>{{($packagesetting->status=='1')?'Active':'In-Active'}}</td>
                                        <td>

                                       
                                            <div class="kanban-menu">
                                                <div class="dropdown">
                                                    <button class="btn btn-link p-0 m-0 border-0 l-h-20 font-16" type="button"
                                                            id="KanbanBoardButton1" data-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                                    <div class="dropdown-menu dropdown-menu-right action-btn"
                                                        aria-labelledby="KanbanBoardButton1" x-placement="bottom-end">
                                                        <a class="dropdown-item" href="{{ route('packagesettings.edit',$packagesetting->id) }}">
                                                            <i class="feather icon-edit-2 mr-2"></i>@translate(Edit)</a>
                                                        <a class="dropdown-item"  onclick="confirm_modal('{{ route('packagesettings.destroy', $packagesetting->id) }}')">
                                                            <i class="feather icon-trash mr-2"></i>@translate(Delete)</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                               
                            @endif
                        <tbody>
                    </table><div class="float-right">{{ $packagesettings->links() }}</div>
                </div>
            </div>
@endsection
