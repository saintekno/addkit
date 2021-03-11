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

// Toolbar
$this->events->add_filter( 'toolbar', function( $toolbar ) {
    if ( User::control('create.addkit') ) {
        $toolbar[] = array(
            'id' => 1,
            'parent'  => NULL,
            'name'   => __('Add A AddKit', 'addkit'),
            'icon'    => 'icon ni ni-reports',
            'color'  => 'btn-light-primary',
            'slug'    => [ 'admin', 'addkit', 'add' ]
        );
    };

    return $toolbar;
});

$this->polatan->col_width(1, 4);

$this->polatan->add_meta(array(
    'namespace' => 'addkit',
    'col_id' => 1,
    'type' => 'card'
));

$this->polatan->add_item(array(
    'type' => 'table-datatable',
    'data' => json_decode($addkit)
), 'addkit', 1);

$this->polatan->output();