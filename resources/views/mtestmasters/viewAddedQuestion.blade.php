@extends('layouts.master')
@include('layouts.include.form.form_css')
@section('content')

    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h3>View Added Questions</h3>
            </div>
        </div>
        <div class="card-body">
        

                <div class="container">                    
                                                     
                <div class="container">                    
                    <div class="row">

                        <table class="table table-success table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Question</th>
                                    <th>Question Type</th>
                                </tr>
                            </thead>
                            <tbody id="myTable">
                            @if($studentestquestions->count()>0)
                            @php  $i=0; @endphp
                            @foreach($studentestquestions as  $item)

                                @php    

                                $content = html_entity_decode($item->body);
                                $content = preg_replace("/<img[^>]+\>/i", " ", $content); 


                                if($item->question_type=='1')
                                                {
                                                    $question_type = 'Single Selection';
                                                }
                                                else if($item->question_type=='2')
                                                {
                                                    $question_type = 'Multiple Selection';
                                                } 
                                                else if($item->question_type=='3')
                                                {
                                                    $question_type = 'Paragraph';
                                                } 
                                                else
                                                {
                                                    $question_type = '';
                                                }    

                                @endphp
                            
                                <tr>
                                    <td>{{ ++$i}}</td>
                                    <td width="70%">    @php echo  $content;@endphp </td>
                                     <td>{{$question_type}}</td>
                                   
                                </tr>
                                @endforeach
                                @endif
                            <tbody>
                        </table> <div class="float-left">
                    </div>
                    </div>
                </div>     
               
        </div>
    </div>
   
@endsection

@section('scripts')

@endsection


