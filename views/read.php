<?php

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

$complete_addkit = array();
// adding addkit to complete_addkit array
foreach ($addkits as $row) {
    $complete_addkit[] = array();
}

/**
 * Col Width
 */
$this->polatan->col_width(1, 2);

/**
 * Meta
 */
$this->polatan->add_meta(array(
    'namespace'  => 'addkit-list',
    'col_id' => 1,
    'type' => 'card'
));

/**
 * Item
 */
$this->polatan->add_item(array(
    'type'  => 'default-table',
    'thead' => array(),
    'tbody' => $complete_addkit
), 'addkit-list', 1);

$this->polatan->output();