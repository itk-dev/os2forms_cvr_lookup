<?php

namespace Drupal\os2forms_cvr_lookup\Plugin\WebformElement;

use Drupal\os2forms_nemid\Plugin\WebformElement\NemidElementCompanyInterface;

/**
 * @WebformElement(
 *   id = "cvr_postal_code_element",
 *   label = @Translation("CVR Postal Code Element"),
 *   description = @Translation("This element will be populated with the Postal Code from the CVR query result"),
 *   category = @Translation("CVR elements")
 * )
 */
class CvrPostalCodeElement extends CvrLookupElement implements NemidElementCompanyInterface {

  /**
   * {@inheritdoc}
   */
  public function getPrepopulateFieldFieldKey() {
    return 'postal_code';
  }

}
