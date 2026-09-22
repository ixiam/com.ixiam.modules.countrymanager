<?php
/**
 * Page for displaying list of contact Subtypes
 */
class CRM_Admin_Page_WorldRegion extends CRM_Core_Page_Basic {

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
    return 'CRM_Countrymanager_BAO_WorldRegion';
  }

  /**
   * Get action Links
   *
   * @return array (reference) of action links
   */
  function &links() {    
    if (!(self::$_links)) {
      self::$_links = [
        CRM_Core_Action::UPDATE =>
        [
          'name' => ts('Edit'),
          'url' => 'civicrm/admin/worldregion',
          'qs' => 'action=update&id=%%id%%&reset=1',
          'title' => ts('Edit World Region'),
        ],
        "countries" =>
        [
          'name' => ts('Go to the countries'),
          'url' => 'civicrm/admin/country',
          'qs' => 'reset=1&action=browse&region_id=%%id%%',
          'title' => ts('Edit Country'),
        ],
      ];
    }
    return self::$_links;
  }

  function run() {    
    return parent::run();
  }

  function browse() {        
    $rows = CRM_Countrymanager_BAO_WorldRegion::getListWorldRegion();
    foreach ($rows as $key => $value) {
      $rows[$key]['action'] = CRM_Core_Action::formLink(self::links(), NULL,
        ['id' => $value['id']]
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
    return 'CRM_Admin_Form_WorldRegion';
  }

  /**
   * Get edit form name
   *
   * @return string name of this page.
   */
  function editName() {
    return 'World Region';
  }

  // /**
  //  * Get user context.
  //  *
  //  * @return string user context.
  //  */
  function userContext($mode = NULL) {
    return 'civicrm/admin/worldregion';
  }
}

