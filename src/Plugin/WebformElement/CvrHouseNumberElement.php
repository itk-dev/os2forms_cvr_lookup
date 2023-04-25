<?php

namespace Drupal\os2forms_cvr_lookup\Plugin\WebformElement;

use Drupal\os2forms_nemid\Plugin\WebformElement\NemidElementCompanyInterface;

/**
 * @WebformElement(
 *   id = "cvr_house_number_element",
 *   label = @Translation("CVR House Number Element"),
 *   description = @Translation("This element will be populated with the house number from the CVR query result"),
 *   category = @Translation("CVR elements")
 * )
 */
class CvrHouseNumberElement extends CvrLookupElement implements NemidElementCompanyInterface {

  /**
   * {@inheritdoc}
   */
  public function getPrepopulateFieldFieldKey(array &$element) {
    return 'house_number';
  }

}
