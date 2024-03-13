<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Event List</title>
</head>
<body>
    <div class="container">
        <table class="table table-sm mt-5">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Title</th>
                    <th>Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            @php
                $no = 0
            @endphp
            <tbody>
                @foreach ($schedule as $item)
                <tr>
                    <td>{{ $no += 1 }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->start }}</td>
                    <td>{{ $item->meeting_start }} WIB</td>
                    <td>{{ $item->meeting_end }} WIB</td>
                    <td>{{ $item->description }}</td>
                    <td>
                        <a class="btn btn-warning" href="/get-event/{{$item->id}}">Update</a>
                        <a class="btn btn-danger" href="{{ route('delete-event', ['id' => $item->id]) }}">Delete</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>