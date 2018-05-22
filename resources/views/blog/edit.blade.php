@extends('main.main')

@section('title')
	<h2>Edit Blog</h2>
@stop

@section('description')
<div class="container">
 <div class="row">
  <div class="col-md-6 col-sm-6">

  	<form method="post" action="{{ route('/update') }}">
  		{{csrf_field()}}
  		<input type="hidden" class="form-control" id="id" value="{{  $blog->id }}">
  <div class="form-group">
    <label for="title">Title</label>
    <input type="title" class="form-control" id="title" value="{{  $blog->title }}">
  </div>
  <div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" id="description">{{  $blog->description }}</textarea>
    <!-- <textarea type="description" class="form-control" id="description" value={{'$blog->title'}}>textarea -->
  </div>
 <button type="submit" class="btn btn-default">Submit</button>
</form>
  </div>
 </div>
</div>	
@stop