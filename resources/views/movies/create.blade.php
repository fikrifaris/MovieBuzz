@extends('layouts.app')

@section('content')
<h1>Insert New Movies page</h1>

<h2>NEW MOVIES</h2>

<div class="container">
{!! Form::open(['method'=>'POST', 'action'=> 'MoviesController@store']) !!}
<div class="form-group">
  {!! Form::label('title', 'Title') !!}
  {!! Form::text('title', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('genre', 'Genre') !!}
  {!! Form::select('genre', [''=>'Choose Genre'] + $genres, null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('released_date', 'Released Date') !!}
                <input type="text" name="released_date" class="form-control datepicker">
 </div>

<div class="form-group">
   {!! Form::submit('Submit', ['class'=>'btn btn-primary']) !!}
</div>
{!! Form::close() !!}
</div>
@endsection

@section('scripts')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>
        $( function() {
            $( ".datepicker" ).datepicker({
                changeMonth: true,
                changeYear: true,
                format: 'dd-mm-yyyy'
               
            });
        });
    </script>
@endsection


