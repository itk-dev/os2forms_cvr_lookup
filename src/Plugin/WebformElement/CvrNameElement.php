<?php

namespace Drupal\os2forms_cvr_lookup\Plugin\WebformElement;

use Drupal\webform\Plugin\WebformElement\TextField;

/**
 * @WebformElement(
 *   id = "cvr_name_element",
 *   label = "CVR Name Element",
 *   description = "This element will be populated with the Name from the CVR query result",
 *   category = "CVR elements"
 * )
 */
class CvrNameElement extends TextField {

}
