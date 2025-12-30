@extends('genie.genielayout')
@section('content')

<div class="container">
    <h2>Manage Users</h2>
    <table class="table table-bordered" id="users-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr id="user-{{ $user->id }}">
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <select class="role-select" data-id="{{ $user->id }}">
                        <option value="user" {{ $user->role=='user' ? 'selected' : '' }}>User</option>
                        <option value="admin" {{ $user->role=='admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </td>
                <td>
                    <button class="btn btn-danger btn-sm delete-user" data-id="{{ $user->id }}">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){

    // Change role AJAX
    $('.role-select').change(function(){
        var user_id = $(this).data('id');
        var role = $(this).val();
        var row = $('#user-'+user_id);

        $.ajax({
            url: '{{ route("genie.user.updateRole") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                user_id: user_id,
                role: role
            },
            success: function(response){
                if(role === 'admin'){
                    row.fadeOut(); // remove row if promoted to admin
                }
            }
        });
    });

    // Delete user AJAX
    $('.delete-user').click(function(){
        if(!confirm('Are you sure you want to delete this user?')) return;

        var user_id = $(this).data('id');
        var row = $('#user-'+user_id);

        $.ajax({
            url: '/genie/users/' + user_id,
            method: 'DELETE',
            data: {_token: '{{ csrf_token() }}'},
            success: function(response){
                row.fadeOut();
            }
        });
    });

});
</script>
@endsection
