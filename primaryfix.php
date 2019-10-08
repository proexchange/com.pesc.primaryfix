<?php

require_once 'primaryfix.civix.php';
use CRM_Primaryfix_ExtensionUtil as E;

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/ 
 */
function primaryfix_civicrm_config(&$config) {
  _primaryfix_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_xmlMenu
 */
function primaryfix_civicrm_xmlMenu(&$files) {
  _primaryfix_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function primaryfix_civicrm_install() {
  _primaryfix_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function primaryfix_civicrm_postInstall() {
  _primaryfix_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function primaryfix_civicrm_uninstall() {
  _primaryfix_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function primaryfix_civicrm_enable() {
  _primaryfix_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function primaryfix_civicrm_disable() {
  _primaryfix_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function primaryfix_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _primaryfix_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
 */

function primaryfix_civicrm_managed(&$entities) {
  _primaryfix_civix_civicrm_managed($entities);
  $entities[] = array(
    'module' => 'com.pesc.primaryfix',
    'entity' => 'job',
    'name' => 'Fix primary related records ',
    'params' => array(
      'version' => 3,
      'name' => 'Fix primary related records ',
      'description' => 'Evaluates all contact or single \'cid\' fir related records (email,phone,address) that  do not have a records marked as primary, or more than one marked as primary and fixes it.',
      'api_entity' => 'Primaryfix',
      'api_action' => 'fix',
      'run_frequency' => 'Daily'
    )
  );
  
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_caseTypes
 */
function primaryfix_civicrm_caseTypes(&$caseTypes) {
  _primaryfix_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_angularModules
 */
function primaryfix_civicrm_angularModules(&$angularModules) {
  _primaryfix_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterSettingsFolders
 */
function primaryfix_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _primaryfix_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function primaryfix_civicrm_entityTypes(&$entityTypes) {
  _primaryfix_civix_civicrm_entityTypes($entityTypes);
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_preProcess
 *
function primaryfix_civicrm_preProcess($formName, &$form) {

} // */

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_navigationMenu
 *
function primaryfix_civicrm_navigationMenu(&$menu) {
  _primaryfix_civix_insert_navigation_menu($menu, 'Mailings', array(
    'label' => E::ts('New subliminal message'),
    'name' => 'mailing_subliminal_message',
    'url' => 'civicrm/mailing/subliminal',
    'permission' => 'access CiviMail',
    'operator' => 'OR',
    'separator' => 0,
  ));
  _primaryfix_civix_navigationMenu($menu);
} // */


/**
 * Implements hook_civicrm_post().


function primaryfix_civicrm_post($op, $objectName, $objectId, &$objectRef) {
  watchdog('primaryfix',print_r($objectName,TRUE));
}

*/















