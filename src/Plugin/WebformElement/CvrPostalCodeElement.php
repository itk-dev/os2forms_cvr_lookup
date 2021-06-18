<?php

namespace Drupal\os2forms_cvr_lookup\Plugin\WebformElement;

use Drupal\webform\Plugin\WebformElement\TextField;

/**
 * @WebformElement(
 *   id = "cvr_postal_code_element",
 *   label = "CVR Postal Code Element",
 *   description = "This element will be populated with the Postal Code from the CVR query result",
 *   category = "CVR elements"
 * )
 */
class CvrPostalCodeElement extends TextField {

}