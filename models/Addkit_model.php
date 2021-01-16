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
class AddKit_model extends MY_Model
{
    protected $table_name = 'addkit';

    protected $return_insert_id = false;

    protected $date_format = 'datetime';

    protected $validation_rules = array(
        array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'trim|strip_tags|required'
        )
    );

    protected $autokey = [ 
        'digit'   => 4,
        'tanggal' => true,
    ];

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Insert a row of data into the database.
     *
     * @param array $data   An array of key/value pairs to insert.
     *
     * @return bool|int The $id of the inserted row or true (if $this->return_insert_id
     * is false), or false on failure.
     */
    public function insert($data = null)
    {
        $data[ 'name' ] = $this->input->post('name');
        parent::insert($data);
    }

    /**
     * Update an existing row in the database.
     *
     * @param mixed $where The primary_key value of the row to update, or an array
     * to use for the where clause.
     * @param array $data  An array of key/value pairs to update.
     *
     * @return bool True on successful update, else false.
     */
    public function update($where = null, $data = null)
    {
        $data[ 'name' ] = $this->input->post('name');
        parent::update($where, $data);
    }
}
