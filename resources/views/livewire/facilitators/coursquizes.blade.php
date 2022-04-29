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
           
		    <div class="row">
				<div class="col-md-6">
					<div class="input-group">
					<input type="file" wire:model="excelfile" class="form-control" placeholder="Excel" aria-label="Username" aria-describedby="basic-addon1">
					<span class="btn-button btn-success input-group-text" id="basic-addon1"><button {{ (!$selectedQuiz) ? "disabled" : "" }}  wire:click="uploadQuestions" type="button" class="btn btn-success btn-sm">EXCEL UPLOAD</button></span>
					</div>
          <div wire:loading wire:target="uploadQuestions" class="spinner-border text-danger" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
          @error('excelfile') <span class="text-danger">{{ $message }}</span> @enderror 
				</div>
        <div class="col-md-3">
        <div class="input-group">
					<input type="text" wire:model="allocateQuizTime" value="{{ $selectedQuiz->time ?? '' }}" class="form-control" placeholder="Time" aria-label="Username" aria-describedby="basic-addon1">
					<span class="btn-button btn-success input-group-text" id="basic-addon1"><button {{ (!$selectedQuiz) ? "disabled" : "" }}  wire:click="updateTime" type="button" class="btn btn-success btn-sm">Update Time</button></span>
					</div>
          <div wire:loading wire:target="updateTime" class="spinner-border text-danger" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
          @error('allocateQuizTime') <span class="text-danger">{{ $message }}</span> @enderror 
        </div>
				<div class="col-md-3">
					<span class="badge bg-secondary">Due Date: {{ date('j M Y H:i:s',strtotime($selectedQuiz->duedate ?? '')) }}</span><br>
					<span class="badge bg-secondary">Allocated Time: {{ $selectedQuiz->time ?? '0' }}Minutes</span>
				</div>
			</div>
		   
           </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
            <h6 class="text-success"> Add Questions</h6>
            <hr class="text-success" />
                <div class="input-group mb-2">
                    <textarea class="form-control" wire:model="question" placeholder="Question (Stem)" aria-label="With textarea"></textarea>
                </div>
                <div class="input-group mb-2">
                <input type="text" wire:model="alt1" class="form-control" placeholder="Option 1" aria-label="Username" aria-describedby="basic-addon1">
                <input type="text" wire:model="alt2" class="form-control" placeholder="Option 2" aria-label="Username" aria-describedby="basic-addon1">
                <input type="text" wire:model="alt3" class="form-control" placeholder="Option 3" aria-label="Username" aria-describedby="basic-addon1">
                <input type="text" wire:model="alt4" class="form-control" placeholder="Option 4" aria-label="Username" aria-describedby="basic-addon1">
                </div>
                <div class="input-group mb-2">
                <input type="text" wire:model="answer" class="form-control" placeholder="Answer, separate with | for multiple select options" aria-label="Username" aria-describedby="basic-addon1">
                <span class="btn-button btn-success input-group-text" id="basic-addon1"><button {{ (!$selectedQuiz) ? "disabled" : "" }}  type="button" wire:click="saveQuestion" class="btn btn-success btn-sm">ADD QUESTION</button></span>
                </div>
                @error('question') <span class="text-danger">{{ $message }}</span> <br>@enderror 
                @error('alt1') <span class="text-danger">{{ $message }}</span> <br>@enderror   
                @error('alt2') <span class="text-danger">{{ $message }}</span> <br>@enderror  
                @error('alt3') <span class="text-danger">{{ $message }}</span> <br>@enderror  
                @error('alt4') <span class="text-danger">{{ $message }}</span> <br>@enderror  
                @error('answer') <span class="text-danger">{{ $message }}</span> <br>@enderror 

            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
            <div>
            <b>Total Questions:</b> {{ $counted }}
              <button {{ (!$selectedQuiz) ? "disabled" : "" }}  type="button" wire:click="clearQuestions" class="btn btn-danger btn-sm float-end">Clear ALL Questions</button>
              <hr class="text-success">
            </div>
            <table class="table table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">Question</th>
      <th scope="col">Option 1</th>
      <th scope="col">Option 2</th>
      <th scope="col">Option 3</th>
      <th scope="col">Option 4</th>
      <th scope="col">Answers</th> 
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($quizQuestions as $found)
    <tr>
      <th scope="row">{{ $found->id }}. {{ $found->question }}</th>
      <td>{{ $found->answer1 }}</td>   
      <td>{{ $found->answer2 }}</td>
      <td>{{ $found->answer3  }}</td>
      <td>{{ $found->answer4  }}</td>
      <td>{{  $found->answers }}</td>
      <td>
          <div class="btn-group btn-group-sm mb-4" role="group" aria-label="Small button group">
            <button wire:click="editQuestion({{ $found->id }})"  class="btn btn-info btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit align-middle me-2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg> </button>
            <button wire:click="deleteQuestion({{ $found->id }})" class="btn btn-danger btn-sm"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-delete align-middle me-2"><path d="M21 4H8l-7 8 7 8h13a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2z"></path><line x1="18" y1="9" x2="12" y2="15"></line><line x1="12" y1="9" x2="18" y2="15"></line></svg> </button>
				  </div>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
            <hr class="text-success">
             {{ $quizQuestions->links() }}
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
 


