<!DOCTYPE html>
<html lang="en">
<head>
  <title>Blog Form Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- cdn for toaster -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  <!-- cdn for toaster -->
 
  <script src="{{ asset('plugin/chosen/chosen.jquery.js') }}"></script>
  <link href="{{ asset('plugin/chosen/chosen.css') }}" rel="stylesheet"> 
   
   <script src="{{ asset('plugin/chosen/chosen.jquery.min.js') }}"></script>
   <link href="{{ asset('plugin/chosen/chosen.min.css') }}" rel="stylesheet">
</head>
<style type="text/css">.help-block{color:red;}</style>

<body>

<div class="container">

  <div class="container">
  	<div class="page-header">
  		@yield('title')
  	<div>
  		@yield('description')
  </div>

</div>

<script type="text/javascript">
jQuery(document).ready(function(){
  jQuery(".chosen").data("placeholder","Select Articles...").chosen();
});
</script>
 <!-- jquery for validation script -->
  
<script src="{{ asset('js/form_validation_delete.js') }}"></script>
</body>
</html>
