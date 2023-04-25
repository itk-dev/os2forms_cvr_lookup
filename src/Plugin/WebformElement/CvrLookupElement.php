<?php

namespace Drupal\os2forms_cvr_lookup\Plugin\WebformElement;

use Drupal\Core\Config\ConfigFactoryInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\ElementInfoManagerInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\os2forms_cvr_lookup\Service\CvrServiceInterface;
use Drupal\os2forms_nemid\Plugin\WebformElement\NemidElementBase;
use Drupal\os2web_nemlogin\Service\AuthProviderService;
use Drupal\webform\Plugin\WebformElementManagerInterface;
use Drupal\webform\WebformLibrariesManagerInterface;
use Drupal\webform\WebformTokenManagerInterface;
use ItkDev\Serviceplatformen\Service\Exception\ServiceException;
use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides an abstract CvrLookupElement alement.
 *
 * Implements the prepopulate logic.
 *
 * @see \Drupal\webform\Plugin\WebformElementBase
 * @see \Drupal\webform\Plugin\WebformElementInterface
 * @see \Drupal\webform\Annotation\WebformElement
 */
abstract class CvrLookupElement extends NemidElementBase {
  protected const FORM_STATE_DATA = 'CvrLookupElement';

  /**
   * The auth provider service.
   *
   * @var \Drupal\os2web_nemlogin\Service\AuthProviderService
   */
  private $authProviderService;

  /**
   * The CVR service.
   *
   * @var \Drupal\os2forms_cvr_lookup\Service\CvrServiceInterface
   */
  private $cvrService;

  /**
   * Constructor.
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    LoggerInterface $logger,
    ConfigFactoryInterface $config_factory,
    AccountInterface $current_user,
    EntityTypeManagerInterface $entity_type_manager,
    ElementInfoManagerInterface $element_info,
    WebformElementManagerInterface $element_manager,
    WebformTokenManagerInterface $token_manager,
    WebformLibrariesManagerInterface $libraries_manager,
    AuthProviderService $authProviderService,
    CvrServiceInterface $cvrService
  ) {
    // PluginBase::__construct() accepts only three arguments.
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->logger = $logger;
    $this->configFactory = $config_factory;
    $this->currentUser = $current_user;
    $this->entityTypeManager = $entity_type_manager;
    $this->elementInfo = $element_info;
    $this->elementManager = $element_manager;
    $this->tokenManager = $token_manager;
    $this->librariesManager = $libraries_manager;
    $this->authProviderService = $authProviderService;
    $this->cvrService = $cvrService;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('logger.factory')->get('webform'),
      $container->get('config.factory'),
      $container->get('current_user'),
      $container->get('entity_type.manager'),
      $container->get('plugin.manager.element_info'),
      $container->get('plugin.manager.webform.element'),
      $container->get('webform.token_manager'),
      $container->get('webform.libraries_manager'),
      $container->get('os2web_nemlogin.auth_provider'),
      $container->get('os2forms_cvr_lookup.service')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function handleElementPrepopulate(array &$element, FormStateInterface &$form_state) {
    $prepopulateKey = $this->getPrepopulateFieldFieldKey($element);
    // Fetch value from cvr lookup.
    $data = NULL;

    if ($form_state->has(static::FORM_STATE_DATA)) {
      $data = $form_state->get(static::FORM_STATE_DATA);
    }
    else {
      // Making the request to the plugin, and storing the information on the
      // form, so that it's available on the next element within the same
      // webform render.
      $plugin = $this->authProviderService->getActivePlugin();

      if ($plugin->isAuthenticated()) {
        try {
          $cvr = $plugin->fetchValue('cvr');
          if ($cvr) {
            $result = $this->cvrService->search($cvr);
            $data = $result->toArray();
            // Add data for the CVR value element.
            $data['cvr'] = $cvr;

            $form_state->set(static::FORM_STATE_DATA, $data);
          }
        }
        catch (ServiceException $serviceException) {
          // @todo Log this?
        }
      }
    }

    if (!empty($data)) {
      if (isset($data[$prepopulateKey])) {
        $value = $data[$prepopulateKey];
        $element['#value'] = $value;
      }
    }
  }

}
