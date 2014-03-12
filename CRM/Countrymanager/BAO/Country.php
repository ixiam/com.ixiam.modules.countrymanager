<?php

class CRM_Countrymanager_BAO_Country extends CRM_Countrymanager_DAO_Country{
	


	static function retrieve(&$params, &$defaults) {
    $country = new CRM_Countrymanager_DAO_Country();
    $country->copyValues($params);
    if ($country->find(TRUE)) {
      CRM_Core_DAO::storeValues($country, $defaults);
      return $country;
    }
    return NULL;
  }
  static function addAndSave($params) {

    $country = new CRM_Countrymanager_DAO_Country();
    $country->copyValues($params);
    $country->save();

    CRM_Core_DAO::storeValues($country, $defaults);

    if ($country->find(TRUE)) {      
      return $country;
    }

  }

	static function getListCountry($idCountry = 0) {
		$params = array();
			$sql = "
			SELECT * FROM `civicrm_country`
		";

		if($idCountry != 0) {
			$sql .= "WHERE	id = %1";
			$params[1] = array($fieldId, 'Integer');	
		}		

			$dao = CRM_Core_DAO::executeQuery($sql, $params);
			$country = array();
			while($dao->fetch()) {
				$country[$dao->id] = array("id" => $dao->id,"name" => $dao->name);				
		}		
		return $country;
	}
  
}