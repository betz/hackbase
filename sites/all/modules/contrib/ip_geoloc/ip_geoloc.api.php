<?php

/**
 * @file
 * Hooks provided by "IP Geolocation Views & Maps" (ip_geoloc).
 */

/**
 * @addtogroup hooks
 * @{
 */

/**
 * To hook in your own gelocation data provider or to modify the existing one.
 *
 * @param array $location
 *   The location to alter.
 */
function hook_get_ip_geolocation_alter(&$location) {
  if (empty($location['ip_address'])) {
    return;
  }
  $location['provider'] = 'MYMODULE';
  // ....
  $location['city'] = $location['locality'];
}

/**
 * Modify the array of locations coming from the View before they're mapped.
 *
 * @param array $marker_locations
 *   An array of marker locations.
 * @param object $view
 *   The view from which $marker_locations was generated.
 */
function hook_ip_geoloc_marker_locations_alter(&$marker_locations, &$view) {
  // Machine name of your view here.
  if ($view->name == 'my_beautiful_view') {
    if (count($marker_locations) >= 2) {
      $marker_locations[0]->marker_color = 'orange';
      $marker_locations[1]->marker_color = 'yellow';
    }
    $observatory = new stdClass();
    $observatory->latitude = 51.4777;
    $observatory->longitude = -0.0015;
    $observatory->balloon_text = t('The zero-meridian passes through the courtyard of the <strong>Greenwich</strong> observatory.');
    $observatory->marker_color = 'white';
    array_unshift($marker_locations, $observatory);
  }
}

/**
 * @} End of "addtogroup hooks".
 */
