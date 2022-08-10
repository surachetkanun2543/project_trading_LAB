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
 *   $adexchangebuyer2Service = new Google_Service_AdExchangeBuyerII(...);
 *   $journals = $adexchangebuyer2Service->journals;
 *  </code>
 */
class Google_Service_AdExchangeBuyerII_Resource_Accountsjournals extends Google_Service_Resource
{
  /**
   * Gets the requested journal by ID. (journals.get)
   *
   * @param string $accountId Account ID of the buyer.
   * @param string $journalId The ID for the journal to get the head revision for.
   * @param array $optParams Optional parameters.
   * @return Google_Service_AdExchangeBuyerII_journal
   */
  public function get($accountId, $journalId, $optParams = array())
  {
    $params = array('accountId' => $accountId, 'journalId' => $journalId);
    $params = array_merge($params, $optParams);
    return $this->call('get', array($params), "Google_Service_AdExchangeBuyerII_journal");
  }
  /**
   * List all journals visible to the buyer (optionally filtered by the specified
   * PQL query). (journals.listAccountsjournals)
   *
   * @param string $accountId Account ID of the buyer.
   * @param array $optParams Optional parameters.
   *
   * @opt_param string pageToken The page token as returned from
   * ListjournalsResponse.
   * @opt_param int pageSize Requested page size. The server may return fewer
   * results than requested. If unspecified, the server will pick an appropriate
   * default.
   * @opt_param string filter An optional PQL query used to query for journals.
   * See https://developers.google.com/ad-manager/docs/pqlreference for
   * documentation about PQL and examples.
   *
   * Nested repeated fields, such as journal.targetingCriterion.inclusions, cannot
   * be filtered.
   * @return Google_Service_AdExchangeBuyerII_ListjournalsResponse
   */
  public function listAccountsjournals($accountId, $optParams = array())
  {
    $params = array('accountId' => $accountId);
    $params = array_merge($params, $optParams);
    return $this->call('list', array($params), "Google_Service_AdExchangeBuyerII_ListjournalsResponse");
  }
}
