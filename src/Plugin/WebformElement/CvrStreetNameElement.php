<?php

namespace Drupal\os2forms_cvr_lookup\Plugin\WebformElement;

use Drupal\os2forms_nemid\Plugin\WebformElement\NemidElementCompanyInterface;

/**
 * @WebformElement(
 *   id = "cvr_street_name_element",
 *   label = @Translation("CVR Street Name Element"),
 *   description = @Translation("This element will be populated with the Street Name from the CVR query result"),
 *   category = @Translation("CVR elements")
 * )
 */
class CvrStreetNameElement extends CvrLookupElement implements NemidElementCompanyInterface {

  /**
   * {@inheritdoc}
   */
  public function getPrepopulateFieldFieldKey() {
    return 'street_name';
  }

}
