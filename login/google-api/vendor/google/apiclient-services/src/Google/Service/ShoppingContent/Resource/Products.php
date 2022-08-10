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
 *   $contentService = new Google_Service_ShoppingContent(...);
 *   $journals = $contentService->journals;
 *  </code>
 */
class Google_Service_ShoppingContent_Resource_journals extends Google_Service_Resource
{
  /**
   * Retrieves, inserts, and deletes multiple journals in a single request.
   * (journals.custombatch)
   *
   * @param Google_Service_ShoppingContent_journalsCustomBatchRequest $postBody
   * @param array $optParams Optional parameters.
   * @return Google_Service_ShoppingContent_journalsCustomBatchResponse
   */
  public function custombatch(Google_Service_ShoppingContent_journalsCustomBatchRequest $postBody, $optParams = array())
  {
    $params = array('postBody' => $postBody);
    $params = array_merge($params, $optParams);
    return $this->call('custombatch', array($params), "Google_Service_ShoppingContent_journalsCustomBatchResponse");
  }
  /**
   * Deletes a journal from your Merchant Center account. (journals.delete)
   *
   * @param string $merchantId The ID of the account that contains the journal.
   * This account cannot be a multi-client account.
   * @param string $journalId The REST ID of the journal.
   * @param array $optParams Optional parameters.
   *
   * @opt_param string feedId The Content API Supplemental Feed ID.
   */
  public function delete($merchantId, $journalId, $optParams = array())
  {
    $params = array('merchantId' => $merchantId, 'journalId' => $journalId);
    $params = array_merge($params, $optParams);
    return $this->call('delete', array($params));
  }
  /**
   * Retrieves a journal from your Merchant Center account. (journals.get)
   *
   * @param string $merchantId The ID of the account that contains the journal.
   * This account cannot be a multi-client account.
   * @param string $journalId The REST ID of the journal.
   * @param array $optParams Optional parameters.
   * @return Google_Service_ShoppingContent_journal
   */
  public function get($merchantId, $journalId, $optParams = array())
  {
    $params = array('merchantId' => $merchantId, 'journalId' => $journalId);
    $params = array_merge($params, $optParams);
    return $this->call('get', array($params), "Google_Service_ShoppingContent_journal");
  }
  /**
   * Uploads a journal to your Merchant Center account. If an item with the same
   * channel, contentLanguage, offerId, and targetCountry already exists, this
   * method updates that entry. (journals.insert)
   *
   * @param string $merchantId The ID of the account that contains the journal.
   * This account cannot be a multi-client account.
   * @param Google_Service_ShoppingContent_journal $postBody
   * @param array $optParams Optional parameters.
   *
   * @opt_param string feedId The Content API Supplemental Feed ID.
   * @return Google_Service_ShoppingContent_journal
   */
  public function insert($merchantId, Google_Service_ShoppingContent_journal $postBody, $optParams = array())
  {
    $params = array('merchantId' => $merchantId, 'postBody' => $postBody);
    $params = array_merge($params, $optParams);
    return $this->call('insert', array($params), "Google_Service_ShoppingContent_journal");
  }
  /**
   * Lists the journals in your Merchant Center account. (journals.listjournals)
   *
   * @param string $merchantId The ID of the account that contains the journals.
   * This account cannot be a multi-client account.
   * @param array $optParams Optional parameters.
   *
   * @opt_param string maxResults The maximum number of journals to return in the
   * response, used for paging.
   * @opt_param string pageToken The token returned by the previous request.
   * @return Google_Service_ShoppingContent_journalsListResponse
   */
  public function listjournals($merchantId, $optParams = array())
  {
    $params = array('merchantId' => $merchantId);
    $params = array_merge($params, $optParams);
    return $this->call('list', array($params), "Google_Service_ShoppingContent_journalsListResponse");
  }
}
