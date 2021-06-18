<?php

namespace Drupal\os2forms_cvr_lookup\Element;

use Drupal\Core\Render\Element\Textfield;

/**
 * @FormElement("cvr_city_element")
 */
class CvrCityElement extends Textfield {

  /**
   * {@inheritDoc}
   */
  public static function preRenderTextfield($element) {
    $element = parent::preRenderTextfield($element);
    static::setAttributes($element, ['cvr-city']);

    return $element;
  }

}
