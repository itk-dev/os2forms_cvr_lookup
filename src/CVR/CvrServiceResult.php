<?php

namespace Drupal\os2forms_cvr_lookup\CVR;

use Symfony\Component\PropertyAccess\PropertyAccess;

class CvrServiceResult {

  /**
   * The original response from the CVR Service.
   *
   * @var object
   */
  private $response;

  /**
   * PropertyAccessor used for accessing the original response.
   *
   * @var \Symfony\Component\PropertyAccess\PropertyAccessor
   */
  private $propertyAccessor;

  public function __construct(object $response) {
    $this->response = $response;
    $this->propertyAccessor = PropertyAccess::createPropertyAccessor();
  }

  /**
   * Get name.
   *
   * @return string
   */
  public function getName(): string {
    return $this->getProperty('GetLegalUnitResponse.LegalUnit.LegalUnitName.name');
  }

  /**
   * Get Street Name.
   *
   * @return string
   */
  public function getStreetName(): string {
    return $this->getProperty('GetLegalUnitResponse.LegalUnit.AddressOfficial.AddressPostalExtended.StreetName');
  }

  /**
   * Get House Number.
   *
   * @return string
   */
  public function getHouseNumber(): string {
    return $this->getProperty('GetLegalUnitResponse.LegalUnit.AddressOfficial.AddressPostalExtended.StreetBuildingIdentifier');
  }

  /**
   * Get Postal Code
   *
   * @return string
   */
  public function getPostalCode(): string {
    return $this->getProperty('GetLegalUnitResponse.LegalUnit.AddressOfficial.AddressPostalExtended.PostCodeIdentifier');
  }


  /**
   * Get City
   *
   * @return string
   */
  public function getCity(): string {
    return $this->getProperty('GetLegalUnitResponse.LegalUnit.AddressOfficial.AddressPostalExtended.DistrictName');
  }

  /**
   * Returns the value of the property.
   *
   * @param string $property
   *   Name of property.
   *
   * @return string
   *   The value of the property. Empty if property does not exist.
   */
  private function getProperty(string $property): string {
    return $this->propertyAccessor->isReadable($this->response, $property)
      ? $this->propertyAccessor->getValue($this->response, $property)
      : '';
  }
}
