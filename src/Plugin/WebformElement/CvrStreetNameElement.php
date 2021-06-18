<?php

namespace Drupal\os2forms_cvr_lookup\Plugin\WebformElement;

use Drupal\webform\Plugin\WebformElement\TextField;

/**
 * @WebformElement(
 *   id = "cvr_street_name_element",
 *   label = "CVR Street Name Element",
 *   description = "This element will be populated with the Street Name from the CVR query result",
 *   category = "CVR elements"
 * )
 */
class CvrStreetNameElement extends TextField {

}
