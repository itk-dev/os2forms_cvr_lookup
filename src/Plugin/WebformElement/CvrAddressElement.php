<?php

namespace Drupal\os2forms_cvr_lookup\Plugin\WebformElement;

use Drupal\os2forms_nemid\Plugin\WebformElement\NemidElementCompanyInterface;

/**
 * @WebformElement(
 *   id = "cvr_address_element",
 *   label = @Translation("CVR Address Element"),
 *   description = @Translation("This element will be populated with the full address from the CVR query result"),
 *   category = @Translation("CVR elements")
 * )
 */
class CvrAddressElement extends CvrLookupElement implements NemidElementCompanyInterface {

  /**
   * {@inheritdoc}
   */
  public function getPrepopulateFieldFieldKey(array &$element) {
    return 'address';
  }

}
