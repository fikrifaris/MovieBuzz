@extends('layouts.app')

@section('content')
<h1>Welcome! This is the Movies page</h1>

<h2>MOVIES</h2>

<table class="table display" id="movie_table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Genre</th>
        <th>Released Date</th>
        <th>Created</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>

      @if($movies)

      @foreach ($movies as $movies)
          
      
      <tr>
        <td>{{ $movies->id }}</td>
        <td><a href="{{ route('movies.edit', $movies->id) }}">{{ $movies->title }}</a></td>
        <td>{{ $movies->genres->name}}</td>
        <td>{{ $movies->released_date }}</td>
        <td>{{ $movies->created_at }}</td>
      </tr>

      @endforeach

      @endif
     
    </tbody>
  </table>

  <script>
$(document).ready( function () {
    $('#movie_table').DataTable();
} );

$('#movie_table').DataTable( {
    ordering: true
} );
</script>
@stop 

