<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
class AddKit_Controller extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('addkit_model');
        $this->load->library('form_validation');

        $this->breadcrumb->add('Home', site_url('admin'));
    }

    /**
     * Index addkit
     * @return void
     */
    public function index()
    {
        if ( ! User::control('read.addkit') ) {
            $this->session->set_flashdata('error_message', __( 'Access denied. Your are not allowed to see this page.' ));
            redirect(site_url('admin/page404'));
		}

        // Toolbar
        if ( User::control('create.addkit') ) {
            $this->events->add_filter( 'toolbar_menu', function( $final ) {
                $final[] = array(
                    'title'   => __('Add A addkit'),
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
        $this->breadcrumb->add('AddKit', site_url('admin/addkit'));

        $data['breadcrumbs'] = $this->breadcrumb->render();
        $data['addkits'] = $this->addkit_model->get_all();
        $this->load->addon_view( 'addkit', 'read', $data );
    }

    /**
     * Add addkit
     * @return void
     */
    public function add()
    {
        if (! User::control('create.addkit')) {
            $this->session->set_flashdata('error_message', __( 'Access denied. Your are not allowed to see this page.' ));
            redirect(site_url('admin/page404'));
        }

        // Toolbar
        $this->events->add_filter( 'toolbar_menu', function( $final ) {
			$final[] = array(
				'title'   => __('Back to the list'),
				'icon'    => 'ki ki-long-arrow-back',
				'button'  => 'btn-light-primary',
				'href'    => site_url([ 'admin', 'addkit' ])
			);
			return $final;
        });

        // POST data
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('addkit', 'AddKit', 'required');
        if ($this->form_validation->run()) 
        { 
            $exec = $this->addkit_model->add();

            if ($exec == 'created') {
                redirect(array( 'admin', 'addkit?notice=' . $exec ));
            } else {
                $this->notice->push_notice_array($exec);
            }
        }
        
        // Title
        Polatan::set_title(sprintf(__('AddKit &mdash; %s', 'addkit'), get('signature')));
        
        // BreadCrumb
        $this->breadcrumb->add('AddKit', site_url('admin/addkit'));

        $data['breadcrumbs'] = $this->breadcrumb->render();
        $this->load->addon_view( 'addkit', 'add', $data );
    }

    /**
     * Edit addkit
     * @param int addkit id
     * @return void
     */
    public function edit( $index = "" )
    {
        if (! User::control('edit.addkit')) {
            $this->session->set_flashdata('error_message', __( 'Access denied. Your are not allowed to see this page.' ));
            redirect(site_url('admin/page404'));
        }

        // Toolbar
        $this->events->add_filter( 'toolbar_menu', function( $final ) {
			$final[] = array(
				'title'   => __('Back to the list'),
				'icon'    => 'ki ki-long-arrow-back',
				'button'  => 'btn-light-primary',
				'href'    => site_url([ 'admin', 'addkit' ])
			);
			return $final;
        });

        // POST data
        $this->load->library('form_validation');

        $this->form_validation->set_rules('addkit', 'AddKit', 'required');
        if ($this->form_validation->run()) 
        { 
            $exec = $this->addkit_model->edit($index);

            if ($exec == 'updated') {
                $this->session->set_flashdata('flash_message', $exec);
                redirect(current_url(), 'refresh');
            } else {
                $this->notice->push_notice_array($exec);
            }
        }
        
        // Title
		Polatan::set_title(sprintf(__('AddKit &mdash; %s', 'addkit'), get('signature')));
        
        // BreadCrumb
        $this->breadcrumb->add('AddKit', site_url('admin/addkit'));

        $data['breadcrumbs'] = $this->breadcrumb->render();
        $data['addkit'] = $this->addkit_model->get($index);
        $this->load->addon_view( 'addkit', 'edit' );
    }

    /**
     * Delete addkit
     * @param int addkit id
     * @return redirect
     */
    public function delete( $index )
    {
        if (! User::control('delete.addkit')) {
            $this->session->set_flashdata('error_message', __( 'Access denied. Your are not allowed to see this page.' ));
            redirect(site_url('admin/page404'));
        }

        $exec = $this->addkit_model->delete($index);
        redirect(array( 'admin', 'addkit?notice=' . $exec ));
    }
}
