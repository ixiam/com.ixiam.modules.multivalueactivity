<?php

require_once 'multivalueactivity.civix.php';
use CRM_Multivalueactivity_ExtensionUtil as E;

function multivalueactivity_civicrm_buildForm($formName, &$form) {
  if ($formName == 'CRM_Custom_Form_CustomDataByType') {
    $type      = CRM_Utils_Request::retrieve('type', 'String', CRM_Core_DAO::$_nullObject, TRUE);
    $entityId  = CRM_Utils_Request::retrieve('entityID', 'Positive');
    if($type == 'Activity'){
      $form->assign('activityId', $entityId);
    }
  }
}

/**
 * Implements hook_civicrm_validateForm().
 *
 * @param string $formName
 * @param array $fields
 * @param array $files
 * @param CRM_Core_Form $form
 * @param array $errors
 */
function multivalueactivity_civicrm_validateForm($formName, &$fields, &$files, &$form, &$errors){
  if ($formName == 'CRM_Custom_Form_Group') {
    $extends = $fields['extends'][0];
    if(($extends == 'Activity')  && $fields['is_multiple'] && ($fields['style'] != 'Inline')){
      $errors['style'] = ts("Display Style should be Inline for Multivalue group for Activites");
      $form->assign('showStyle', TRUE);
    }
  }
  return;
}

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function multivalueactivity_civicrm_config(&$config) {
  _multivalueactivity_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function multivalueactivity_civicrm_xmlMenu(&$files) {
  _multivalueactivity_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function multivalueactivity_civicrm_install() {
  _multivalueactivity_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function multivalueactivity_civicrm_postInstall() {
  _multivalueactivity_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function multivalueactivity_civicrm_uninstall() {
  _multivalueactivity_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function multivalueactivity_civicrm_enable() {
  _multivalueactivity_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function multivalueactivity_civicrm_disable() {
  _multivalueactivity_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function multivalueactivity_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _multivalueactivity_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function multivalueactivity_civicrm_managed(&$entities) {
  _multivalueactivity_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function multivalueactivity_civicrm_caseTypes(&$caseTypes) {
  _multivalueactivity_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function multivalueactivity_civicrm_angularModules(&$angularModules) {
  _multivalueactivity_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function multivalueactivity_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _multivalueactivity_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_preProcess
 *
function multivalueactivity_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 *
function multivalueactivity_civicrm_navigationMenu(&$menu) {
  _multivalueactivity_civix_insert_navigation_menu($menu, NULL, array(
    'label' => E::ts('The Page'),
    'name' => 'the_page',
    'url' => 'civicrm/the-page',
    'permission' => 'access CiviReport,access CiviContribute',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _multivalueactivity_civix_navigationMenu($menu);
} // */
