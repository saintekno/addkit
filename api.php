<?php
defined('BASEPATH') or exit('No direct script access allowed');

global $Routes;

$Routes->group(['prefix' => '/addkit'], function () use ( $Routes ) {
    $Routes->match([ 'get', 'post' ], '/', 'addkitApiController@index' );
});