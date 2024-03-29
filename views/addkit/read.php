<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**========================================================================
 *                           Toolbar
 *========================================================================**/
// Toolbar Nav
$this->events->add_filter( 'fill_toolbar_nav', function( $final ) {
    $final[] = array(
        'id' => 1,
        'name'   => __('Add A addkit'),
        'icon'    => 'sit sit-plus',
        'attr_anchor'  => 'class="btn btn-light-primary btn-sm font-weight-bolder ml-2"',
        'slug'    => site_url([ 'admin', 'addkit', 'add' ]),
        'permission' => 'create.addkit'
    );
    return $final;
});

// Tolbar Filter
$this->events->add_filter( 'fill_toolbar_filter', function ($filter) { // disabling header
    $filter[] = '
    <div class="row">
        <div class="input-icon col mb-1 mb-sm-0">
            <input type="text" class="form-control form-control-sm" placeholder="Search..." id="search_query" />
            <span><i class="flaticon2-search-1 text-muted"></i></span>
        </div>
    </div>';

    return $filter;
});

/**========================================================================
 *                           Polatan
 *========================================================================**/
$this->polatan->add_meta(array(
    'namespace' => 'addkit',
    'class' => 'col-12',
    'col_id' => 1,
    'type' => 'card'
));

$this->polatan->add_item(array(
    'type' => 'table-datatable',
), 'addkit', 1);

$this->polatan->output();