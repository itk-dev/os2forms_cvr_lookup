<?php

namespace Drupal\os2forms_cvr_lookup\Plugin\WebformElement;

use Drupal\webform\Plugin\WebformElement\TextField;

/**
 * @WebformElement(
 *   id = "cvr_city_element",
 *   label = @Translation("CVR City Element"),
 *   description = @Translation("This element will be populated with the City from the CVR query result"),
 *   category = @Translation("CVR elements")
 * )
 */
class CvrCityElement extends TextField {

}
