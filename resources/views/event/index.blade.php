<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Personal Schedule Tracker</title>
</head>
<body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <div class="input-group mb-3">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search events">
                    <div class="input-group-append">
                        <button id="searchButton" class="btn btn-primary">{{__('Search')}}</button>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <a class="btn btn-success" href="{{ route('export-events') }}" target="_blank">Export Events</a>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Create New Event
                </button>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div id="calendar" style="width: 100%"></div>
            </div>
        </div>
    </div>

    <!-- Modal create event -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="createForm" class="w-px-500 p-3 p-md-3 needs-validation" action="{{ route('create-event') }}" method="post" role="form">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Event</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card-body">              
                        <div class="row mb-3 form-group">
                            <label class="col-sm-3 col-form-label">Title</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="title" placeholder="Title" required>
                            </div>
                        </div>
                        <div class="row mb-3 form-group">
                            <label class="col-sm-3 col-form-label">Participant</label>
                            <div class="col-sm-9">
                                <select class="form-control" name="user_id" required>
                                    @foreach($user as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select> 
                            </div>
                        </div>
                        <div class="row mb-3 form-group">
                            <label class="col-sm-3 col-form-label">Start Date</label>
                            <div class="col-sm-9">
                                <input id="start" type="date" class="form-control" name="start" required>
                            </div>
                        </div>
                        <div class="row mb-3 form-group">
                            <label class="col-sm-3 col-form-label">Start Time</label>
                            <div class="col-sm-9">
                                <input id="startTime" type="time" class="form-control" name="start_time" required>
                            </div>
                        </div>
                        <div class="row mb-3 form-group">
                            <label class="col-sm-3 col-form-label">End Time</label>
                            <div class="col-sm-9">
                                <input id="endTime" type="time" class="form-control" name="end_time" required>
                                <div id="timeErrorMessage" class="text-danger" style="display: none;">End time must be greater than start time and in the future.</div>
                            </div>
                        </div>
                        <div class="row mb-3 form-group">
                            <label class="col-sm-3 col-form-label">Description</label>
                            <div class="col-sm-9">
                                <textarea class="form-control" name="description" placeholder="Description" cols="30" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="submitButton" type="submit" class="btn btn-primary">Create</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End create event modal -->

    <!-- Modal Detail Event -->
    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Event Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Title: </strong><span id="eventTitle"></span></p>
                    <p><strong>Participant: </strong><span id="eventParticipant"></span></p>
                    <p><strong>Start Date: </strong><span id="eventStartDate"></span></p>
                    <p><strong>Meeting Start: </strong><span id="meetingStart"></span></p>
                    <p><strong>Meeting End: </strong><span id="meetingEnd"></span></p>
                    <p><strong>Description: </strong><span id="eventDescription"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal Detail Event -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

    <script>
        
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var calendarEl = document.getElementById('calendar');
        var events = [];
        var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth'
            },
            initialView: 'dayGridMonth',
            timeZone: 'Asia/Jakarta',
            events: '/get-events',
            editable: false,
            eventClick: function(info) {
                $('#eventModal').modal('show');

                $('#eventTitle').text(info.event.title);
                $('#eventParticipant').text(info.event.extendedProps.participant);
                $('#eventStartDate').text(info.event.start.toLocaleDateString('id-ID', {weekday: 'long', day: 'numeric', month: 'long', year: 'numeric', timeZone: 'Asia/Jakarta'}));
                $('#eventDescription').text(info.event.extendedProps.description || '-');

                if (info.event.extendedProps.meeting_start && info.event.extendedProps.meeting_end) {
                    $('#meetingStart').text(info.event.extendedProps.meeting_start.toLocaleString('en-US', {timeZone: 'Asia/Jakarta'}) + ' WIB');
                    $('#meetingEnd').text(info.event.extendedProps.meeting_end.toLocaleString('en-US', {timeZone: 'Asia/Jakarta'}) + ' WIB');
                } else {
                    $('#meetingStart').text('-');
                    $('#meetingEnd').text('-');
                }
            }
        });

        calendar.render();

        //Search function
        document.getElementById('searchButton').addEventListener('click', function() {
            var searchKeywords = document.getElementById('searchInput').value.toLowerCase();
            filterAndDisplayEvents(searchKeywords);
        });

        function filterAndDisplayEvents(searchKeywords) {
            $.ajax({
                method: 'GET',
                url: `/search-events?title=${searchKeywords}`,
                success: function(response) {
                    calendar.removeAllEvents();
                    calendar.addEventSource(response);
                },
                error: function(error) {
                    console.error('Error searching events:', error);
                }
            });
        }

        //Event min & max date
        document.addEventListener('DOMContentLoaded', function() {
            var today = new Date().toISOString().split('T')[0];
            document.getElementById('start').setAttribute('min', today);
            document.getElementById('end').setAttribute('min', today);
        });

        //Validate date & time input
        document.addEventListener('DOMContentLoaded', function() {
            var createForm = document.getElementById('createForm');
            var startDateInput = document.getElementById('start');
            var startTimeInput = document.getElementById('startTime');
            var endTimeInput = document.getElementById('endTime');
            var timeErrorMessage = document.getElementById('timeErrorMessage');

            createForm.addEventListener('submit', function(event) {
                var startDate = new Date(startDateInput.value + 'T' + startTimeInput.value);
                var endDate = new Date(startDateInput.value + 'T' + endTimeInput.value);
                var now = new Date();

                if (startDate < now || endDate <= startDate || endDate <= now) {
                    event.preventDefault();
                    timeErrorMessage.style.display = 'block';
                }
            });
        });
    </script>
</body>
</html>