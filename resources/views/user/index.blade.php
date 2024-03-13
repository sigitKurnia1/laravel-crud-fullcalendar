<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>User Data</title>
</head>
<body>
    @include('sweetalert::alert')
    <div class="container">
        <a class="btn btn-primary mt-5" href="{{ route('add-user') }}">Add User</a>
        <table class="table table-sm mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            @php
                $no = 0
            @endphp
            <tbody>
                @foreach ($user as $item)
                <tr>
                    <td>{{ $no += 1 }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>
                        <a class="btn btn-warning" href="{{ route('update-user', $item->id) }}">Update</a>
                        <a class="btn btn-danger" href="{{ route('destroy-user', $item->id) }}" data-confirm-delete="true">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>