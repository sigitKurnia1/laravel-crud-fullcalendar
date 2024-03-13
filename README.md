
# CRUD Laravel Event

This project is an implementation of laravel fullcalendar along with sending emails using GMTP from google. This project is only an example that you can use as a reference to learn or implement some of the functions contained in this project. You are free to use this project, but I am happy if you include this link as a reference to your project.
## Function

The following are the features contained in this project:
- Search for events by title.
- Print event data in pdf form.
- Create a new event.
- Display modal details from the fullcalendar event view.
- Make changes to the event.
- Delete event data.
- Add a new user.
- Delete user data.
- Make changes to user data.
- Send an email based on the user's email when the event was created.
## Route

The following is the route contained in the web.php file

##### Event route
- Route::get('/', [EventController::class, 'index']);
- Route::get('/get-events', [EventController::class, 'getEvents']);
- Route::post('/create-event', [EventController::class, 'createEvent'])->name('create-event');
- Route::get('/search-events', [EventController::class, 'searchEvents']);
- Route::get('/export-events', [EventController::class, 'exportEvents'])->name('export-events');
- Route::get('/event-list', [EventController::class, 'eventList']);
- Route::get('/get-event/{id}', [EventController::class, 'getEventId']);
- Route::post('/update-event/{id}', [EventController::class, 'updateEvent']);
- Route::get('/delete-event/{id}', [EventController::class, 'deleteEvent'])->name('delete-event');

##### User route
- Route::get('/user-data', [UserController::class, 'index'])->name('user-data');
- Route::get('/add-user', [UserController::class, 'storeView'])->name('add-user');
- Route::post('/store-user', [UserController::class, 'store'])->name('store-user');
- Route::get('/update-user/{id}', [UserController::class, 'updateView'])->name('update-user');
- Route::post('/update-user-data/{id}', [UserController::class, 'update'])->name('update-user-data');
- Route::delete('/destroy-user/{id}', [UserController::class, 'destroy'])->name('destroy-user');
## Library / Package

- Fullcalendar [https://fullcalendar.io](https://fullcalendar.io)
- Sweetalert [https://github.com/barryvdh/laravel-dompdf](https://github.com/barryvdh/laravel-dompdf)
- dompdf [https://realrashid.github.io/sweet-alert/](https://realrashid.github.io/sweet-alert/)
## Installation

After cloning this project, run these command below

Install the composer by running this command
```bash
  composer install
```
Update the composer by running this command
```bash
  composer update
```
Copy the .env.example and rename to .env and run this command
```bash
  php artisan key:generate
```
publish the package by running this command
```bash
  php artisan vendor:publish --all
```
After that, set your own database in the .env file.
Dont forget to add this to the .env file.
```bash
#Sweetalert
SWEET_ALERT_CONFIRM_DELETE_CONFIRM_BUTTON_TEXT='Yes, delete it!'
SWEET_ALERT_CONFIRM_DELETE_CANCEL_BUTTON_TEXT='No, cancel'
SWEET_ALERT_CONFIRM_DELETE_SHOW_CANCEL_BUTTON=true
SWEET_ALERT_CONFIRM_DELETE_SHOW_CLOSE_BUTTON=false
SWEET_ALERT_CONFIRM_DELETE_ICON='warning'
SWEET_ALERT_CONFIRM_DELETE_SHOW_LOADER_ON_CONFIRM=true

#Gmail smtp
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=465
MAIL_USERNAME=your@gmail.com
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your@gmail.com
MAIL_FROM_NAME="Email Title"
```