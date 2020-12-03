@extends('layouts.app')

@section('content')
<section class="col-md-12 lend-head">
<h1>Lending</h1>
</section>

<section class="lending">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            Lending <a href="#" class="btn btn-success"  data-toggle="modal" data-target="#lendModal">Lend to Member</a>
          </div>
          <div class="card-body">
            <table id="lend_table" class="table">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Member</th>
                  <th>Movie</th>
                  <th>Lending Date</th>
                  <th>Lateness Charge</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($lending as $lending)
                    <tr id="sid{{ $lending->id }}">
                      <td>{{ $lending->id }}</td>
                      <td>{{ $lending->members->name }}</td>
                      <td>{{ $lending->movies->title }}</td>
                      <td>{{ $lending->lending_date }}</td>
                      <td>{{ $lending->lateness_charge }}</td>
                      <td>
                        <a href="javascript:void(0)" onclick="editLend({{ $lending->id }})" class="btn btn-info">Edit</a>
                        <a href="javascript:void(0)" onclick="deleteLend({{ $lending->id }})" class="btn btn-danger">Delete</a>
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

<!-- Add Lend Modal -->
<div class="modal fade" id="lendModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Lend Movies</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="lendForm">
          @csrf
          <div class="form-group">
            <label for="member">Member</label>
             {!! Form::select('members', [''=>'Choose Member'] + $act_member, null, ['class'=>'form-control', 'id'=>'members']) !!}
          </div>
          <div class="form-group">
            <label for="movies">Movies</label>
            {!! Form::select('movies', [''=>'Choose Movie'] + $movies, null, ['class'=>'form-control', 'id'=>'movies']) !!}
          </div>
          <div class="form-group">
            <label for="lending_date">Lending Date</label>
            <input type="text" class="form-control datepicker" id="lending_date" placeholder="Select Date"/>
          </div>
          <div class="form-group">
            <label for="lateness_charge">lateness_charge</label>
            <input type="text" class="form-control" id="lateness_charge"/>
          </div>
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit Lend Modal -->
<div class="modal fade" id="editlendModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Lend Movies</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editlendForm">
          @csrf
          <div class="form-group">
            <label for="member">Member</label>
             {!! Form::select('members', [''=>'Choose Member'] + $members, null, ['class'=>'form-control', 'id'=>'members2', 'disabled']) !!}
          </div>
          <div class="form-group">
            <label for="movies">Movies</label>
            {!! Form::select('movies', [''=>'Choose Movie'] + $movies, null, ['class'=>'form-control', 'id'=>'movies2']) !!}
          </div>
          <div class="form-group">
            <label for="lending_date">Lending Date</label>
            <input type="text" class="form-control datepicker" id="lending_date2"/>
          </div>
          <div class="form-group">
            <label for="lateness_charge">lateness_charge</label>
            <input type="text" class="form-control" id="lateness_charge2"/>
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
      $('#lend_table').DataTable();
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

        {{-- LEND MOVIE --}}
    <script>
      $("#lendForm").submit(function(e){
        e.preventDefault();

        let members = $("#members").val();
        let movies = $("#movies").val();
        let lending_date = $("#lending_date").val();
        let lateness_charge = $("#lateness_charge").val();
        let _token = $("input[name=_token]").val();

        $.ajax({
          url: "{{route('lending.store')}}",
          type:"POST",
          data:{
            members:members,
            movies:movies,
            lending_date:lending_date,
            lateness_charge:lateness_charge,
            _token:_token
          },
          success:function(response)
          {
            if(response)
            {
              $("#lend_table tbody").prepend('<tr><td>'+ response.id+'</td><td>'+ response.members +'</td><td>'+ response.movies +'</td><td>'+ response.lending_date +'</td><td>'+ response.lateness_charge +'</td><td>'+ response.action +'</td></tr>');
              $("#lendForm")[0].reset();
              $("#lendModal").modal('hide');
              Swal.fire(
          'Success!',
          'Movie Lended',
          'success'
        )
            }
          }
        });
      });
    </script>

     {{-- EDIT LEND MOVIE --}}
    <script>
      function editLend(id)
      {
        $.get('/lending/'+id+'/edit',function(lending){
          $("#id").val(lending.id);
          $("#members2").val(lending.member_id);
          $("#movies2").val(lending.movie_id);
          $("#lending_date2").val(lending.lending_date);
          $("#lateness_charge2").val(lending.lateness_charge);
          $("#editlendModal").modal('toggle');
        });
      }

      $("#editlendForm").submit(function(e){
        e.preventDefault();
        let id = $("#id").val();
        let members = $("#members2").val();
        let movies = $("#movies2").val();
        let lending_date = $("#lending_date2").val();
        let lateness_charge = $("#lateness_charge2").val();
        let _token = $("input[name=_token]").val();

        $.ajax({
          url: "{{route('lending.update', $lending->id)}}",
          type:"PUT",
          data:{
            id:id,
            members:members,
            movies:movies,
            lending_date:lending_date,
            lateness_charge:lateness_charge,
            _token:_token
          },
          success:function(response){
            $('#sid' + response.id +' td:nth-child(1)').text(response.members);
            $('#sid' + response.id +' td:nth-child(2)').text(response.movies);
            $('#sid' + response.id +' td:nth-child(3)').text(response.lending_date);
            $('#sid' + response.id +' td:nth-child(4)').text(response.lateness_charge);
            $("#editlendModal").modal('toggle');
            $("#editlendForm")[0].reset();
            Swal.fire(
          'Success!',
          'Record Updated',
          'success'
        )
          }
        });
      });
    </script>

     {{-- DELETE MOVIE --}}
    <script>
      function deleteLend(id)
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
                  'Record has been deleted.',
                  'success'
                )
                $.ajax({
            url:'/lending/'+id,
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