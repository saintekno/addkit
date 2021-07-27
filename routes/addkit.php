<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AddKit_Controller extends MY_Addon
{
    private $breadcrumbs = array();

    public function __construct()
    {
        parent::__construct();

        // Load Header menu, optional!
        // $this->events->add_filter( 'fill_header_nav', array( new AddKit_Menu, '_header_nav' ));
    }

    private function breadcrumb($array = array())
    {
        $this->breadcrumbs[] = array(
            'id' => 1, 'name' => __('Home'), 
            'slug' => site_url('admin')
        );
        $this->breadcrumbs[] = array(
            'id' => 2, 'name' => __('AddKit', 'addkit'), 
            'slug' => site_url('admin/addkit')
        );
        ($array) ? $this->breadcrumbs[] = $array : '';
        return $this->breadcrumbs;
    }

    /**
     * Index addkit
     * @return void
     */
    public function index()
    {        
        // Can user access ?
        User::control('read.addkit');
        
        // Title
		Polatan::set_title(sprintf(__('AddKit'.' &mdash; %s', 'addkit'), get('signature')));

        // BreadCrumb
        $data['breadcrumbs'] = $this->breadcrumb();

        $this->events->add_action( 'do_dashboard_footer', function() use ( $data ) {
            $this->load->addon_view( 'addkit', 'addkit/datatable', $data);
        });
        $this->addon_view( 'addkit', 'addkit/read', $data );
    }

    /**
     * Add addkit
     * @return void
     */
    public function add()
    {
        // Can user access ?
        User::control('create.addkit');

        // Load Model
        $this->load->model('addkit_model');

        // POST data
        if ($this->input->post('submit')) 
        {
            $exec = $this->addkit_model->insert();

            if ($exec == 'created') :
            redirect(array( 'admin', 'addkit?notice='.$exec )); 
            endif;
            
            $this->notice->push_notice_array($exec);
        }
        
        // Title
        Polatan::set_title(sprintf(__('AddKit'.' &mdash; %s', 'addkit'), get('signature')));
        
        // BreadCrumb
        $data['breadcrumbs'] = $this->breadcrumb(array( 
            'id' => 3, 'name' => __('Add New'), 'slug' => site_url('admin') )
        );

        $this->addon_view( 'addkit', 'addkit/form', $data );
    }

    /**
     * Edit addkit
     * @param int addkit id
     * @return void
     */
    public function edit( $index = "" )
    {
        // Can user access ?
        User::control('update.addkit');

        // Load Model
        $this->load->model('addkit_model');
        
        // POST data
        if ($this->input->post('submit')) 
        {
            $exec = $this->addkit_model->update($index);

            if ($exec == 'updated') :
            redirect(array( 'admin', 'addkit?notice='.$exec )); 
            endif;

            $this->notice->push_notice_array($exec);
        }
        
        // Title
		Polatan::set_title(sprintf(__('AddKit'.' &mdash; %s', 'addkit'), get('signature')));
        
        // BreadCrumb
        $data['breadcrumbs'] = $this->breadcrumb( array( 
            'id' => 3, 'name' => __('Edit'), 'slug' => site_url('admin') )
        );

        $data['addkit_detail'] = $this->addkit_model->find($index);
        $this->addon_view( 'addkit', 'addkit/form', $data );
    }

    /**
     * Delete addkit
     * @param int addkit id
     * @return redirect
     */
    public function delete( $index = null )
    {
        // Can user access ?
        User::control('delete.addkit');
        
        // Load Model
        $this->load->model('addkit_model');

        // Multiple delete
        if ( $index == null ) 
        {
            $ids = $this->input->post('ids');
            foreach($ids as $id){
                $this->addkit_model->delete($id);
            }
        }
        else {
            $exec = $this->addkit_model->delete($index);

            if ($exec == 'deleted') {
                $this->session->set_flashdata('flash_message', __(($exec)));
            } else {
                $this->session->set_flashdata('flash_message', __('unexpected-error'));
            };
        }
    }
}
