<?php

namespace Drupal\os2forms_cvr_lookup\Element;

use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\InvokeCommand;
use Drupal\Core\Ajax\MessageCommand;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Render\Element\Textfield;
use Drupal\os2forms_cvr_lookup\CVR\CvrServiceResult;
use ItkDev\Serviceplatformen\Service\Exception\NoCvrFoundException;

/**
 * @FormElement("cvr_element")
 */
class CvrElement extends Textfield {

  /**
   * {@inheritdoc}
   */
  public function getInfo() {
    $element = parent::getInfo();
    $element['#element_validate'] = [[$this, 'validate']];
    $element['#ajax'] = [
      'callback' => [$this, 'ajaxCallback'],
      'event' => 'change',
      'progress' => [
        'type' => 'throbber',
        'message' => $this->t('Looking up CVR'),
      ],
    ];

    return $element;
  }

  /**
   * Validation.
   *
   * @param $element
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   * @param $complete_form
   */
  public function validate(&$element, FormStateInterface $form_state, &$complete_form) {
    if ($element['#value'] !== '') {
      if (!preg_match('{^\d{8}$}', $element['#value'])) {
        $form_state->setError($element, $this->t('%name field is not a valid CVR.', ['%name' => $element['#title']]));
      }
    }
  }

  /**
   * Call back method when performing ajax request.
   *
   * @param array $form
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *
   * @return \Drupal\Core\Ajax\AjaxResponse
   *
   * @throws \ItkDev\Serviceplatformen\Service\Exception\ServiceException
   */
  public function ajaxCallback(array &$form, FormStateInterface $form_state) {

    $cvrNumberElement = $form_state->getTriggeringElement();
    $cvr = $cvrNumberElement['#value'];

    if ('' === $cvr) {
      $response = new AjaxResponse();
      $command = new MessageCommand($this->t('No CVR number provided.'), NULL, ['type' => 'error']);
      $response->addCommand($command);
      return $response;
    }

    if (!preg_match('{^\d{8}$}', $cvr)) {
      $response = new AjaxResponse();
      $command = new MessageCommand($this->t('Not a valid CVR number.'), NULL, ['type' => 'error']);
      $response->addCommand($command);
      return $response;
    }

    /** @var \Drupal\os2forms_cvr_lookup\Service\CvrService $cvrService */
    $cvrService = \Drupal::service('os2forms_cvr_lookup.service');

    try {
      $result = $cvrService->search($cvr);
    }
    catch (NoCvrFoundException $e) {
      $response = new AjaxResponse();
      $command = new MessageCommand($this->t('Not a valid CVR number.'), NULL, ['type' => 'error']);
      $response->addCommand($command);
      return $response;
    }

    $response = new AjaxResponse();

    $response->addCommand($this->getNameInvokeCommand($result));
    $response->addCommand($this->getStreetNameInvokeCommand($result));
    $response->addCommand($this->getHouseNumberInvokeCommand($result));
    $response->addCommand($this->getPostalCodeInvokeCommand($result));
    $response->addCommand($this->getCityInvokeCommand($result));

    return $response;
  }

  /**
   * Get Name Invoke Command.
   *
   * @param \Drupal\os2forms_cvr_lookup\CVR\CvrServiceResult $result
   *
   * @return \Drupal\Core\Ajax\InvokeCommand
   */
  private function getNameInvokeCommand(CvrServiceResult $result) {
    $selector = '.cvr-name';
    $method = 'val';
    $arguments = [$result->getName()];

    return new InvokeCommand($selector, $method, $arguments);
  }

  /**
   * Get Street Name Invoke Command.
   *
   * @param \Drupal\os2forms_cvr_lookup\CVR\CvrServiceResult $result
   *
   * @return \Drupal\Core\Ajax\InvokeCommand
   */
  public function getStreetNameInvokeCommand(CvrServiceResult $result) {
    $selector = '.cvr-street-name';
    $method = 'val';
    $arguments = [$result->getStreetName()];

    return new InvokeCommand($selector, $method, $arguments);
  }

  /**
   * Get House Number Invoke Command.
   *
   * @param \Drupal\os2forms_cvr_lookup\CVR\CvrServiceResult $result
   *
   * @return \Drupal\Core\Ajax\InvokeCommand
   */
  public function getHouseNumberInvokeCommand(CvrServiceResult $result) {
    $selector = '.cvr-house-number';
    $method = 'val';
    $arguments = [$result->getHouseNumber()];

    return new InvokeCommand($selector, $method, $arguments);
  }

  /**
   * Get Postal Code Invoke Command.
   *
   * @param \Drupal\os2forms_cvr_lookup\CVR\CvrServiceResult $result
   *
   * @return \Drupal\Core\Ajax\InvokeCommand
   */
  public function getPostalCodeInvokeCommand(CvrServiceResult $result) {
    $selector = '.cvr-postal-code';
    $method = 'val';
    $arguments = [$result->getPostalCode()];

    return new InvokeCommand($selector, $method, $arguments);
  }

  /**
   * Get City Invoke Command.
   *
   * @param \Drupal\os2forms_cvr_lookup\CVR\CvrServiceResult $result
   *
   * @return \Drupal\Core\Ajax\InvokeCommand
   */
  public function getCityInvokeCommand(CvrServiceResult $result) {
    $selector = '.cvr-city';
    $method = 'val';
    $arguments = [$result->getCity()];

    return new InvokeCommand($selector, $method, $arguments);
  }

}
