@extends('layouts.pnis')

@section('title','News')

@section('navigation')
<div class="card">
<div class="card-body">
<div class="row">
	<div class="col-6">
	<h5>Announcements </h5>
	</div>
</div>
</div>
</div>
@endsection

@section('content')
<div class="card">
<div class="card-body">
<div class="row">
	<div class="col-md-12">
	<div class="table-responsive">
  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Caption</th>
      <th scope="col">Date</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($news as $item)
    <tr>
      <th scope="row">{{ $item->id }}</th>
      <td>{{ $item->title }}</td>
      <td>{{ date("d F, Y h:i a",strtotime($item->created_at)) }}</td>
      <td>
        <a href="{{ route('news.edit',$item->id) }}"  class="btn btn-primary btn-sm">Edit</a>
        <form method="POST" action="route('news.destroy',$item->id)">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}

        <div class="form-group">
            <input type="submit" class="btn btn-sm btn-danger delete-user" value="Delete ">
        </div>
    </form>
    </td>
    </tr>
 @endforeach
  </tbody>
</table>
</div>
<hr class="text-success">
{{ $news->links() }}
	</div>
</div>
</div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {

  
    $('.delete-user').click(function(e){
        e.preventDefault() // Don't post the form, unless confirmed
        if (confirm('Are you sure?')) {
            // Post the form
            $(e.target).closest('form').submit() // Post the surrounding form
        }
    });
 

});
</script>
@endsection
          