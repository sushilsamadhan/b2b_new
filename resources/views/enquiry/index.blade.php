@extends('layouts.master')
@section('title','Subscriber List')
@section('parentPageTitle', 'All Subscribers')
@section('content')
<style>
.moretext {
  display: none;
}
</style>
    <div class="card">
        <div class="card-header">
            <h4>Tutor Enquiry</h4>
        </div>
        <div class="card-body text-center" >

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>@translate(ID)</th>                             
                        <th>@translate(name)</th>
                        <th>@translate(phone)</th>
                        <th>@translate(email)</th>
                        <th>@translate(qualification)</th>
                        <th>@translate(subject)</th>
                        <th>@translate(day)</th>
                        <th>@translate(Availability)</th>
                        <th>@translate(Full Address)</th>
                        <th>@translate(Enquiry Date)</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($enquiry as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->qualification }}</td>
                        <td>{{ $item->subject }}</td>
                        <td>{{ $item->day }}</td>
                        <td>{{ $item->starttime }} <br>To<br>{{ $item->endtime }}</td>                                
                        <td>{{ $item->location }}<br> <p class="moretext"> {{ $item->pincode }}<br>{{ $item->city }} <br>{{ $item->State }}</p>
                        <a class="moreless-button" href="#">more</a>
                        <td>{{ $item->created_at }}</td>
                    </td>
                    </tr>
                    @empty
                    <tr><td colspan="10"><h4>No Records Available</h4></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
 <script  src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
$('.moreless-button').click(function() {
  $('.moretext').slideToggle();
  if ($('.moreless-button').text() == "more") {
    $(this).text("less")
  } else {
    $(this).text("more")
  }
});

</script>
@endsection

