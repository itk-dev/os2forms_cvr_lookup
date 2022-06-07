(function($, Drupal) {
  // Handle the `change` event which is triggered by webform states when an
  // element is hidden or shown.
  $('.os2forms-cvr-lookup-cvr-element').on('change', function(event) {
    // Trigger AJAX event only when webform states is not triggering the
    // `change` event and when the CVR element is actually visible.
    if ('webform.states' !== extraParameters && $(this).is(':visible')) {
      $(this).trigger('os2forms_cvr_lookup:change')
    }
  })
})(jQuery, Drupal);
