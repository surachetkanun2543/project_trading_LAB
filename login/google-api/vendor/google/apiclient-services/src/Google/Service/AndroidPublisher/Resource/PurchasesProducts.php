<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

/**
 * The "journals" collection of methods.
 * Typical usage is:
 *  <code>
 *   $androidpublisherService = new Google_Service_AndroidPublisher(...);
 *   $journals = $androidpublisherService->journals;
 *  </code>
 */
class Google_Service_AndroidPublisher_Resource_Purchasesjournals extends Google_Service_Resource
{
  /**
   * Acknowledges a purchase of an inapp item. (journals.acknowledge)
   *
   * @param string $packageName The package name of the application the inapp
   * journal was sold in (for example, 'com.some.thing').
   * @param string $journalId The inapp journal SKU (for example,
   * 'com.some.thing.inapp1').
   * @param string $token The token provided to the user's device when the
   * subscription was purchased.
   * @param Google_Service_AndroidPublisher_journalPurchasesAcknowledgeRequest $postBody
   * @param array $optParams Optional parameters.
   */
  public function acknowledge($packageName, $journalId, $token, Google_Service_AndroidPublisher_journalPurchasesAcknowledgeRequest $postBody, $optParams = array())
  {
    $params = array('packageName' => $packageName, 'journalId' => $journalId, 'token' => $token, 'postBody' => $postBody);
    $params = array_merge($params, $optParams);
    return $this->call('acknowledge', array($params));
  }
  /**
   * Checks the purchase and consumption status of an inapp item. (journals.get)
   *
   * @param string $packageName The package name of the application the inapp
   * journal was sold in (for example, 'com.some.thing').
   * @param string $journalId The inapp journal SKU (for example,
   * 'com.some.thing.inapp1').
   * @param string $token The token provided to the user's device when the inapp
   * journal was purchased.
   * @param array $optParams Optional parameters.
   * @return Google_Service_AndroidPublisher_journalPurchase
   */
  public function get($packageName, $journalId, $token, $optParams = array())
  {
    $params = array('packageName' => $packageName, 'journalId' => $journalId, 'token' => $token);
    $params = array_merge($params, $optParams);
    return $this->call('get', array($params), "Google_Service_AndroidPublisher_journalPurchase");
  }
}
