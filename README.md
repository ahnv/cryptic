# Cryptic Hunt

Cryptic Hunt features
  - Admin Panel
  - Logging using PaperTrail
  - Leaderboard
  - Config file with event start and end timing 

Logging includes
  - When user clears a level
  - PHP Errors
  - All admin panel authorizations including 401
  - 404 page is used to log if anyone tries directory scanning.

### Tech

* [Twitter Bootstrap] - great UI boilerplate for modern web apps
* PHP - Backend
* [jQuery] - duh

### Installation

Use PHPMyAdmin to upload the Table definitions to a database.
Update the MySQL variables in ```cryptic/config/db.php```

Set papertail destination and port into ```master/classes/Logger.php```

Upload the folder onto server local/hosting. If using a hosting, set LIVE to true.
Update the variables in ```cryptic/config/consts.php```

```
if (LIVE){
  define('ORIGIN', 'ncrypt.net.in');
  define( 'SITE_URL',     'https://*****.***/cryptic/' );
  define( 'SSTATIC',      'https://*****.***/cryptic/_static/' );
}
```


### Development

Want to contribute? Great!

Make a change in your file, commit to a seperate branch and raise a pull request!
