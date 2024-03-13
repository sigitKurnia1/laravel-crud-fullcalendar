<!DOCTYPE html>
<html lang="en">
<head>
    <style>
    .center {
        margin-left: auto;
        margin-right: auto;
    }
    </style>
    <title>Data Meeting</title>
</head>
<body>
    <h3 style="text-align: center; font-family: sans-serif;">Data Meeting</h3>

    <div style="margin-top: 40px; font-family: sans-serif;">
        <table class="center"  border="1" cellspacing="0" cellpadding="5">
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Start Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Description</th>
            </tr>
            @php
            $no = 0
            @endphp
            @foreach ($data as $item)
            <tr>
                <td>{{ $no += 1 }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->start }}</td>
                <td>{{ $item->meeting_start }}</td>
                <td>{{ $item->meeting_end }}</td>
                <td>{{ $item->description }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</body>
</html>