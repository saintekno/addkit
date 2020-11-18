<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * SainSuite
 *
 * Engine Management System
 *
 * @package     SainSuite
 * @copyright   Copyright (c) 2019-2020 Buddy Winangun, Eracik.
 * @copyright   Copyright (c) 2020 SainTekno, SainSuite.
 * @link        https://github.com/saintekno/sainsuite
 * @filesource
 */

global $Routes;

$Routes->group(['prefix' => '/addkit'], function () use ( $Routes ) {
    $Routes->match([ 'get', 'post' ], '/', 'AddKit_Controller@index' );
    $Routes->match([ 'get', 'post' ], 'add', 'AddKit_Controller@add' );
    $Routes->match([ 'get', 'post' ], 'edit/{id}', 'AddKit_Controller@edit' );
    $Routes->match([ 'get', 'post' ], 'delete/{id}', 'AddKit_Controller@delete' );
});