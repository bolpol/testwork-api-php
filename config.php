<?php
/**
 * Created by PhpStorm.
 * User: pirno
 * Date: 2/11/2019
 * Time: 1:01 PM
 */

// Database connection
defined("DBDRIVER")or define("DBDRIVER","mysql");
defined("DBHOST")or define("DBHOST","localhost");
defined("DBNAME")or define("DBNAME","simpleapitask");
defined("DBUSER")or define("DBUSER","root");
defined("DBPASS")or define("DBPASS","");

const CONNECTION = [
    'driver'    => DBDRIVER,
    'host'      => DBHOST,
    'database'  => DBNAME,
    'username'  => DBUSER,
    'password'  => DBPASS,
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
];