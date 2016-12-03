<?php
define('LIVE', false);

if (!LIVE){
  define('ORIGIN', 'localhost');
  define( 'SITE_URL',     'http://localhost/cryptic/' );
  define( 'SSTATIC',      'http://localhost/cryptic/_static/' );
}
if (LIVE){
  define('ORIGIN', 'ncrypt.net.in');
  define( 'SITE_URL',     'https://*****.***/cryptic/' );
  define( 'SSTATIC',      'https://*****.***/cryptic/_static/' );
}
define( 'EVENT_START_VAL',   '2016-11-19 00:00:00' ) ;
define( 'EVENT_END_VAL',   '2016-11-20 17:59:59' ) ;
define( 'EVENT_START',  strtotime( EVENT_START_VAL ) );
define( 'EVENT_END',  strtotime( EVENT_END_VAL ) );

define( 'EVENT_NOT_STARTED',  0 );
define( 'EVENT_STARTED',    1 );
define( 'EVENT_CLOSED',     2 );

define('RAND', 'UqHmx3Z92kPBeVUF7JbaAg825kkG8m4cG9usg6NLkUj3txLWrBqJFg5fMqCShEuf');
