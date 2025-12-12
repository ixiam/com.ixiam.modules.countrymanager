<?php
/**
 * Page for displaying list of contact Subtypes
 */
class CRM_Admin_Page_StateProvince extends CRM_Core_Page_Basic {

  /**
   * The action links that we need to display for the browse screen
   *
   * @var array
   * @static
   */
  static $_links = NULL;
  public $_rowCount = 100;
  protected $_pager;
  /**
   * Get BAO Name
   *
   * @return string Classname of BAO.
   */
  function getBAOName() {
    return 'CRM_Countrymanager_BAO_StateProvince';
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
          'url' => 'civicrm/admin/stateprovince',
          'qs' => 'action=update&id=%%id%%&reset=1',
          'title' => ts('Edit World Region'),
        ),               
      );
    }
    return self::$_links;
  }

  function run() {        
    return parent::run();
  }

  function browse() {    
    $country_id = CRM_Utils_Request::retrieve('country_id', 'Integer', CRM_Core_DAO::$_nullObject) ;
    $crmRowCount = CRM_Utils_Request::retrieve('crmRowCount', 'Integer', CRM_Core_DAO::$_nullObject);
    if($crmRowCount >= 1){
      $this->_rowCount = $crmRowCount;
    }

    $rows = CRM_Countrymanager_BAO_StateProvince::getListStateProvince($country_id);    
    foreach ($rows as $key => $value) {
      $rows[$key]['action'] = CRM_Core_Action::formLink(self::links(), NULL,
        array('id' => $value['id'])
      );
    }
    $crmPID = CRM_Utils_Request::retrieve('crmPID', 'Integer', CRM_Core_DAO::$_nullObject) ;

    if($crmPID >= 1) {
      $crmPID = $crmPID - 1 ;
    }

    $rowsToShow = array();

    $rowsToShow = array_slice($rows, $this->_rowCount*$crmPID, $this->_rowCount);    
    
    $this->assign('rows', $rowsToShow);

    $params = array(
      'total' => count($rows),
      'rowCount' => $this->_rowCount,
      'status' => ts('Records %%StatusMessage%%'),
      'buttonBottom' => 'PagerBottomButton',
      'buttonTop' => 'PagerTopButton',
      'pageID' => "civicrm/admin/stateprovince?action=browse&force=1",
    );
    
    $pager = new CRM_Utils_Pager($params);

    $this->assign('pager', $pager);

  }

  /**
   * Get name of edit form
   *
   * @return string Classname of edit form.
   */
  function editForm() {
    return 'CRM_Admin_Form_StateProvince';
  }

  /**
   * Get edit form name
   *
   * @return string name of this page.
   */
  function editName() {
    return 'State Province';
  }

  // /**
  //  * Get user context.
  //  *
  //  * @return string user context.
  //  */
  function userContext($mode = NULL) {
    return 'civicrm/admin/stateprovince';
  }
}

