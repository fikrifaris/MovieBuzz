@extends('layouts.app')

@section('content')
<section class="col-md-12 movie-head">
<h1>Movies</h1>
</section>

<section class="movies">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <a href="#" class="btn btn-success"  data-toggle="modal" data-target="#moviesModal">Add New Movies</a>
          </div>
          <div class="card-body">
            <table id="movie_table" class="table">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Genre</th>
                  <th>Released Date</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($movies as $movies)
                    <tr id="sid{{ $movies->id }}">
                      <td>{{ $movies->title }}</td>
                      <td>{{ $movies->genres->name}}</td>
                      <td>{{ $movies->released_date }}</td>
                      <td>
                        <a href="javascript:void(0)" onclick="editMovies({{ $movies->id }})" class="btn btn-info">Edit</a>
                        <a href="javascript:void(0)" onclick="deleteMovie({{ $movies->id }})" class="btn btn-danger">Delete</a>
                      </td>
                    </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Add Movie Modal -->
<div class="modal fade" id="moviesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Movies</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="movieForm">
          @csrf
          <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" placeholder="Enter Movie Title"/>
          </div>
          <div class="form-group">
            <label for="genre">Genre</label>
            {!! Form::select('genre', [''=>'Choose Genre'] + $genres, null, ['class'=>'form-control', 'id'=>'genre']) !!}
          </div>
          <div class="form-group">
            <label for="released_date">Released Date</label>
            <input type="text" class="form-control datepicker" id="released_date" placeholder="Select Date"/>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit Movie Modal -->
<div class="modal fade" id="editMoviesModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Movie</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editMovieForm">
          @csrf
          <input type="hidden" id="id" name="id">
          <div class="form-group">
            <label for="title">Title</label>
            @error('title')
            <span class="text-danger">{{ $message }}</span>
            @enderror
            <input type="text" class="form-control" id="title2"/>
          </div>
          <div class="form-group">
            <label for="genre">Genre</label>
            @error('genre')
            <span class="text-danger">{{ $message }}</span>
            @enderror
            {!! Form::select('genre', [''=>'Choose Genre'] + $genres, null, ['class'=>'form-control', 'id'=>'genre2']) !!}
          </div>
          <div class="form-group">
            <label for="released_date">Released Date</label>
            @error('released_date')
            <span class="text-danger">{{ $message }}</span>
            @enderror
            <input type="text" class="form-control datepicker" id="released_date2"/>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
   
  <script>
  $(document).ready( function () {
      $('#movie_table').DataTable();
  } );
  </script>
   
   <script>
        $( function() {
            $( ".datepicker" ).datepicker({
                changeMonth: true,
                changeYear: true,
                format: 'dd-mm-yyyy'
               
            });
        });
    </script>

    {{-- ADD MOVIE --}}
    <script>
      $("#movieForm").submit(function(e){
        e.preventDefault();

        let title = $("#title").val();
        let genre = $("#genre").val();
        let released_date = $("#released_date").val();
        let _token = $("input[name=_token]").val();

        $('#titleError').addClass('d-none');

        $.ajax({
          url: "{{route('movies.store')}}",
          type:"POST",
          data:{
            title:title,
            genre:genre,
            released_date:released_date,
            _token:_token
          },
          success:function(response)
          {
            if(response)
            {
              $("#movie_table tbody").prepend('<tr><td>'+ response.title+'</td><td>'+ response.genre +'</td><td>'+ response.released_date +'</td></tr>');
              $("#movieForm")[0].reset();
              $("#moviesModal").modal('hide');
            }
            Swal.fire(
          'Success!',
          'Movie Added',
          'success'
        )
          }
        });
      });
    </script>


    {{-- EDIT MOVIE --}}
    <script>
      function editMovies(id)
      {
        $.get('/movies/'+id+'/edit',function(movies){
          $("#id").val(movies.id);
          $("#title2").val(movies.title);
          $("#genre2").val(movies.genre);
          $("#released_date2").val(movies.released_date);
          $("#editMoviesModal").modal('toggle');
        });
      }

      $("#editMovieForm").submit(function(e){
        e.preventDefault();
        let id = $("#id").val();
        let title = $("#title2").val();
        let genre = $("#genre2").val();
        let released_date = $("#released_date2").val();
        let _token = $("input[name=_token]").val();

        $.ajax({
          url: "{{route('movies.update', $movies->id)}}",
          type:"PUT",
          data:{
            id:id,
            title:title,
            genre:genre,
            released_date:released_date,
            _token:_token
          },
          success:function(response){
            $('#sid' + response.id +' td:nth-child(1)').text(response.title);
            $('#sid' + response.id +' td:nth-child(2)').text(response.genre);
            $('#sid' + response.id +' td:nth-child(3)').text(response.released_date);
            $("#editMoviesModal").modal('toggle');
            $("#editMovieForm")[0].reset();
            Swal.fire(
          'Success!',
          'Movie Updated',
          'success'
        )
          }
        });
      });
    </script>

    {{-- DELETE MOVIE --}}
    <script>
      function deleteMovie(id)
      {

                    Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.isConfirmed) {
                Swal.fire(
                  'Deleted!',
                  'Movies has been deleted.',
                  'success'
                )
                $.ajax({
            url:'/movies/'+id,
            type:'DELETE',
            data:{
              _token : $("input[name=_token]").val()
            },
            success:function(response)
            {
              $("#sid"+id).remove();
            }
          });
              }
            })
      }
    </script>
@endsection

