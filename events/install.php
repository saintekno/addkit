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
class AddKit_Install extends CI_model
{
    public function __construct()
    {
        parent::__construct();

        // Installation
        $this->events->add_action('do_enable_addon', [ $this, 'enable' ] );
        $this->events->add_action('do_remove_addon', [ $this, 'remove' ] );
        $this->events->add_action('do_disable_addon', [ $this, 'disable' ] );
        $this->events->add_action('settings_tables', [ $this, 'install_tables' ] );
        $this->events->add_action('settings_tables', [ $this, 'permissions' ] );
        $this->events->add_action('settings_final_config', [ $this, 'final_config' ] );
    }
    
    /**
     * Enable addon
     *
     * @return void
    **/
    public function enable($namespace)
    {
        if ($namespace === 'addkit' && $this->options_model->get('addkit_installed') == null) {
            // Install Tables
            $this->install_tables();
            $this->final_config();
            $this->permissions();
        }
    }

    /**
     * Install tables
     *
     * @return void
    **/
    public function install_tables()
    {
        $table_prefix =	$this->db->dbprefix;

        $this->db->query("DROP TABLE IF EXISTS `{$table_prefix}addkit`;");
        $this->db->query('CREATE TABLE `'.$table_prefix.'addkit` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          PRIMARY KEY (`id`)
        )');
    }

    /**
     * Install tables
     *
     * @return void
    **/
    public function permissions()
    {
        // Addkit Permissions
        $this->aauth->create_perm('read.addkit', __('Read addkit'));
        $this->aauth->create_perm('create.addkit', __('Create addkit'));
        $this->aauth->create_perm('edit.addkit', __('Edit addkit'));
        $this->aauth->create_perm('delete.addkit', __('Delete addkit'));

        /**
         * Assign Permission to Groups
        **/
        // Member
        $this->aauth->allow_group('member', 'read.addkit');
        $this->aauth->allow_group('member', 'create.addkit');
        $this->aauth->allow_group('member', 'update.addkit');
        $this->aauth->allow_group('member', 'delete.addkit');
    }

    /**
     * Final Config
     *
     * @return void
    **/
    public function final_config()
    {
        // Defaut options_model
        $this->options_model->set('addkit_installed', true, 'addkit');
    }

    /**
     * Uninstall
     *
     * @return void
    **/
    public function remove($namespace)
    {
        if ($namespace != 'addkit') : return ;
        endif;
        
        // Delete Table
        $this->db->query('DROP TABLE IF EXISTS `'.$this->db->dbprefix.'addkit`;');
        
        // Delete Permissions
        $this->aauth->delete_perm('read.addkit');
        $this->aauth->delete_perm('create.addkit');
        $this->aauth->delete_perm('edit.addkit');
        $this->aauth->delete_perm('delete.addkit');

        // Defaut options_model
        $this->options_model->delete(null, 'addkit');
    }

    /**
     * Disable
     *
     * @return void
    **/
    public function disable($namespace)
    {
        if ($namespace != 'addkit') : return ;
        endif;

        // Delete Permissions
        $this->aauth->delete_perm('read.addkit');
        $this->aauth->delete_perm('create.addkit');
        $this->aauth->delete_perm('edit.addkit');
        $this->aauth->delete_perm('delete.addkit');

        // Defaut options_model
        $this->options_model->delete(null, 'addkit');
    }
}
new AddKit_Install;