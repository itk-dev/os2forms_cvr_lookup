<?php

namespace Drupal\os2forms_cvr_lookup\Plugin\WebformElement;

use Drupal\os2forms_nemid\Plugin\WebformElement\NemidElementCompanyInterface;

/**
 * @WebformElement(
 *   id = "cvr_floor_element",
 *   label = @Translation("CVR Floor Element"),
 *   description = @Translation("This element will be populated with the floor from the CVR query result"),
 *   category = @Translation("CVR elements")
 * )
 */
class CvrFloorElement extends CvrLookupElement implements NemidElementCompanyInterface {

  /**
   * {@inheritdoc}
   */
  public function getPrepopulateFieldFieldKey(array &$element) {
    return 'floor';
  }

}
