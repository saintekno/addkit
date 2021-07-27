<?php
defined('BASEPATH') or exit('No direct script access allowed');

global $Routes;

$Routes->group(['prefix' => '/addkit'], function () use ( $Routes ) {
    $Routes->match([ 'get', 'post' ], '/', 'AddKit_Controller@index' );
    $Routes->match([ 'get', 'post' ], 'add', 'AddKit_Controller@add' );
    $Routes->match([ 'get', 'post' ], 'edit/{id}', 'AddKit_Controller@edit' );
    $Routes->match([ 'get', 'post' ], 'delete/{id?}/{redirect?}', 'AddKit_Controller@delete' );
});