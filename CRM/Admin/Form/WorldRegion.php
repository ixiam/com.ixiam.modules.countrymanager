<?php
/**
 * This class generates form components for ContactSub Type
 *
 */
class CRM_Admin_Form_WorldRegion extends CRM_Admin_Form {

  public function getDefaultEntity(){
    return 'WorldRegion';
  }

  /**
   * Function to build the form
   *
   * @return None
   * @access public
   */
  public function buildQuickForm(){
    parent::buildQuickForm();
    $this->add('text', 'name', ts('World Region name'));
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
      CRM_Core_Session::setStatus(ts('Actually you can delete World regions.'));
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

    $worldRegion = CRM_Countrymanager_BAO_WorldRegion::addAndSave($params);
    CRM_Core_Session::setStatus(ts("The World region '%1' has been saved.",
      array(1 => $worldRegion->name, 'domain' => 'com.ixiam.modules.countrymanager')
    ));


  }
}

