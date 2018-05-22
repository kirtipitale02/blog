@extends('main.main')

@section('title')
	<h2>Add New Blog</h2>
@stop

@section('description')
<div class="container">
 <div class="row">
  <div class="col-md-6 col-sm-6">
 <!-- <form role="form" action="{{route('blog.store')}}" method="post" enctype="multipart/form-data" id="form3"> -->
	{!! Form::open(['url' =>'blog','method'=>'POST','files'=>true]) !!}
	{{ csrf_field() }}
	<div class="form-group">
	  <!-- <label for="title">Title:</label> -->
	  {!! Form::label('title','Title') !!}
	  <!-- <input type="text" class="form-control" id="title" placeholder="Enter Title" name="title"> -->
	  {!! Form::text('title', null, ['class'=>'form-control']) !!}
	  <!-- {!! $errors->has('title')?$errors->first('title'): ''!!} -->
	  @if($errors->has('title'))<p class="help-block">{{$errors->first('title')}}</p>
	  @endif
	</div>
	<div class="form-group">
	  <!-- <label for="discription">Discription:</label> -->
	  {!! Form::label('description','Description') !!}
	  {!! Form::textarea('description', null ,['class'=>'form-control']) !!}
	  <!-- {!! $errors->has('description')?$errors->first('description'): ''!!} -->
	  @if($errors->has('description'))<p class="help-block">{{$errors->first('description')}}</p>
	  @endif
	  <!-- <input type="text" class="form-control" id="discription" placeholder="Enter Discription" name="discription"> -->
	</div>
	<div class="form-group">
     <select class="chosen" multiple="true" id="artical" name="artical[]" style="width:400px;">
	<option>Choose...</option>
	 @foreach ($artname as $art) 
          {
             <option value="{{ $art->id }}">{{ $art->artname }}</option>
          }
     @endforeach
	
    </select>
	</div>

	<div class="form-group">
    <label for="fileUpload">Select File</label>
    <input type="file" class="form-control" id="fileUpload" name="fileUpload" >
    @if($errors->has('fileUpload'))<p class="help-block">{{$errors->first('fileUpload')}}</p>
	@endif

  </div>
	<!-- <button type="submit" class="btn btn-default">Submit</button> -->
	{!! Form::submit('Submit',['class'=>'btn btn-default'])!!}
<!-- </form> -->
	{!! Form::close() !!}
	</div>
 </div>
</div>	
<script>
@if(Session::has('message')){
	var type = "{{ Session::get('alert-type',info) }}";
	switch(type){

		  case 'success':
		        toastr.success("{{Session::get('message')}}");
		        break;

         case 'error':
		        toastr.error("{{Session::get('message')}}");
		        break;
	}
}
@endif
</script>
@stop