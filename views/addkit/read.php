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

$tables = array();
$edit_addkit     = '<i class="fas fa-pen"></i>';
$hapus_addkit    = '<i class="fas fa-trash-alt"></i>';
// adding addkit to tables array
foreach (force_array($addkits) as $row) {
    if ( User::control('edit.addkit')) {
        $edit_addkit = '<a href="' . site_url(array( 'admin', 'addkit', 'edit', $row->id )) . '" 
                class="btn btn-icon btn-light btn-hover-primary btn-sm"><i class="fas fa-pen"></i></a>';
    }
    if ( User::control('delete.addkit')) {
        $hapus_addkit = '<button class="btn btn-icon btn-light btn-hover-danger btn-sm"
                data-head=\'' . _s( 'Would you like to delete this data?', 'aauth' ) . '\'
                data-url=\'' . site_url(array( 'admin', 'addkit', 'delete', $row->id )) . '\'
                onclick="deleteConfirmation(this)"><i class="fas fa-trash-alt"></i></button>';
    }
    $tables[] = array(
        $row->id,
        $edit_addkit.' '.$hapus_addkit
    );
}

/**
 * Col Width
 */
$this->polatan->col_width(1, 4);

/**
 * Meta
 */
$this->polatan->add_meta(array(
    'namespace'  => 'addkit',
    'col_id' => 1,
    'type' => 'card'
));

/**
 * Item
 */
$this->polatan->add_item(array(
    'type'  => 'table-default',
    'thead' => array(
        __('Checkall'), 
        __('Actions') 
    ),
    'tbody' => $tables
), 'addkit', 1);

/**
 * Script
 */
if (count($tables) > 0) :
$this->events->add_action( 'dashboard_footer', function() {
    $this->load->addon_view( 'addkit', 'addkit/script');
});
endif;

$this->polatan->output();