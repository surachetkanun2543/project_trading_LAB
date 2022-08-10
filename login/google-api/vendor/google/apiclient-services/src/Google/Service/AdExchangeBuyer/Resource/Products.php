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
 *   $adexchangebuyerService = new Google_Service_AdExchangeBuyer(...);
 *   $journals = $adexchangebuyerService->journals;
 *  </code>
 */
class Google_Service_AdExchangeBuyer_Resource_journals extends Google_Service_Resource
{
  /**
   * Gets the requested journal by id. (journals.get)
   *
   * @param string $journalId The id for the journal to get the head revision for.
   * @param array $optParams Optional parameters.
   * @return Google_Service_AdExchangeBuyer_journal
   */
  public function get($journalId, $optParams = array())
  {
    $params = array('journalId' => $journalId);
    $params = array_merge($params, $optParams);
    return $this->call('get', array($params), "Google_Service_AdExchangeBuyer_journal");
  }
  /**
   * Gets the requested journal. (journals.search)
   *
   * @param array $optParams Optional parameters.
   *
   * @opt_param string pqlQuery The pql query used to query for journals.
   * @return Google_Service_AdExchangeBuyer_GetOffersResponse
   */
  public function search($optParams = array())
  {
    $params = array();
    $params = array_merge($params, $optParams);
    return $this->call('search', array($params), "Google_Service_AdExchangeBuyer_GetOffersResponse");
  }
}
