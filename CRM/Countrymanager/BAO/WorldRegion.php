<?php

class CRM_Countrymanager_BAO_WorldRegion extends CRM_Countrymanager_DAO_WorldRegion{
	static function retrieve(&$params, &$defaults) {
    $worldRegion = new CRM_Countrymanager_DAO_WorldRegion();
    $worldRegion->copyValues($params);
    if ($worldRegion->find(TRUE)) {
      CRM_Core_DAO::storeValues($worldRegion, $defaults);
      return $worldRegion;
    }
    return NULL;
  }

  static function addAndSave($params) {

    $worldRegion = new CRM_Countrymanager_DAO_WorldRegion();
    $worldRegion->copyValues($params);
    $worldRegion->save();

    CRM_Core_DAO::storeValues($worldRegion, $defaults);

    if ($worldRegion->find(TRUE)) {
      return $worldRegion;
    }

  }

	static function getListWorldRegion($idWorldRegion = 0) {
		$params = [];
		$sql = "SELECT * FROM `civicrm_worldregion`";

		if($idWorldRegion != 0) {
			$sql .= "WHERE	id = %1";
			$params[1] = [$fieldId, 'Integer'];
		}

		$dao = CRM_Core_DAO::executeQuery($sql, $params);
		$worldRegion = [];
		while($dao->fetch()) {
			$worldRegion[$dao->id] = ["id" => $dao->id,"name" => $dao->name];
		}
		return $worldRegion;
	}

}
