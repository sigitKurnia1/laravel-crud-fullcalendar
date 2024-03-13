<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Add User</title>
</head>
<body>
    @include('sweetalert::alert')
    <div class="container mt-3">
        <div class="card" style="text-align: center">
            <div class="card-header">Add Data</div>
            <div class="card-body">
              <h5 class="card-title mb-2">Add New User</h5>
              <form action="{{ route('store-user') }}" method="POST">
                @csrf
                <label class="form-label">Name</label>
                <input class="form-control mb-3" type="text" name="name" required>
                <label class="form-label">Email</label>
                <input class="form-control mb-3" type="email" name="email" required>
                <label class="form-label">Password</label>
                <input class="form-control mb-3" type="password" name="password" required>
                <button class="btn btn-success" type="submit">Create User</button>
              </form>
            </div>
        </div>
    </div>
</body>
</html>