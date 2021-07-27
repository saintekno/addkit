<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AddKit_model extends MY_Model
{
    protected $table_name = 'addkit';

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

        if (parent::insert($data)):
        return 'created';
        endif;
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
        
        if (parent::update($where, $data)):
        return 'updated';
        endif;
    }

    /**
     * Delete the record with the specified primary key value.
     *
     * If $this->soft_deletes is true, it will attempt to set $this->deleted_field
     * on the specified record to '1', to allow the data to remain in the database.
     *
     * @param mixed $id The primary_key value to match against.
     *
     * @return bool True on successful delete, else false.
     */
    public function delete($id = null)
    {
        if (parent::delete($id)):
        return 'deleted';
        endif;
    }
}
