<div>      
@section('title','Quizes')

@section('navigation')
<div class="card">
<div class="card-body">
<div class="row">
	<div class="col-md-6">
	<h5>Courses Quizes</h5>
	</div>
    <div class="col-md-6 text-center">
            
	</div>
</div>
</div>
</div>
@endsection

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

<!--courses section-->
<div class="row {{ ($selectMode) ? '' : 'd-none'}}">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
            <h6 class="text-success"> Assigned Courses </h6>
            <hr class="text-success" />

<!--courses-->
<div class="row">
   
@foreach($courses as $course)
     <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center ">
            <p class="text-success"><svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book align-middle me-2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg></p>
            <h6 class="text-success">{{ $course['title'] }}</h6>
            <p>Learners <span class="badge rounded-pill bg-info">+{{ $course['number'] }}</span></p>
            <button wire:click="manageContent({{ $course['id'] }})" class="btn btn-info btn-sm">Manage</button>
            </div>
        </div>
    </div>
@endforeach
</div>
<!--courses-->
  
            </div>
        </div>
    </div>
</div>
<!--courses section-->

<div class="row {{ ($selectMode) ? 'd-none' : ''}}">
<div class="col-md-12">
        <div class="card">
            <div class="card-body">
            <h4 class="text-success"> {{ $selectedCourse->code ?? '' }} - {{ $selectedCourse->title ?? '' }} 
            <button type="button" wire:click="backToCourses" class="btn btn-primary btn-sm float-end" >Back <<</button>
            </h4>
            <hr class="text-success" />

            <h4>{{ $selectedQuiz->type->code ?? "" }} {{ $selectedQuiz->type->name ?? ""  }}</h3>
            <div id="">
                    {!! $selectedQuiz->content ?? "" !!}
            </div>
            <span wire:click="" class="badge bg-secondary float-end">Due Date: {{ date('j M Y H:i:s',strtotime($selectedQuiz->duedate ?? '')) }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
            <h6 class="text-success"> Add Questions</h6>
            <hr class="text-success" />
                <div class="input-group mb-2">
                <input type="text" wire:model="code" class="form-control" placeholder="Question" aria-label="Username" aria-describedby="basic-addon1">
                <textarea class="form-control" aria-label="With textarea"></textarea>
                </div>
                <div class="input-group mb-2">
                <input type="text" wire:model="name" class="form-control" placeholder="Option 1" aria-label="Username" aria-describedby="basic-addon1">
                <input type="text" wire:model="name" class="form-control" placeholder="Option 2" aria-label="Username" aria-describedby="basic-addon1">
                <input type="text" wire:model="name" class="form-control" placeholder="Option 3" aria-label="Username" aria-describedby="basic-addon1">
                <input type="text" wire:model="name" class="form-control" placeholder="Option 4" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-2">
                <input type="text" wire:model="percentage" class="form-control" placeholder="Answers, separate with | for multiple select" aria-label="Username" aria-describedby="basic-addon1">
                <select class="form-select" wire:model="quiz" id="floatingSelect" aria-label="Floating label select example">
                <option value="1">Multiple Choice</option>
                <option value="2">Multi</option>
                </select>
                <span wire:click="saveType" class="input-group-text" id="basic-addon1">ADD QUESTION</span>
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
            
            <table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">Question</th>
      <th scope="col">Option 1</th>
      <th scope="col">Option 2</th>
      <th scope="col">Option 3</th>
      <th scope="col">Option 4</th>
      <th scope="col">Answers</th>
      <th scope="col">type</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($selectedQuiz->quizes ?? [] as $found)
    <tr>
      <th scope="row">{{ $found->matrix }}</th>
      <td>{{ $found->lastname }} {{ $found->firstname }} </td>   
      <td>{{ $found->gender }}</td>
      <td>{{ $found->email  }}</td>
      <td>{{ $found->mobile  }}</td>
      <td>{{  $found->status }}</td>
      <td>
  
     
      <td>
                <div class="btn-group btn-group-sm mb-4" role="group" aria-label="Small button group">
					<button class="btn btn-info btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit align-middle me-2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg> View</button>
					<button class="btn btn-primary btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit align-middle me-2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg> Edit</button>
				</div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

            </div>
        </div>
    </div>
</div>



@section('scripts')
<script>
   
$(document).ready(function() {

  let editor = CKEDITOR.replace( 'newsnote' );
            // when a change occuress in the edit set it to variable.
            editor.on( 'change', function( evt ) {
        // getData() returns CKEditor's HTML content.
        @this.set('Ndetails',evt.editor.getData() );
    });

    Livewire.on('setDetailsDataEvent',details=>{
        CKEDITOR.instances.newsnote.setData(details);
        @this.set('Ndetails',details);
    });

    Livewire.on('resetEmittedData',()=>{
        CKEDITOR.instances.newsnote.setData('');
        @this.set('Ndetails','');  
    });


    Livewire.on('showModalEvent',()=>{
        $('#displayContentModal').modal('show');
    });

  
});
</script>
@endsection
</div>
 


