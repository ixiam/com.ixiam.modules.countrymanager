<?php

require_once 'countrymanager.civix.php';

/**
 * Implementation of hook_civicrm_config
 */
function countrymanager_civicrm_config(&$config) {
  _countrymanager_civix_civicrm_config($config);
}

/**
 * Implementation of hook_civicrm_install
 */
function countrymanager_civicrm_install() {

	require_once 'CRM/Core/BAO/Navigation.php';
	require_once 'CRM/Core/Menu.php';

	$query = "SELECT id FROM `civicrm_navigation` WHERE name = 'Localization'";
	$dao = CRM_Core_DAO::executeQuery($query);
	while ( $dao->fetch() ) {
		$id_menu_lozalization = $dao->id;
	}
	$dao->free( );


	if(!empty($id_menu_lozalization)){
		$menu_params = array (
			'label' => 'World Regions',
			'url' => 'civicrm/admin/worldregion?reset=1&action=browse',
			'permission' => array('administer CiviCRM'),
			'permission_operator' => 'AND',
			'has_separator' => '0',
			'is_active' => '1',
			'parent_id' => $id_menu_lozalization
		);
		$navigation = CRM_Core_BAO_Navigation::add( $menu_params );

		$menu_params = array (
			'label' => 'Countries',
			'url' => 'civicrm/admin/country?reset=1&action=browse',
			'permission' => array('administer CiviCRM'),
			'permission_operator' => 'AND',
			'has_separator' => '0',
			'is_active' => '1',
			'parent_id' => $id_menu_lozalization
		);
		$navigation = CRM_Core_BAO_Navigation::add( $menu_params );

		$menu_params = array (
			'label' => 'States/Provinces',
			'url' => 'civicrm/admin/stateprovince?reset=1&action=browse',
			'permission' => array('access CiviCRM'),
			'permission_operator' => 'AND',
			'has_separator' => '0',
			'is_active' => '1',
			'parent_id' => $id_menu_lozalization
		);
		$navigation = CRM_Core_BAO_Navigation::add( $menu_params );

    // also reset navigation
    CRM_Core_Menu::store( );
		CRM_Core_BAO_Navigation::resetNavigation( );
	}

  return _countrymanager_civix_civicrm_install();
}

/**
 * Implementation of hook_civicrm_enable
 */
function countrymanager_civicrm_enable() {
  return _countrymanager_civix_civicrm_enable();
}
