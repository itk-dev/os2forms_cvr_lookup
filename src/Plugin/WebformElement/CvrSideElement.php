<?php

namespace Drupal\os2forms_cvr_lookup\Plugin\WebformElement;

use Drupal\os2forms_nemid\Plugin\WebformElement\NemidElementCompanyInterface;

/**
 * @WebformElement(
 *   id = "cvr_side_element",
 *   label = @Translation("CVR Side Element"),
 *   description = @Translation("This element will be populated with the side from the CVR query result"),
 *   category = @Translation("CVR elements")
 * )
 */
class CvrSideElement extends CvrLookupElement implements NemidElementCompanyInterface {

  /**
   * {@inheritdoc}
   */
  public function getPrepopulateFieldFieldKey() {
    return 'side';
  }

}
