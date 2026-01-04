@extends('genie.genielayout')
@section('content')

<div class="container py-5">

    <!-- PAGE TITLE -->
    <div class="mb-4 text-center">
        <h2 class="fw-bold page-title">Manage Users</h2>
        <p class="text-muted">Control user roles and access</p>
    </div>

    <!-- CARD -->
    <div class="card user-card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">

            <div class="table-responsive">
                <table class="table align-middle user-table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($users as $user)
                        <tr id="user-{{ $user->id }}">
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar">
                                        {{ strtoupper(substr($user->name,0,1)) }}
                                    </div>
                                    <span class="fw-semibold">{{ $user->name }}</span>
                                </div>
                            </td>

                            <td class="text-muted">{{ $user->email }}</td>

                            <td>
                                <select class="form-select role-select" data-id="{{ $user->id }}">
                                    <option value="user" {{ $user->role=='user' ? 'selected' : '' }}>User</option>
                                    <option value="admin" {{ $user->role=='admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                            </td>

                            <td class="text-end">
                                <button class="btn btn-delete delete-user" data-id="{{ $user->id }}">
                                    Delete
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </div>
</div>

<!-- STYLES -->
<style>
/* ===== PAGE ===== */
.page-title {
    color: #3f3d56;
    letter-spacing: 0.3px;
}

/* ===== CARD ===== */
.user-card {
    background: linear-gradient(180deg, #ffffff, #f9f9ff);
}

/* ===== TABLE ===== */
.user-table thead th {
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.06em;
    color: #6b7280;
    border-bottom: 1px solid #eee;
}

.user-table tbody tr {
    transition: all 0.3s ease;
}

.user-table tbody tr:hover {
    background: rgba(99,102,241,0.05);
    transform: scale(1.01);
}

/* ===== AVATAR ===== */
/* ===== AVATAR ===== */
.avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, #111827, #000000); /* black */
    color: #ffffff;
    font-weight: 700;
    display: flex;
    align-items: center;
    justify-content: center;
}


/* ===== SELECT ===== */
.form-select {
    border-radius: 12px;
    border: 1px solid #e5e7eb;
    padding: 8px 12px;
    font-weight: 500;
}

.form-select:focus {
    border-color: #6366f1;
    box-shadow: 0 0 0 4px rgba(99,102,241,0.2);
}

/* ===== DELETE BUTTON ===== */
/* ===== DELETE BUTTON (HOT PINK) ===== */
.btn-delete {
    background: linear-gradient(135deg, #e91e63, #ff5fa2);
    color: white;
    border: none;
    padding: 6px 14px;
    border-radius: 12px;
    font-size: 0.85rem;
    font-weight: 600;
    letter-spacing: 0.3px;
    transition: all 0.3s ease;
}

.btn-delete:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 28px rgba(233,30,99,0.45);
}

.btn-delete:focus {
    box-shadow: 0 0 0 4px rgba(233,30,99,0.25);
}

</style>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){

    // Change role
    $('.role-select').change(function(){
        let user_id = $(this).data('id');
        let role = $(this).val();
        let row = $('#user-'+user_id);

        $.ajax({
            url: '{{ route("genie.user.updateRole") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                user_id: user_id,
                role: role
            },
            success: function(){
                if(role === 'admin'){
                    row.fadeOut(400);
                }
            }
        });
    });

    // Delete user
    $('.delete-user').click(function(){
        if(!confirm('Delete this user permanently?')) return;

        let user_id = $(this).data('id');
        let row = $('#user-'+user_id);

        $.ajax({
            url: '/genie/users/' + user_id,
            method: 'DELETE',
            data: {_token: '{{ csrf_token() }}'},
            success: function(){
                row.fadeOut(400);
            }
        });
    });

});
</script>

@endsection
