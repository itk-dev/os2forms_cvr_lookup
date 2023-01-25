<?php

namespace Drupal\os2forms_cvr_lookup\CVR;

use Symfony\Component\PropertyAccess\PropertyAccess;

/**
 * Encapsulates a result from the CVR service.
 */
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

  /**
   * Constructor.
   */
  public function __construct(object $response) {
    $this->response = $response;
    $this->propertyAccessor = PropertyAccess::createPropertyAccessor();
  }

  /**
   * Get name.
   *
   * @return string
   *   Containing the name of the company
   */
  public function getName(): string {
    return $this->getProperty('GetLegalUnitResponse.LegalUnit.LegalUnitName.name');
  }

  /**
   * Get Street Name.
   *
   * @return string
   *   Containing the name of the street
   */
  public function getStreetName(): string {
    return $this->getProperty('GetLegalUnitResponse.LegalUnit.AddressOfficial.AddressPostalExtended.StreetName');
  }

  /**
   * Get House Number.
   *
   * @return string
   *   Containing the number of the building
   */
  public function getHouseNumber(): string {
    return $this->getProperty('GetLegalUnitResponse.LegalUnit.AddressOfficial.AddressPostalExtended.StreetBuildingIdentifier');
  }

  /**
   * Get floor.
   *
   * @return string
   *   Containing the floor of the building
   */
  public function getFloor(): string {
    return $this->getProperty('GetLegalUnitResponse.LegalUnit.AddressOfficial.AddressPostalExtended.FloorIdentifier');
  }

  /**
   * Get side.
   *
   * @return string
   *   Containing the side of the apartment on the floor
   */
  public function getSide(): string {
    return $this->getProperty('GetLegalUnitResponse.LegalUnit.AddressOfficial.AddressPostalExtended.SuiteIdentifier');
  }

  /**
   * Get Postal Code.
   *
   * @return string
   *   Containing the postal code
   */
  public function getPostalCode(): string {
    return $this->getProperty('GetLegalUnitResponse.LegalUnit.AddressOfficial.AddressPostalExtended.PostCodeIdentifier');
  }

  /**
   * Get City.
   *
   * @return string
   *   Containing the city
   */
  public function getCity(): string {
    return $this->getProperty('GetLegalUnitResponse.LegalUnit.AddressOfficial.AddressPostalExtended.DistrictName');
  }

  /**
   * Get full address (one line).
   *
   * @return string
   *   Containing the formatted address.
   */
  public function getAddress(): string {
    $address = $this->getStreetName();

    $address .= NULL !== $this->getHouseNumber()
      ? ' ' . $this->getHouseNumber() . ''
      : '';

    $address .= (NULL !== $this->getFloor() && '' !== $this->getFloor())
      ? ', ' . $this->getFloor() . '.'
      : '';

    $address .= (NULL !== $this->getSide() && '' !== $this->getSide())
      ? ' ' . $this->getSide()
      : '';

    $address .= ', '
      . $this->getPostalCode()
      . ' '
      . $this->getCity();

    return $address;
  }

  /**
   * Get all values in an associative array.
   *
   * @return array
   *   Containing all values
   */
  public function toArray(): array {
    return [
      'name' => $this->getName(),
      'postal_code' => $this->getPostalCode(),
      'city' => $this->getCity(),
      'street_name' => $this->getStreetName(),
      'house_number' => $this->getHouseNumber(),
      'floor' => $this->getFloor(),
      'side' => $this->getSide(),
      'address' => $this->getAddress(),
    ];
  }

  /**
   * Returns the value of the property.
   *
   * @param string $property
   *   Name of property.
   *
   * @return string
   *   Containing the value of the property. Empty if property does not exist.
   */
  private function getProperty(string $property): string {
    return $this->propertyAccessor->isReadable($this->response, $property)
      ? $this->propertyAccessor->getValue($this->response, $property)
      : '';
  }

}
