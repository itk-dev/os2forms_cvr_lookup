<?php

namespace Drupal\os2forms_cvr_lookup\Plugin\WebformElement;

use Drupal\os2forms_nemid\Plugin\WebformElement\NemidElementCompanyInterface;

/**
 * @WebformElement(
 *   id = "cvr_city_element",
 *   label = @Translation("CVR City Element"),
 *   description = @Translation("This element will be populated with the city from the CVR query result"),
 *   category = @Translation("CVR elements")
 * )
 */
class CvrCityElement extends CvrLookupElement implements NemidElementCompanyInterface {

  /**
   * {@inheritdoc}
   */
  public function getPrepopulateFieldFieldKey(array &$element) {
    return 'city';
  }

}
