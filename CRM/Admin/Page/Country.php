<?php
/**
 * Page for displaying list of contact Subtypes
 */
class CRM_Admin_Page_Country extends CRM_Core_Page_Basic {

  /**
   * The action links that we need to display for the browse screen
   *
   * @var array
   * @static
   */
  static $_links = NULL;

  /**
   * Get BAO Name
   *
   * @return string Classname of BAO.
   */
  function getBAOName() {
    return 'CRM_Countrymanager_BAO_Country';
  }

  /**
   * Get action Links
   *
   * @return array (reference) of action links
   */
  function &links() {
    if (!(self::$_links)) {
      self::$_links = array(
        CRM_Core_Action::UPDATE =>
        array(
          'name' => ts('Edit'),
          'url' => 'civicrm/admin/country',
          'qs' => 'action=update&id=%%id%%&reset=1',
          'title' => ts('Edit Country'),
        ),
        "states" =>
        array(
          'name' => ts('Go to the states'),
          'url' => 'civicrm/admin/stateprovince',
          'qs' => 'country_id=%%id%%&reset=1',
          'title' => ts('Edit Country'),
        ),
      );
    }
    return self::$_links;
  }

  function run() {
    return parent::run();
  }

  function browse() {
    $region_id = CRM_Utils_Request::retrieve('region_id', 'Integer', CRM_Core_DAO::$_nullObject);
    $rows = CRM_Countrymanager_BAO_Country::getListCountry($region_id);

    foreach ($rows as $key => $value) {
      $rows[$key]['action'] = CRM_Core_Action::formLink(self::links(), NULL,
        array('id' => $value['id'])
      );
    }
    $this->assign('rows', $rows);
  }

  /**
   * Get name of edit form
   *
   * @return string Classname of edit form.
   */
  function editForm() {
    return 'CRM_Admin_Form_Country';
  }

  /**
   * Get edit form name
   *
   * @return string name of this page.
   */
  function editName() {
    return 'Country';
  }

  // /**
  //  * Get user context.
  //  *
  //  * @return string user context.
  //  */
  function userContext($mode = NULL) {
    return 'civicrm/admin/country';
  }
}

