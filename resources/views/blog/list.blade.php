@extends('main.main')

@section('title')
    <h2>Blog List</h2>
@stop

@section('description')

 <div class="container">
  <div class="row">
  <div class="col-md-4">
    <a href="blog/create" class="btn btn-primary">Add New</a>
    <a href="{{ url('downloadExcel/xls') }}" class="btn btn-success">xls</a>
    <!-- <a href="{{ url('downloadExcel/xlsx') }}" class="btn btn-success">xlsx</a> -->
    <!-- <a href="{{ url('downloadExcel/csv') }}" class="btn btn-success">csv</a> -->
  </div>
  <div class="col-md-offset-2 col-md-6 text-right">
    <form method="get" action="{{route('blog.index')}}">
      <div class="form-group col-md-9">
        <input type="text" placeholder="Enter Keywords" id="enter" name="enter" class="form-control" value="{{isset($enter)? $enter: ''}}">
      </div>
      <div class="form-group col-md-2">
        <button class="btn btn-primary" type="submit">Search</button>
      </div>
    </form>
  </div>
</div>
<hr>
 <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Description</th>
        <th>Date</th>
        <th>Time</th>
        <th>Has Artical</th>
        <th>File</th>
        <th colspan="2">Action</th>
      </tr>
    </thead>
    <tbody>
  @foreach($blogs as $blog)
      <tr>
        <td>{{$blog->id}}</td>
        <td>{{$blog->title}}</td> 
        <td>{{$blog->description}}</td>
        <td>{{$blog->created_at->format('d/m/Y')}}</td>
        <td>{{$blog->created_at->diffForHumans()}}</td>
        <td><?php

        // print_r(@$blog->ArticalRelation);
        foreach(@$blog->ArticalRelation as $k=>$v){
          echo $v->Article->artname;
          echo '<br>';
         }

        ?></td>
        
        <td>
         <!-- <strong><a href="{{URL::to('/').'/upload/'.$blog->fileUpload}}" target="_blank" title="{{$blog->fileUpload}}">{{$blog->fileUpload}}</a></strong> -->
         <!-- <strong><a href="{{storage_path().'/public/assets/upload/'.$blog->fileUpload}}" target="_blank" title="{{$blog->fileUpload}}">{{$blog->fileUpload}}</a></strong> -->

        <strong><a target="_blank" href="{{ URL::asset('storage/uploads/{$blog->fileUpload}') }}">{{$blog->fileUpload}}</a></strong>
       
        </td>
        <td>
          <a href="{{url('blog/'.$blog->id.'/edit')}}" class="btn btn-success"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
        </td>
        <td>
          {!! Form::open(['method'=>'delete' , 'route'=>['blog.destroy',$blog->id]]) !!}
          <!-- {!! Form::submit('Delete',['class'=>'btn btn-danger'])!!} -->
          <!-- delete with ajax -->
         <!-- <button class="deleteProduct btn btn-danger" data-id="{{ $blog->id }}" onclick="return confirm('Are you sure want to delete this blog?')" data-token="{{ csrf_token() }}" >Delete</button> -->
         <a href="{{ url('blog',$blog->id) }}" class="btn btn-danger btn-sm"
                           data-tr="tr_{{$blog->id}}"
                           data-toggle="confirmation"
                           data-btn-ok-label="Delete" data-btn-ok-icon="fa fa-remove"
                           data-btn-ok-class="btn btn-sm btn-danger"
                           data-btn-cancel-label="Cancel"
                           data-btn-cancel-icon="fa fa-chevron-circle-left"
                           data-btn-cancel-class="btn btn-sm btn-default"
                           data-title="Are you sure you want to delete ?"
                           data-placement="left" data-singleton="true">
                            <i class="fa fa-trash" aria-hidden="true"></i> </a>
          {!! Form::close() !!}
          <!-- <a href="" class="btn btn-danger">Delete</a> -->
        </td>
      </tr>
  @endforeach
   </tbody>
  </table>
  {{$blogs->appends(['enter'=>$enter])->links()}}
</div>

@stop

