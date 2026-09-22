<?php

class CRM_Countrymanager_DAO_StateProvince extends CRM_Core_DAO {
	/**
	 * static instance to hold the table name
	 *
	 * @var string
	 * @static
	 */
	static $_tableName = 'civicrm_state_province';
	/**
	 * static instance to hold the field values
	 *
	 * @var array
	 * @static
	 */
	static $_fields = null;
	/**
	 * static instance to hold the FK relationships
	 *
	 * @var string
	 * @static
	 */
	static $_links = null;
	/**
	 * static instance to hold the values that can
	 * be imported
	 *
	 * @var array
	 * @static
	 */
	static $_import = null;
	/**
	 * static instance to hold the values that can
	 * be exported
	 *
	 * @var array
	 * @static
	 */
	static $_export = null;
	/**
	 * static value to see if we should log any modifications to
	 * this table in the civicrm_log table
	 *
	 * @var boolean
	 * @static
	 */
	static $_log = false;
	/**
	 * State Province ID
	 *
	 * @var int unsigned
	 */
	public $id;
	/**
	 * Internal name of State Province.
	 *
	 * @var string
	 */
	public $name;
	/**
	 * localized Name of State Province.
	 *
	 * @var string
	 */
	public $country_id;

	function __construct()
	{
		$this->__table = 'civicrm_state_province';
		parent::__construct();
	}

	/**
	 * return foreign links
	 *
	 * @access public
	 * @return array
	 */
	function links()
	{
		if (!(self::$_links)) {
			self::$_links = [
				'parent_id' => 'civicrm_state_province:id',
			];
		}
		return self::$_links;
	}

	/**
	 * returns all the column names of this table
	 *
	 * @access public
	 * @return array
	 */
	static function &fields()
	{
		if (!(self::$_fields)) {
			self::$_fields = [
				'id' => [
					'name' => 'id',
					'type' => CRM_Utils_Type::T_INT,
					'required' => true,
				] ,
				'name' => [
					'name' => 'name',
					'type' => CRM_Utils_Type::T_STRING,
					'title' => ts('Name') ,
					'maxlength' => 64,
					'size' => CRM_Utils_Type::BIG,
				] ,
				'country_id' => [
					'name' => 'country_id',
					'type' => CRM_Utils_Type::T_INT,
					'title' => ts('Name') ,
				] ,
			];
		}
		return self::$_fields;
	}

	/**
	 * returns the names of this table
	 *
	 * @access public
	 * @static
	 * @return string
	 */
	static function getTableName()
	{
		return CRM_Core_DAO::getLocaleTableName(self::$_tableName);
	}

	/**
	 * returns if this table needs to be logged
	 *
	 * @access public
	 * @return boolean
	 */
	function getLog()
	{
		return self::$_log;
	}

	/**
	 * returns the list of fields that can be imported
	 *
	 * @access public
	 * return array
	 * @static
	 */
	static function &import($prefix = false)
	{
		if (!(self::$_import)) {
			self::$_import = [];
			$fields = self::fields();
			foreach($fields as $name => $field) {
				if (CRM_Utils_Array::value('import', $field)) {
					if ($prefix) {
						self::$_import['stateprovince'] = & $fields[$name];
					} else {
						self::$_import[$name] = & $fields[$name];
					}
				}
			}
		}
		return self::$_import;
	}

	/**
	 * returns the list of fields that can be exported
	 *
	 * @access public
	 * return array
	 * @static
	 */
	static function &export($prefix = false)
	{
		if (!(self::$_export)) {
			self::$_export = [];
			$fields = self::fields();
			foreach($fields as $name => $field) {
				if (CRM_Utils_Array::value('export', $field)) {
					if ($prefix) {
						self::$_export['stateprovince'] = & $fields[$name];
					} else {
						self::$_export[$name] = & $fields[$name];
					}
				}
			}
		}
		return self::$_export;
	}
}
