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
class AddKit_Install extends MY_Addon
{
    public function __construct()
    {
        parent::__construct();

        // Installation
        $this->events->add_action('do_enable_addon', [ $this, 'enable_addon' ] );
        $this->events->add_action('do_remove_addon', [ $this, 'remove_addon' ] );
        $this->events->add_action('do_settings_tables', [ $this, 'install_tables' ] );
        $this->events->add_action('do_settings_final_config', [ $this, 'permissions' ] );
        $this->events->add_action('do_settings_final_config', [ $this, 'final_config' ] );
    }
    
    /**
     * Enable addon
     *
     * @return void
    **/
    public function enable_addon($namespace)
    {
        if ($namespace === 'addkit' && $this->options_model->get('addkit_installed', 'addkit') == null) {
            // Install Tables
            $this->install_tables();
            $this->permissions();
            $this->dummy_tables();
            $this->final_config();
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

        $this->db->query("CREATE TABLE IF NOT EXISTS `{$table_prefix}addkit` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `name` varchar(255) DEFAULT NULL,
            `created_on` datetime NOT NULL,
            `modified_on` datetime NOT NULL,
            `deleted` tinyint(1) NOT NULL,
            `created_by` varchar(255) DEFAULT NULL,
            `modified_by` varchar(255) DEFAULT NULL,
            `deleted_by` varchar(255) DEFAULT NULL,
            PRIMARY KEY (`id`)
        )");
    }

    /**
     * Install tables
     *
     * @return void
    **/
    public function dummy_tables()
    {
        $table_prefix =	$this->db->dbprefix;
        
        // addkit
        $this->db->query("INSERT INTO `{$table_prefix}addkit` (`name`) VALUES
            ('name');" 
        );
    }
    
    /**
     * Set groupes
     *
     * @return void
    **/
    public function permissions()
    {
		// all permissions
		$permissions = [];
		$permissions[ 'read.addkit' ]   = __( 'Read addkit' );
		$permissions[ 'create.addkit' ] = __( 'Create addkit' );
		$permissions[ 'edit.addkit' ]   = __( 'Edit addkit' );
		$permissions[ 'delete.addkit' ] = __( 'Delete addkit' );
		foreach( $permissions as $namespace => $perm ) {
			$this->aauth->create_perm( 
				$namespace,
				$perm
			);
		}

        // Assign Permission addkit to Groups
		$permissions_keys =	array_keys( $permissions );
		foreach([ 
			'addkit',
		] as $component ) {
			foreach([ 'create.', 'edit.', 'delete.', 'view.' ] as $action ) {
				$permission = $action . $component;
				if ( in_array( $permission, $permissions_keys ) ) {
					$this->aauth->allow_group( 'member', $permission );
				}
			}
		}
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
    public function remove_addon($namespace)
    {
        if ($namespace != 'addkit') : return ;
        endif;

        $table_prefix =	$this->db->dbprefix;
        
        // Delete Table
        $this->db->query("DROP TABLE IF EXISTS `{$table_prefix}addkit`;");
        
        // Delete Permissions
		foreach([ 
			'addkit',
		] as $component ) {
			foreach([ 'create.', 'edit.', 'delete.', 'view.' ] as $action ) {
				$permission = $action . $component;
                $this->aauth->delete_perm( $permission );
			}
		}
    }
}
new AddKit_Install;