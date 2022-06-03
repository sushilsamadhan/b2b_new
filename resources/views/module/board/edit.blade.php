<div class="card-body">
    <form action="{{route('boards.update')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{$board->id}}">
        <div class="form-group">
            <label>@translate(Board Name) <span class="text-danger">*</span></label>
            <input class="form-control" name="name" placeholder="@translate(Board Name)" required value="{{$board->name}}">
        </div>
        
        <div class="form-group">
            <label>@translate(Board State) <span class="text-danger">*</span></label>
            <input class="form-control" name="board_state" placeholder="@translate(Board State)" required value="{{$board->board_state}}">
        </div>
        <div class="form-group">
            <label>@translate(Description) <span class="text-danger">*</span></label>
            <input class="form-control" name="description" placeholder="@translate(Description)" required value="{{$board->description}}">
        </div>
       
        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">@translate(Update)</button>
        </div>

    </form>
</div>
