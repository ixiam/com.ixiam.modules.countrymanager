<?php
/*
 +--------------------------------------------------------------------+
 | CiviCRM version 4.3                                                |
 +--------------------------------------------------------------------+
 | Copyright CiviCRM LLC (c) 2004-2013                                |
 +--------------------------------------------------------------------+
 | This file is a part of CiviCRM.                                    |
 |                                                                    |
 | CiviCRM is free software; you can copy, modify, and distribute it  |
 | under the terms of the GNU Affero General Public License           |
 | Version 3, 19 November 2007 and the CiviCRM Licensing Exception.   |
 |                                                                    |
 | CiviCRM is distributed in the hope that it will be useful, but     |
 | WITHOUT ANY WARRANTY; without even the implied warranty of         |
 | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.               |
 | See the GNU Affero General Public License for more details.        |
 |                                                                    |
 | You should have received a copy of the GNU Affero General Public   |
 | License and the CiviCRM Licensing Exception along                  |
 | with this program; if not, contact CiviCRM LLC                     |
 | at info[AT]civicrm[DOT]org. If you have questions about the        |
 | GNU Affero General Public License or the licensing of CiviCRM,     |
 | see the CiviCRM license FAQ at http://civicrm.org/licensing        |
 +--------------------------------------------------------------------+
*/

/**
 *
 * @package CRM
 * @copyright CiviCRM LLC (c) 2004-2013
 * $Id$
 *
 */

/**
 * This class generates form components for ContactSub Type
 *
 */
class CRM_Admin_Form_Country extends CRM_Admin_Form {

  /**
   * Function to build the form
   *
   * @return None
   * @access public
   */
  public function buildQuickForm() {
    parent::buildQuickForm();    
      
    $worldRegions = CRM_Countrymanager_BAO_WorldRegion::getListWorldRegion();
    
    $worldRegionsSelect = array();
    foreach ($worldRegions as $key => $value) {
      $worldRegionsSelect[$value["id"]] = $value["name"];
    }    

    $this->add('text', 'name', ts('Name country region'));
    $this->add('select', 'region_id', 'World Regions', $worldRegionsSelect);
  }

  /**
   * global form rule
   *
   * @param array $fields  the input form values
   *
   * @return true if no errors, else array of errors
   * @access public
   * @static
   */
  static function formRule($fields, $files, $self) {

    $errors = array();


    return empty($errors) ? TRUE : $errors;
  }

  /**
   * Function to process the form
   *
   * @access public
   *
   * @return None
   */
  public function postProcess() {
    CRM_Utils_System::flushCache();
    if ($this->_action & CRM_Core_Action::DELETE) {    
        CRM_Core_Session::setStatus(ts('Actually you can delete Country regions.'));    
      return;
    }
    // store the submitted values in an array
    $params = $this->exportValues();



    if ($this->_action & CRM_Core_Action::UPDATE) {
      $params['id'] = $this->_id;      
      
    }
    if ($this->_action & CRM_Core_Action::ADD) {
      //$params['name'] = ucfirst(CRM_Utils_String::munge($params['label']));
    }

    $country = CRM_Countrymanager_BAO_Country::addAndSave($params);
    CRM_Core_Session::setStatus(ts("The Country region '%1' has been saved.",
        array(1 => $country->name)
      ));

    
  }
}
