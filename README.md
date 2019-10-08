# com.pesc.primaryfix

The extension is licensed under [AGPL-3.0](LICENSE.txt).

## Requirements

* PHP v5.6+
* CiviCRM v5.0+

## Usage

Fixes a contact's related records (phone,email,address) when none, or more than one are set to primary. Creates a new API entity 'Primaryfix' and action 'fix', can accept a single contact ID 'cid' or none to process all contacts. On installation adds a new daily schedueld job.  

```
//  Process all contacts
$result = civicrm_api3('Primaryfix', 'fix');


'//  Process one contact
$result = civicrm_api3('Primaryfix', 'fix', [
  'cid' => 123,
]);

```
