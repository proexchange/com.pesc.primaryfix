<?php
use CRM_Primaryfix_ExtensionUtil as E;

/**
 * Primaryfix.Fix API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 * @return void
 * @see https://docs.civicrm.org/dev/en/latest/framework/api-architecture/
 */
function _civicrm_api3_primaryfix_Fix_spec(&$spec) {
  $spec['cid']['api.required'] = 0;
  $spec['cid']['description'] = 'Fix primary records for this contact. If empty it will process all contacts';
}
/**
 * Primaryfix.Fix API
 *
 * @param array $params
 * @return array API result descriptor
 * @see civicrm_api3_create_success
 * @see civicrm_api3_create_error
 * @throws API_Exception
 */
function civicrm_api3_primaryfix_Fix($params) {

  $processed = array();

  // First  get the default location type
  $locationType = civicrm_api3('LocationType', 'getsingle', [
    'is_default' => 1,
  ]);
  $recordsfixed = array();

  // If cid is provided process for just one, else process all contacts
  if (array_key_exists('cid', $params)) {

    $processed = primaryfix_fixprimarybyId ($params['cid'], $locationType);

    return civicrm_api3_create_success($processed, $params, 'Primaryfix', 'Fix');
  }
  else {

    //Get all contacts
    $contacts = civicrm_api3('Contact', 'get', [
      'sequential' => 1,
      'return' => ["id"],
      'options' => ['limit' => 0],
    ]);
    // Process for all contacts
    foreach ($contacts['values'] as $contact) {
      $fixed = primaryfix_fixprimarybyId ($contact['contact_id'], $locationType);
      if ($fixed) {
        $processed[] = $fixed;
      }
    }
    return civicrm_api3_create_success($processed, $params, 'Primaryfix', 'Fix');
  }
}


function primaryfix_fixprimarybyId ($cid, $locationType) {

  $processed = array();

  // Related records to check for is_primary
  $recordtypes = array('Email', 'Address', 'Phone');

  foreach ($recordtypes as $type) {
    if(primaryfix_fixprimarybytype ($cid,$type,$locationType)) {
      $processed[$cid][] = $type;
    }
  }
  return $processed;
}


function primaryfix_fixprimarybytype ($cid,$recordtype,$locationType) {

  $processed = 0;

  // GET contact related records and fix
  $records = civicrm_api3($recordtype, 'get', [
    'sequential' => 1,
    'contact_id' => $cid,
  ]);

  // If the contact has any records of the type
  if ($records['count']) {
    // Look for records of the type marked as primary
    $recordsPrimary = civicrm_api3($recordtype, 'get', [
      'sequential' => 1,
      'contact_id' => $cid,
      'is_primary' => 1,
    ]);
    // Check that there is 1 marked as primary
    if ($recordsPrimary['count'] != 1) {
      // If there isn't then fix primary
      $processed = $cid;

      // Keep track if primary record has been set
      $primarySet = 0;

      // Loop through records to see if location type matches default location type 
      foreach ($records['values'] as $key => $record) {
        // if primary has already been set, make sure current record is not primary
        if ($primarySet) {
          $records['values'][$key]['is_primary'] = 0;
        }
        else { 
          if ($record['location_type_id'] = $locationType) {
            $records['values'][$key]['is_primary'] = 1;
            $primarySet = 1;
          }
          else {
            $records['values'][$key]['is_primary'] = 0;
          }            
        }
      }

      // If after looping, no records was marked as primary, then just marked first record
      if (!$primarySet){
        foreach ($records['values'] as $key => $record) {
          $records['values'][$key]['is_primary'] = 1;
          $primarySet = 1;   
          break;         
        }
      }

      // Save records
      foreach ($records['values'] as $key => $record) {
        $saverecord = civicrm_api3($recordtype, 'create', [
          'id' => $record['id'],
          'is_primary' => $record['is_primary'],
        ]);
      }
    }
  }
  return $processed;
}
