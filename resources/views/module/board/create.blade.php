<div class="card-body">
    <form action="{{route('boards.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label>@translate(Board Name) <span class="text-danger">*</span></label>
            <input class="form-control" name="name" placeholder="@translate(Board Name)" required>
        </div>
        
        <div class="form-group">
            <label>@translate(Board State) <span class="text-danger">*</span></label>
            <input class="form-control" name="board_state" placeholder="@translate(Board State)" required>
        </div>
        <div class="form-group">
            <label>@translate(Description) <span class="text-danger"></span></label>
            <input class="form-control" name="description" placeholder="@translate(Description)" >
        </div>
        <!-- <div class="form-group">
            <label class="col-form-label text-md-right">@translate(Icon/Image)</label>
            <div class="custom-file">

                <input value="" name="icon" class="icon" type="hidden">
                <span class="invalid-feedback" role="alert"> <strong> </strong> </span> 
                <img class="category_preview rounded shadow-sm d-none" width="55" src="" alt="#Category icon">

                <br>

               

            </div>
        </div> -->
       
        <div class="float-right">
            <button class="btn btn-primary float-right" type="submit">@translate(Save)</button>
        </div>

    </form>
</div>



