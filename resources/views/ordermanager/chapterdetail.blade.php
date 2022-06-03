<div class="card-body">
    <table class="table table-striped table-bordered example" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead>
            <tr>
                <th>Sr.No</th>
                <th>Chapter Name</th>
                <th>Unit</th>
                <th>Availed</th>
            </tr>
        </thead>
        <tbody>    
        @php $i = 0; 
            $chapterIdsArr = array();

           // echo 'Type: '.$packageType;
           // echo '<br>chp: '.$chapterIds;

            if($chapterIds){
                $chapterIdsArr = explode(',', $chapterIds);
            }
        @endphp
        @foreach($classContent as  $item)
            @php
                if($packageType>1 && count($chapterIdsArr)>0) {
                    if (in_array($item->id, $chapterIdsArr)) {
            @endphp                               
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{$item->title }}</td>
                    <td>{{$item->unit}}</td>
                    <td>N/A</td>
                </tr>
            @php   } } else { @endphp
                <tr>
                    <td>{{ ++$i}}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{$item->unit}}</td>
                    <td>N/A</td>
                </tr>
            @php } @endphp       
        @endforeach 
        </tbody>
    </table>
</div>           


 
