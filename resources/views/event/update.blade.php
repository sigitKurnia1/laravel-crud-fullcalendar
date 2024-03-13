<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Update Event</title>
</head>
<body>
    <div class="container mt-3">
        <div class="card" style="text-align: center">
            <div class="card-header">Update Data</div>
            <div class="card-body">
              <h5 class="card-title mb-2">Meeting Detail</h5>
              <form action="/update-event/{{$event->id}}" method="POST">
                @csrf
                <label class="form-label">Title</label>
                <input class="form-control mb-3" type="text" name="title" required value="{{ $event->title }}">
                <label class="form-label">Meeting Date</label>
                <input class="form-control mb-3" type="text" name="start" required value="{{ $event->start }}">
                <label class="form-label">Start Time</label>
                <input class="form-control mb-3" type="time" name="meeting_start" required value="{{ $event->meeting_start }}">
                <label class="form-label">End Time</label>
                <input class="form-control mb-3" type="time" name="meeting_end" required value="{{ $event->meeting_end }}">
                <label class="form-label">Description</label>
                <input class="form-control mb-3" type="text" name="description" required value="{{ $event->description }}">
                <button class="btn btn-success" type="submit">Update</button>
              </form>
            </div>
        </div>
    </div>
</body>
</html>