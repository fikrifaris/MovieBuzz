@extends('layouts.app')

@section('content')
<section class="col-md-12 member-head">
<h1>Members</h1>
</section>

<section class="member">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            Members <a href="#" class="btn btn-success"  data-toggle="modal" data-target="#membersModal">Add New Members</a>
          </div>
          <div class="card-body">
            <table id="members_table" class="table">
              <thead>
                <tr>
                  <th>Name</th>
                  <th>Age</th>
                  <th>Address</th>
                  <th>Telephone</th>
                  <th>Identity Number</th>
                  <th>Date of Joined</th>
                  <th>Is Active</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($members as $members)
                    <tr id="sid{{ $members->id }}">
                      <td>{{ $members->name }}</td>
                      <td>{{ $members->age }}</td>
                      <td>{{ $members->address }}</td>
                      <td>{{ $members->telephone }}</td>
                      <td>{{ $members->identity_number }}</td>
                      <td>{{ $members->date_of_joined }}</td>
                      <td>{{ $members->is_active == 0 ? 'Not Active' : 'Active' }}</td>
                      <td>
                        <a href="javascript:void(0)" onclick="editMembers({{ $members->id }})" class="btn btn-info">Edit</a>
                        <a href="javascript:void(0)" onclick="deleteMembers({{ $members->id }})" class="btn btn-danger">Delete</a>
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

<!-- Add Members Modal -->
<div class="modal fade" id="membersModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Members</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="membersForm">
          @csrf
          <div class="form-group">
            <label for="title">Name</label>
            <input type="text" class="form-control" id="name"/>
          </div>
          <div class="form-group">
            <label for="title">Age</label>
            <input type="text" class="form-control" id="age"/>
          </div>
          <div class="form-group">
            <label for="title">Address</label>
            <input type="text" class="form-control" id="address"/>
          </div>
          <div class="form-group">
            <label for="title">Telephone</label>
            <input type="text" class="form-control" id="telephone"/>
          </div>
          <div class="form-group">
            <label for="title">Identity number</label>
            <input type="text" class="form-control" id="identity_number"/>
          </div>
          <button type="submit" id="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit Member Modal -->
<div class="modal fade" id="editMembersModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Members</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editMembersForm">
          @csrf
          <input type="hidden" id="id" name="id">
          <div class="form-group">
            <label for="title">Name</label>
            <input type="text" class="form-control" id="name2"/>
          </div>
          <div class="form-group">
            <label for="title">Age</label>
            <input type="text" class="form-control" id="age2"/>
          </div>
          <div class="form-group">
            <label for="title">Address</label>
            <input type="text" class="form-control" id="address2"/>
          </div>
          <div class="form-group">
            <label for="title">Telephone</label>
            <input type="text" class="form-control" id="telephone2"/>
          </div>
          <div class="form-group">
            <label for="title">Identity number</label>
            <input type="text" class="form-control" id="identity_number2"/>
          </div>
          <div class="form-group">
            <label for="title">Is Active?</label>
            <select name="is_active" id="is_active2" form="membersForm">
              <option value="1">Yes</option>
              <option value="0">No</option>
            </select>
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
      $('#members_table').DataTable();
  } );
  </script>

   {{-- ADD MEMBER --}}
   <script>
  $("#membersForm").submit(function(e){
    e.preventDefault();

    let name = $("#name").val();
    let age = $("#age").val();
    let address = $("#address").val();
    let telephone = $("#telephone").val();
    let identity_number = $("#identity_number").val();
    let _token = $("input[name=_token]").val();

    $.ajax({
      url: "{{ route('members.store') }}",
      type: "POST",
      data: {
        name: name,
        age: age,
        address: address,
        telephone: telephone,
        identity_number: identity_number,
        _token: _token
      },
      success: function (response) {
        if (response) {
          $("#members_table tbody").prepend('<tr><td>' + response.name + '</td><td>' + response.age + '</td><td>' + response.address + '</td><td>' + response.telephone + '</td><td>' + response.identity_number + '</td></tr>');
          $("#membersForm")[0].reset();
          $("#membersModal").modal('hide');
        }
        Swal.fire(
          'Success!',
          'Member Added',
          'success'
        )
      }
    });
  });
  </script>

  {{-- EDIT MEMBER --}}
  <script>
    function editMembers(id) {
      $.get('/members/' + id + '/edit', function (members) {
        $("#id").val(members.id);
        $("#name2").val(members.name);
        $("#age2").val(members.age);
        $("#address2").val(members.address);
        $("#telephone2").val(members.telephone);
        $("#identity_number2").val(members.identity_number);
        $("#is_active2").val(members.is_active);
        $("#editMembersModal").modal('toggle');
      });
    }

  $("#editMembersForm").submit(function(e){
    e.preventDefault();
    let id = $("#id").val();
    let name = $("#name2").val();
    let age = $("#age2").val();
    let address = $("#address2").val();
    let telephone = $("#telephone2").val();
    let identity_number = $("#identity_number2").val();
    let is_active = $("#is_active2").val();
    let _token = $("input[name=_token]").val();

    $.ajax({
      url: "{{ route('members.update', $members-> id)}}",
      type: "PUT",
      data: {
        id: id,
        name: name,
        age: age,
        address: address,
        telephone: telephone,
        identity_number: identity_number,
        is_active: is_active,
        _token: _token
      },
      success: function (response) {
        $('#sid' + response.id + ' td:nth-child(1)').text(response.name);
        $('#sid' + response.id + ' td:nth-child(2)').text(response.age);
        $('#sid' + response.id + ' td:nth-child(3)').text(response.address);
        $('#sid' + response.id + ' td:nth-child(4)').text(response.telephone);
        $('#sid' + response.id + ' td:nth-child(5)').text(response.identity_number);
        $('#sid' + response.id + ' td:nth-child(6)').text(response.date_of_joined);
        $('#sid' + response.id + ' td:nth-child(7)').text(response.is_active);
        $("#editMembersModal").modal('toggle');
        $("#editMembersForm")[0].reset();
        Swal.fire(
          'Success!',
          'Member Updated',
          'success'
        )
      }
      
    });
  });
  </script>

   
    {{-- DELETE MEMBER --}}
    <script>
      function deleteMembers(id)
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
                'Member has been deleted.',
                'success'
              )
               $.ajax({
            url:'/members/'+id,
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

