<?php

/**
 * This class generates form components for ContactSub Type
 *
 */
class CRM_Admin_Form_Country extends CRM_Admin_Form {

  public function getDefaultEntity(){
    return 'Country';
  }

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

    $this->add('text', 'name', ts('Country name', array('domain' => 'com.ixiam.modules.countrymanager')));
    $this->add('select', 'region_id', ts('World Regions', array('domain' => 'com.ixiam.modules.countrymanager')), $worldRegionsSelect);
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
        CRM_Core_Session::setStatus(ts('Are you sure to delete the Country?', array('domain' => 'com.ixiam.modules.countrymanager')));
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
      array(1 => $country->name, 'domain' => 'com.ixiam.modules.countrymanager')
    ));
  }
}

