<?php

namespace Drupal\os2forms_cvr_lookup\Plugin\WebformElement;

use Drupal\webform\Plugin\WebformElement\TextField;

/**
 * @WebformElement(
 *   id = "cvr_city_element",
 *   label = "CVR City Element",
 *   description = "This element will be populated with the City from the CVR query result",
 *   category = "CVR elements"
 * )
 */
class CvrCityElement extends TextField {

}
