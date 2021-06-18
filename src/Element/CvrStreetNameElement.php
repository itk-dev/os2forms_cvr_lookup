<?php

namespace Drupal\os2forms_cvr_lookup\Element;

use Drupal\Core\Render\Element\Textfield;

/**
 * @FormElement("cvr_street_name_element")
 */
class CvrStreetNameElement extends Textfield {

  /**
   * {@inheritDoc}
   */
  public static function preRenderTextfield($element) {
    $element = parent::preRenderTextfield($element);
    static::setAttributes($element, ['cvr-street-name']);

    return $element;
  }

}
