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

// Toolbar
$this->events->add_filter( 'toolbar', function( $toolbar ) {
    $toolbar[] = array(
        'id' => 1,
        'parent'  => NULL,
        'name'   => __('Back to the list', 'addkit'),
        'icon'    => 'icon ni ni-reports',
        'color'  => 'btn-light-primary',
        'slug'    => [ 'admin', 'addkit' ]
    );

    return $toolbar;
});

/**
 * Col Width
 */
$this->polatan->add_col(array(
    'width' => 2,
), 1);

/**
 * Meta
 */
$this->polatan->add_meta(array(
    'col_id'    => 1,
    'namespace' => 'form_addkit',
    'type'      => 'card',
    'gui_saver' => false,
    'form'      => array(
        'action' => null,
    ),
    'footer' => array(
        'submit' => array(
            'label' => __((in_array('add', $this->uri->segment_array())) ? 'Create addkit' : 'Save change')
        )
    )
));

/**
 * Item
 */
$this->polatan->add_item(array(
    'type'     => 'text',
    'label'    => __('Title'),
    'name'     => 'name',
    'required' => true,
    'value'    => (isset($addkit_detail)) 
        ? set_value('name', $addkit_detail->name)
        : set_value('name'),
), 'form_addkit', 1);

/**
 * Output
 */
$this->polatan->output();