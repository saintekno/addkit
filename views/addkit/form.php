<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * SainSuite
 *
 * Engine Management System
 *
 * @package     SainSuite
 * @copyright   Copyright (c) 2019-2020 Buddy Winangun, Eracik.
 * @copyright   Copyright (c) 2020-2021 SainTekno, SainSuite.
 * @link        https://github.com/saintekno/sainsuite
 * @filesource
 */

/**
 * Col Width
 */
$this->polatan->col_width(1, 2);

/**
 * Meta
 */
$this->polatan->add_meta(array(
    'col_id'    => 1,
    'namespace' => 'form_addkit',
    'gui_saver' => false,
    'form'      => array(
        'action' => null,
    ),
    'footer' => array(
        'submit' => array(
            'label' => __('Submit AddKit', 'addkit')
        )
    ),
    'type' => 'card'
));

/**
 * Item
 */
$this->polatan->add_item(array(
    'type'     => 'text',
    'label'    => __('Name'),
    'name'     => 'name',
    'disabled' => true,
    'value'    => (isset($addkit_detail)) ? $addkit_detail->name : '',
), 'form_addkit', 1);

$this->polatan->output();