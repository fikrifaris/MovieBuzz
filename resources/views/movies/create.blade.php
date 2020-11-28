@extends('layouts.master')

@section('content')
<h1>Insert New Movies page</h1>

<h2>NEW MOVIES</h2>

{!! Form::open(['method'=>'POST', 'action'=> 'MoviesController@store']) !!}
<div class="form-group">
  {!! Form::label('title', 'Title') !!}
  {!! Form::text('title', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
  {!! Form::label('genre', 'Genre') !!}
  {!! Form::select('genre', array('C' => 'Comedy', 'H' => 'Horror', 'R' => 'Romance')) !!}
</div>

<div class="form-group">
  {!! Form::label('date', 'Date: ' ) !!}
  {!! Form::selectMonth('month') !!}

</div>

<div class="form-group">
   {!! Form::submit('Save', ['class'=>'btn btn-primary']) !!}
</div>
{!! Form::close() !!}

@stop 

