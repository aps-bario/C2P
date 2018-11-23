<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/ 

$active_group = 'hospitality';
$active_record = TRUE;

$db['oneway']['hostname'] = 'db507220741.db.1and1.com';
$db['oneway']['username'] = 'dbo507220741';
$db['oneway']['password'] = '0neWay!'; // Starts with zero
$db['oneway']['database'] = 'db507220741';   
$db['oneway']['dbdriver'] = 'mysql';
$db['oneway']['dbprefix'] = '';
$db['oneway']['pconnect'] = TRUE;
$db['oneway']['db_debug'] = TRUE;
$db['oneway']['cache_on'] = FALSE;
$db['oneway']['cachedir'] = '';
$db['oneway']['char_set'] = 'utf8';
$db['oneway']['dbcollat'] = 'utf8_general_ci';
$db['oneway']['swap_pre'] = '';
$db['oneway']['autoinit'] = TRUE;
$db['oneway']['stricton'] = FALSE;

$db['localhost']['hostname'] = 'localhost';
$db['localhost']['username'] = 'dbo423381344';
$db['localhost']['password'] = 'shaddai';
$db['localhost']['database'] = 'db423381344';   
$db['localhost']['dbdriver'] = 'mysql';
$db['localhost']['dbprefix'] = '';
$db['localhost']['pconnect'] = TRUE;
$db['localhost']['db_debug'] = TRUE;
$db['localhost']['cache_on'] = FALSE;
$db['localhost']['cachedir'] = '';
$db['localhost']['char_set'] = 'utf8';
$db['localhost']['dbcollat'] = 'utf8_general_ci';
$db['localhost']['swap_pre'] = '';
$db['localhost']['autoinit'] = TRUE;
$db['localhost']['stricton'] = FALSE;

$db['hospitality']['hostname'] = 'db423381344.db.1and1.com';
$db['hospitality']['username'] = 'dbo423381344';
$db['hospitality']['password'] = 'shaddai';
$db['hospitality']['database'] = 'db423381344';
$db['hospitality']['dbdriver'] = 'mysql';
$db['hospitality']['dbprefix'] = '';
$db['hospitality']['pconnect'] = TRUE;
$db['hospitality']['db_debug'] = TRUE;
$db['hospitality']['cache_on'] = FALSE;
$db['hospitality']['cachedir'] = '';
$db['hospitality']['char_set'] = 'utf8';
$db['hospitality']['dbcollat'] = 'utf8_general_ci';
$db['hospitality']['swap_pre'] = '';
$db['hospitality']['autoinit'] = TRUE;
$db['hospitality']['stricton'] = FALSE;


/* End of file database.php */
/* Location: ./application/config/database.php */