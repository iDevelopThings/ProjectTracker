# Project Time Tracker
I coded this in a couple of hours one night, so excuse the basicness.
It's simple, you create a project, to add a "time entry" you give a date, start time, end time, and notes.
You can publically give the URL for a project to your client, which will give them hour overviews, and allow them to see your time entries.

# Installation

Clone the Repository
```
git clone https://github.com/ScooterSam/ProjectTracker.git
```

Install packages
```
composer install
npm install
```

Copy the .env

```
cp .example.env .env
```

### Edit your .env file and create your database

```
php artisan migrate
```

## Register and have fun :)