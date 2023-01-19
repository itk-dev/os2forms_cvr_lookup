<?php

namespace Drupal\os2forms_cvr_lookup\Commands;

use Drupal\os2forms_cvr_lookup\Service\CvrServiceInterface;
use Drush\Commands\DrushCommands;
use Symfony\Component\Yaml\Yaml;

/**
 * Drush commands for os2forms_cvr_lookup.
 */
final class Commands extends DrushCommands {

  /**
   * The CVR service.
   */
  private CvrServiceInterface $cvrService;

  /**
   * Constructor.
   */
  public function __construct(CvrServiceInterface $cvrService) {
    $this->cvrService = $cvrService;
  }

  /**
   * Look up CVR.
   *
   * @param string $cvr
   *   The cvr.
   *
   * @command os2forms_cvr_lookup:search
   * @usage os2forms_cvr_lookup:search --help
   */
  public function search(string $cvr) {
    $result = $this->cvrService->search($cvr);

    $this->writeln(Yaml::dump($result->toArray()));
  }

}
