<?php

/**
 * Business object for managing custom data groups.
 */
class CRM_Multivalueactivity_BAO_CustomGroup extends CRM_Core_BAO_CustomGroup {

  /**
   * Build custom data view for Activities (showing multivalue fields).
   *
   * @param CRM_Core_Form $form
   *   Page object.
   * @param array $groupTree
   * @param bool $returnCount
   *   True if customValue count needs to be returned.
   * @param int $gID
   * @param null $prefix
   * @param int $customValueId
   * @param int $entityId
   *
   * @return array|int
   */
  public static function buildCustomDataView(&$form, &$groupTree, $returnCount = FALSE, $gID = NULL, $prefix = NULL, $customValueId = NULL, $entityId = NULL) {
    $details = array();
    foreach ($groupTree as $key => $group) {
      if ($key === 'info') {
        continue;
      }

      foreach ($group['fields'] as $k => $properties) {
        $groupID = $key;
        if (!empty($properties['customValue'])) {
          foreach ($properties['customValue'] as $values) {
            if (!empty($customValueId) && $customValueId != $values['id']) {
              continue;
            }
            $details[$groupID][$values['id']]['title'] = CRM_Utils_Array::value('title', $group);
            $details[$groupID][$values['id']]['name'] = CRM_Utils_Array::value('name', $group);
            $details[$groupID][$values['id']]['help_pre'] = CRM_Utils_Array::value('help_pre', $group);
            $details[$groupID][$values['id']]['help_post'] = CRM_Utils_Array::value('help_post', $group);
            $details[$groupID][$values['id']]['collapse_display'] = CRM_Utils_Array::value('collapse_display', $group);
            $details[$groupID][$values['id']]['collapse_adv_display'] = CRM_Utils_Array::value('collapse_adv_display', $group);
            $details[$groupID][$values['id']]['style'] = CRM_Utils_Array::value('style', $group);
            $details[$groupID][$values['id']]['fields'][$k] = array(
              'field_title' => CRM_Utils_Array::value('label', $properties),
              'field_type' => CRM_Utils_Array::value('html_type', $properties),
              'field_data_type' => CRM_Utils_Array::value('data_type', $properties),
              'field_value' => CRM_Core_BAO_CustomField::displayValue($values['data'], $properties['id'], $entityId),
              'options_per_line' => CRM_Utils_Array::value('options_per_line', $properties),
            );
            // editable = whether this set contains any non-read-only fields
            if (!isset($details[$groupID][$values['id']]['editable'])) {
              $details[$groupID][$values['id']]['editable'] = FALSE;
            }
            if (empty($properties['is_view'])) {
              $details[$groupID][$values['id']]['editable'] = TRUE;
            }
            // also return contact reference contact id if user has view all or edit all contacts perm
            if ((CRM_Core_Permission::check('view all contacts') ||
                CRM_Core_Permission::check('edit all contacts'))
              &&
              $details[$groupID][$values['id']]['fields'][$k]['field_data_type'] ==
              'ContactReference'
            ) {
              $details[$groupID][$values['id']]['fields'][$k]['contact_ref_id'] = CRM_Utils_Array::value('data', $values);
            }
          }
        }
        else {
          $details[$groupID][0]['title'] = CRM_Utils_Array::value('title', $group);
          $details[$groupID][0]['name'] = CRM_Utils_Array::value('name', $group);
          $details[$groupID][0]['help_pre'] = CRM_Utils_Array::value('help_pre', $group);
          $details[$groupID][0]['help_post'] = CRM_Utils_Array::value('help_post', $group);
          $details[$groupID][0]['collapse_display'] = CRM_Utils_Array::value('collapse_display', $group);
          $details[$groupID][0]['collapse_adv_display'] = CRM_Utils_Array::value('collapse_adv_display', $group);
          $details[$groupID][0]['style'] = CRM_Utils_Array::value('style', $group);
          $details[$groupID][0]['fields'][$k] = array('field_title' => CRM_Utils_Array::value('label', $properties));
        }
      }
    }

    if ($returnCount) {
      //return a single value count if group id is passed to function
      //else return a groupId and count mapped array
      if (!empty($gID)) {
        return count($details[$gID]);
      }
      else {
        $countValue = array();
        foreach ($details as $key => $value) {
          $countValue[$key] = count($details[$key]);
        }
        return $countValue;
      }
    }
    else {
      $form->assign_by_ref("{$prefix}viewCustomData", $details);
      return $details;
    }
  }

}
