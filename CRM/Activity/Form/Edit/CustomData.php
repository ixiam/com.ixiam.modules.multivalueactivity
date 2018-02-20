<?php
/*
 +--------------------------------------------------------------------+
 | CiviCRM version 4.6                                                |
 +--------------------------------------------------------------------+
 | Copyright CiviCRM LLC (c) 2004-2015                                |
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
 * @copyright CiviCRM LLC (c) 2004-2015
 * $Id$
 *
 */

/**
 * form helper class for an Demographics object
 */
class CRM_Activity_Form_Edit_CustomData {

  /**
   * Build the form object elements for CustomData object.
   *
   * @param CRM_Core_Form $form
   *   Reference to the form object.
   *
   * @return void
   */
  public static function buildQuickForm(&$form) {
    if (!empty($form->_submitValues)) {
      if ($customValueCount = CRM_Utils_Array::value('hidden_custom_group_count', $form->_submitValues)) {
        if (is_array($customValueCount)) {
          if (array_key_exists(0, $customValueCount)) {
            unset($customValueCount[0]);
          }
          $form->_customValueCount = $customValueCount;
          $form->assign('customValueCount', $customValueCount);
        }
      }
    }
    CRM_Custom_Form_CustomData::buildQuickForm($form);
  }

  /**
   * Set default values for the form. Note that in edit/view mode
   * the default values are retrieved from the database
   *
   *
   * @param CRM_Core_Form $form
   * @param $defaults
   *
   * @return void
   */
  public static function setDefaultValues(&$form, &$defaults) {
    $defaults += CRM_Custom_Form_CustomData::setDefaultValues($form);
  }

}
