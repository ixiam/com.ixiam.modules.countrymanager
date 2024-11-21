<?php

/**
 * This class generates form components for ContactSub Type
 *
 */
class CRM_Admin_Form_StateProvince extends CRM_Admin_Form {

  public function getDefaultEntity(){
    return 'StateProvince';
  }

  /**
   * Function to build the form
   *
   * @return None
   * @access public
   */
  public function buildQuickForm() {
    parent::buildQuickForm();

    $countries = CRM_Countrymanager_BAO_Country::getListCountry();

    $countriesSelect = array();
    foreach ($countries as $key => $value) {
      $countriesSelect[$value["id"]] = $value["name"];
    }


    $this->add('text', 'name', ts('Name State/province region'));
    $this->add('select', 'country_id', 'Country', $countriesSelect);

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
        CRM_Core_Session::setStatus(ts('Actually you can delete state/province regions.'));
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

    $stateProvince = CRM_Countrymanager_BAO_StateProvince::addAndSave($params);
    CRM_Core_Session::setStatus(ts("The state/province region '%1' has been saved.",
        array(1 => $stateProvince->name, 'domain' => 'com.ixiam.modules.countrymanager')
      ));
  }
}

