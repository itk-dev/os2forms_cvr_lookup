<?php

namespace Drupal\os2forms_cvr_lookup\Plugin\WebformElement;

use Drupal\webform\Plugin\WebformElement\TextField;
use Drupal\webform\WebformSubmissionInterface;

/**
 * @WebformElement(
 *   id = "cvr_element",
 *   label = @Translation("CVR Element"),
 *   description = @Translation("CVR Element description"),
 *   category = @Translation("CVR elements")
 * )
 */
class CvrElement extends TextField {

  /**
   * {@inheritdoc}
   */
  public function prepare(array &$element, WebformSubmissionInterface $webform_submission = null)
  {
    $element['#attributes']['class'][] = 'os2forms-cvr-lookup-cvr-element';
    $element['#attached']['library'][] = 'os2forms_cvr_lookup/os2forms_cvr_lookup';
    parent::prepare($element, $webform_submission);
  }
}
