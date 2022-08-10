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
 * The "journalstatuses" collection of methods.
 * Typical usage is:
 *  <code>
 *   $contentService = new Google_Service_ShoppingContent(...);
 *   $journalstatuses = $contentService->journalstatuses;
 *  </code>
 */
class Google_Service_ShoppingContent_Resource_journalstatuses extends Google_Service_Resource
{
  /**
   * Gets the statuses of multiple journals in a single request.
   * (journalstatuses.custombatch)
   *
   * @param Google_Service_ShoppingContent_journalstatusesCustomBatchRequest $postBody
   * @param array $optParams Optional parameters.
   * @return Google_Service_ShoppingContent_journalstatusesCustomBatchResponse
   */
  public function custombatch(Google_Service_ShoppingContent_journalstatusesCustomBatchRequest $postBody, $optParams = array())
  {
    $params = array('postBody' => $postBody);
    $params = array_merge($params, $optParams);
    return $this->call('custombatch', array($params), "Google_Service_ShoppingContent_journalstatusesCustomBatchResponse");
  }
  /**
   * Gets the status of a journal from your Merchant Center account.
   * (journalstatuses.get)
   *
   * @param string $merchantId The ID of the account that contains the journal.
   * This account cannot be a multi-client account.
   * @param string $journalId The REST ID of the journal.
   * @param array $optParams Optional parameters.
   *
   * @opt_param string destinations If set, only issues for the specified
   * destinations are returned, otherwise only issues for the Shopping
   * destination.
   * @return Google_Service_ShoppingContent_journalStatus
   */
  public function get($merchantId, $journalId, $optParams = array())
  {
    $params = array('merchantId' => $merchantId, 'journalId' => $journalId);
    $params = array_merge($params, $optParams);
    return $this->call('get', array($params), "Google_Service_ShoppingContent_journalStatus");
  }
  /**
   * Lists the statuses of the journals in your Merchant Center account.
   * (journalstatuses.listjournalstatuses)
   *
   * @param string $merchantId The ID of the account that contains the journals.
   * This account cannot be a multi-client account.
   * @param array $optParams Optional parameters.
   *
   * @opt_param string destinations If set, only issues for the specified
   * destinations are returned, otherwise only issues for the Shopping
   * destination.
   * @opt_param string maxResults The maximum number of journal statuses to return
   * in the response, used for paging.
   * @opt_param string pageToken The token returned by the previous request.
   * @return Google_Service_ShoppingContent_journalstatusesListResponse
   */
  public function listjournalstatuses($merchantId, $optParams = array())
  {
    $params = array('merchantId' => $merchantId);
    $params = array_merge($params, $optParams);
    return $this->call('list', array($params), "Google_Service_ShoppingContent_journalstatusesListResponse");
  }
}
