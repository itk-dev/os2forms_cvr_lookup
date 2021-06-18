<?php

namespace Drupal\os2forms_cvr_lookup\Plugin\WebformElement;

use Drupal\webform\Plugin\WebformElement\TextField;

/**
 * @WebformElement(
 *   id = "cvr_house_number_element",
 *   label = "CVR House Number Element",
 *   description = "This element will be populated with the House Number from the CVR query result",
 *   category = "CVR elements"
 * )
 */
class CvrHouseNumberElement extends TextField {

}
