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

$Routes->get( '/', 'AddKitHomeController@index' );
$Routes->match([ 'get', 'post' ], 'addkit/add', 'AddKitHomeController@add' );
$Routes->match([ 'get', 'post' ], 'addkit/edit/{id}', 'AddKitHomeController@edit' );
$Routes->match([ 'get', 'post' ], 'addkit/delete/{id}', 'AddKitHomeController@delete' );