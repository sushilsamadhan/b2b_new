<form action="{{ route('webinar.contents.store') }}" method="post">
    @csrf
    {{-- Class Title --}}
    <input type="hidden" name="projetc_work_id" value="{{$project_work_id}}">
    <input type="hidden" name="slug" value="{{$slug}}">
    
        <table id="table" class="table table-bordered">
                <tbody class="tablecontents">
                    <tr>
                        <th>S/L</th>
                        <th>Select</th>
                        <th>Webinar</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                    </tr>
                   
                @php $i=0;  @endphp
                @if(count($assWebinars)>0)    
                    @foreach ($assWebinars as $webinar) 
                        <tr>
                            <td>{{++$i}}</td>
                            <td>
                                <input type="checkbox" name="webinar_ids[]" value="{{$webinar->id}}" class="chk">
                            </td>
                            <td>{{$webinar->topic}}</td>                
                            <td>{{$webinar->start_date}}</td>
                            <td>{{$webinar->end_date}}</td>
                        </tr>
                    @endforeach 
                @else
                    <tr>
                        <td colspan="6">No Webinar found.</td>   
                    </tr>
                @endif
                </tbody>
            </table>    
            <button type="submit" class="btn btn-primary float-left">
                @translate(Submit)</button><span class="text-danger" id="end_date_error" style="display:none;margin-left:2%">At least one checkbox should be selected.</span>
</form>
{{-- Script --}}
<script>
    $(document).on('submit',function(){
        var sList = "";
        $('input[type=checkbox]').each(function () {
            var sThisVal = (this.checked ? "1" : "0");
            if(sThisVal==1){
                sList  = sThisVal;
                $('#end_date_error').hide();
            }
        });
        if(sList==''){
            $('#end_date_error').show();
            return false;
        }
    });
</script>
