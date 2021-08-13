<?php
defined('BASEPATH') or exit('No direct script access allowed');

// Toolbar
$this->events->add_filter( 'fill_toolbar_nav', function( $final ) {
    $final[] = array(
        'id' => 1,
        'name'   => __('Back to the list'),
        'icon'    => 'sit sit-long-arrow-back',
        'attr_anchor'  => 'class="btn btn-light btn-sm font-weight-bolder"',
        'slug'    => site_url([ 'admin', 'addkit' ]),
        'permission' => 'create.addkit'
    );
    return $final;
});

/**
 * Meta
 */
$this->polatan->add_meta(array(
    'col_id'    => 1,
    'class' => 'col-12',
    'namespace' => 'form_addkit',
    'type'      => 'card',
    'gui_saver' => false,
    'form'      => array(
        'action' => null,
    ),
    'footer' => 'add',
));

/**
 * Item
 */
$this->polatan->add_item(array(
    'type'     => 'text',
    'class' => 'col-12',
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