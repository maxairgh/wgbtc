<div>
@section('title','Annoucements')

@section('navigation')
<div class="card">
<div class="card-body">
<div class="row">
	<div class="col-md-6">
	<h5>Annoucement</h5>
	</div>
    <div class="col-md-6 text-center">
      
	</div>
</div>
</div>
</div>
@endsection
      <div class="btn-group btn-group-md mb-2" role="group" aria-label="Small button group">
			    <button type="button" class="btn btn-info btn-md" wire:click="switchTab('1')"> View News</button>
			    <button type="button" class="btn btn-success btn-md" wire:click="switchTab('2')"> Add New Annoucement</button>
		   </div>
<div class="row">
<div class="col-md-12">
@if (session()->has('success'))
<div class="alert alert-success alert-dismissible" role="alert">
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  <div class="alert-message">
    <strong>Hello there! </strong> {{ session('success') }} 
  </div>
</div>
@endif
@if (session()->has('error'))
<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  <div class="alert-message">
    <strong>Hello there! {{ session('error') }}</strong>  
  </div>
</div>
@endif
</div>
</div>

<div class="card {{ (!$viewMode) ? 'd-block' : 'd-none' }}">
<div class="card-body">
<div class="row">
	<div class="col-md-12">

<div class="form-floating mb-3">
  <input type="text" class="form-control" id="floatingInput" wire:model="caption" placeholder="name@example.com" required>
  <label for="floatingInput">News Caption</label>
  @error('caption') <span class="text-danger error">{{ $message }}</span> @enderror
</div>

<div class="mb-3" wire:ignore>
<label for="floatingTextarea2">Details</label>  
  <textarea class="form-control"   id="newsnote" name="news" required></textarea>
 </div>
@error('details') <span class="text-danger error">{{ $message }}</span> @enderror

<div class="form-floating mb-3">
  <select class="form-select" id="floatingSelect" required wire:model="status" aria-label="Floating label select example">
     <option value="">Select</option>
     <option value="1">Active</option>
    <option value="2">Inactive</option> 
  </select>
  <label for="floatingSelect">Status</label>
  @error('status') <span class="text-danger error">{{ $message }}</span> @enderror
</div>

<div class="col-md-12 text-center">
<button wire:click="saveNews"   class="btn btn-primary btn-sm">{{ $label }}</button>
</div>

	</div>
</div>
</div>
</div>

<div class="card {{ ($viewMode) ? 'd-block' : 'd-none' }}">
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
        <div class="btn-group btn-group-md mb-2" role="group" aria-label="Small button group">
			    <button type="button" class="btn btn-info btn-md" wire:click="editNews({{ $item->id }})">Edit</button>
			    <button type="button" class="btn btn-danger btn-md" wire:click="deleteNews({{ $item->id }})">Delete</button>
		   </div>
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

@section('scripts')
<script>
$(document).ready(function() {
	editor = CKEDITOR.replace( 'newsnote' );
 
Livewire.on('setDetailsDataEvent',details=>{
    CKEDITOR.instances.newsnote.setData(details);
    @this.set('details',details);
 });

Livewire.on('resetEmittedData',()=>{
    CKEDITOR.instances.newsnote.setData('');
    @this.set('details','');
});

// The "change" event is fired whenever a change is made in the editor.
editor.on( 'change', function( evt ) {
    // getData() returns CKEditor's HTML content.
  
    @this.set('details',evt.editor.getData() );
  });

});
</script>
@endsection

</div>