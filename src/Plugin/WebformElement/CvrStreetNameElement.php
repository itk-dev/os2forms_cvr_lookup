<?php

namespace Drupal\os2forms_cvr_lookup\Plugin\WebformElement;

use Drupal\webform\Plugin\WebformElement\TextField;

/**
 * @WebformElement(
 *   id = "cvr_street_name_element",
 *   label = @Translation("CVR Street Name Element"),
 *   description = @Translation("This element will be populated with the Street Name from the CVR query result"),
 *   category = @Translation("CVR elements")
 * )
 */
class CvrStreetNameElement extends TextField {

}
