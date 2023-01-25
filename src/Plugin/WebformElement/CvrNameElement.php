<?php

namespace Drupal\os2forms_cvr_lookup\Plugin\WebformElement;

use Drupal\os2forms_nemid\Plugin\WebformElement\NemidElementCompanyInterface;

/**
 * @WebformElement(
 *   id = "cvr_name_element",
 *   label = @Translation("CVR Name Element"),
 *   description = @Translation("This element will be populated with the name from the CVR query result"),
 *   category = @Translation("CVR elements")
 * )
 */
class CvrNameElement extends CvrLookupElement implements NemidElementCompanyInterface {

  /**
   * {@inheritdoc}
   */
  public function getPrepopulateFieldFieldKey() {
    return 'name';
  }

}
