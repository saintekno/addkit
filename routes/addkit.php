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
class AddKit_Controller extends MY_Addon
{
    public function __construct()
    {
        parent::__construct();

        // Load Header menu, optional!
        // $this->events->add_filter( 'header_menu', array( new AddKit_Menu, '_header_menu' ));
        
        // Load Model
        $this->load->model('addkit_model');
    }

    /**
     * Index addkit
     * @return void
     */
    public function index()
    {
        // Can user access ?
        if ( ! User::control('read.addkit') ) {
            $this->session->set_flashdata('error_message', __( 'Access denied. Your are not allowed to see this page.' ));
            redirect(site_url('admin/page404'));
        }
        
        // Toolbar
        if ( User::control('create.addkit') ) {
            $this->events->add_filter( 'toolbar_menu', function( $final ) {
                $final[] = array(
                    'title'   => __('Add A AddKit', 'addkit'),
                    'icon'    => 'ki ki-plus',
                    'button'  => 'btn-light-primary',
                    'href'    => site_url([ 'admin', 'addkit', 'add' ])
                );
                return $final;
            });
        };
        
        // Title
		Polatan::set_title(sprintf(__('AddKit &mdash; %s', 'addkit'), get('signature')));
        
        // BreadCrumb
        $this->breadcrumb->add(__('Home', 'addkit'), site_url('admin'));
        $this->breadcrumb->add(__('AddKit', 'addkit'), site_url('admin/addkit'));
        $data['breadcrumbs'] = $this->breadcrumb->render();
        
        $data['addkits'] = $this->addkit_model->as_json()->find_all();
        $this->addon_view( 'addkit', 'addkit/read', $data );
    }

    /**
     * Add addkit
     * @return void
     */
    public function add()
    {
        // Can user access ?
        if (! User::control('create.addkit')) {
            $this->session->set_flashdata('error_message', __( 'Access denied. Your are not allowed to see this page.' ));
            redirect(site_url('admin/page404'));
        }

        // Toolbar
        $this->events->add_filter( 'toolbar_menu', function( $final ) {
			$final[] = array(
				'title'   => __('Back to the list', 'addkit'),
				'icon'    => 'ki ki-long-arrow-back',
				'button'  => 'btn-light',
				'href'    => site_url([ 'admin', 'addkit' ])
			);
			return $final;
        });
        
        // Title
        Polatan::set_title(sprintf(__('AddKit &mdash; %s', 'addkit'), get('signature')));
        
        // BreadCrumb
        $this->breadcrumb->add(__('Home', 'addkit'), site_url('admin'));
        $this->breadcrumb->add(__('AddKit', 'addkit'), site_url('admin/addkit'));
        $this->breadcrumb->add(__('Add New', 'addkit'), site_url('admin/addkit/add'));
        $data['breadcrumbs'] = $this->breadcrumb->render();
        
        // POST data
        if ($this->input->post('submit')) 
        {
            $exec = $this->addkit_model->insert();

            if ($exec) {
                redirect(array( 'admin', 'addkit?notice=created' ));
            } else {
                $this->notice->push_notice_array($exec);
            }
        }

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
        if (! User::control('edit.addkit')) {
            $this->session->set_flashdata('error_message', __( 'Access denied. Your are not allowed to see this page.' ));
            redirect(site_url('admin/page404'));
        }

        // Toolbar
        $this->events->add_filter( 'toolbar_menu', function( $final ) {
			$final[] = array(
				'title'   => __('Back to the list', 'addkit'),
				'icon'    => 'ki ki-long-arrow-back',
				'button'  => 'btn-light',
				'href'    => site_url([ 'admin', 'addkit' ])
			);
			return $final;
        });
        
        // Title
		Polatan::set_title(sprintf(__('AddKit &mdash; %s'), get('signature')));
        
        // BreadCrumb
        $this->breadcrumb->add(__('Home', 'addkit'), site_url('admin'));
        $this->breadcrumb->add(__('AddKit', 'addkit'), site_url('admin/addkit'));
        $this->breadcrumb->add(__('Edit', 'addkit'), site_url('admin/addkit/edit'));
        $data['breadcrumbs'] = $this->breadcrumb->render();
        
        // POST data
        if ($this->input->post('submit')) 
        {
            $exec = $this->addkit_model->update($index);

            if ($exec) {
                redirect(array( 'admin', 'addkit?notice=updated' ));
            } else {
                $this->notice->push_notice_array($exec);
            }
        }
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
        if (! User::control('delete.addkit')) {
            $this->session->set_flashdata('error_message', __( 'Access denied. Your are not allowed to see this page.' ));
            redirect(site_url('admin/page404'));
        }

        if ( $index == null ) 
        {
            $ids = $this->input->post('ids');
    
            foreach($ids as $id){
                $this->addkit_model->delete($id);
            }
    
            echo 1;
            exit;
        }
        else {
            if ($this->addkit_model->delete($index)) {
                redirect(array( 'admin', 'addkit?notice=deleted' ));
            } else {
                $this->session->set_flashdata('flash_message', __('unexpected-error'));
                redirect(current_url(), 'refresh');
            };
        }
    }
}
