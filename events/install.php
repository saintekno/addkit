<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AddKit_Install extends CI_model
{
    public function __construct()
    {
        parent::__construct();

        // Installation
        // $this->events->add_action('do_enable_addon', [ $this, 'enable' ] );
        // $this->events->add_action('do_remove_addon', [ $this, 'remove' ] );
        // $this->events->add_action('settings_tables', [ $this, 'install_tables' ] );
        // $this->events->add_action('settings_final_config', [ $this, 'final_config' ] );
    }
    
    public function enable($namespace)
    {
        if ($namespace === 'addkit' && $this->options_model->get('addkit_installed') == null) {
            // Install Tables
            $this->install_tables();
            $this->final_config();
        }
    }

    /**
     * Install tables
     *
     * @return void
    **/
    public function install_tables( $prefix = '' )
    {
		$table_prefix =	$this->db->dbprefix . $prefix;
        $this->db->query('CREATE TABLE IF NOT EXISTS `'.$table_prefix.'addkit` (
            `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
            `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
            PRIMARY KEY (`id`)
        )');
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

		$this->db->query('DROP TABLE IF EXISTS `'.$this->db->dbprefix.'addkit`;');
    }
    
}
new AddKit_Install;