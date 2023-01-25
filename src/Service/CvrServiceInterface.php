<?php

namespace Drupal\os2forms_cvr_lookup\Service;

/**
 * CVR Service interface.
 */
interface CvrServiceInterface {

  /**
   * Performs a call on the CVR Extended service.
   *
   * @param string $cvr
   *   The CVR number to search for.
   *
   * @return \Drupal\os2forms_cvr_lookup\CVR\CvrServiceResult
   *   The CPR Service Result.
   *
   * @throws \ItkDev\Serviceplatformen\Service\Exception\ServiceException
   */
  public function search($cvr);

}
