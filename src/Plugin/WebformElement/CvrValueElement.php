<?php

namespace Drupal\os2forms_cvr_lookup\Plugin\WebformElement;

use Drupal\os2forms_nemid\Plugin\WebformElement\NemidElementCompanyInterface;

/**
 * * CVR Value Element.
 *
 * @WebformElement(
 *   id = "cvr_value_element",
 *   label = @Translation("CVR Value Element"),
 *   description = @Translation("This element will be prepopulated with the CVR number"),
 *   category = @Translation("CVR elements")
 * )
 */
class CvrValueElement extends CvrLookupElement implements NemidElementCompanyInterface {

  /**
   * {@inheritdoc}
   */
  public function getPrepopulateFieldFieldKey(array &$element) {
    return 'cvr';
  }

}
