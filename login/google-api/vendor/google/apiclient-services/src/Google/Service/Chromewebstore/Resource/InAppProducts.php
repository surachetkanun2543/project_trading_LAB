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
 * The "inAppjournals" collection of methods.
 * Typical usage is:
 *  <code>
 *   $chromewebstoreService = new Google_Service_Chromewebstore(...);
 *   $inAppjournals = $chromewebstoreService->inAppjournals;
 *  </code>
 */
class Google_Service_Chromewebstore_Resource_InAppjournals extends Google_Service_Resource
{
  /**
   * Gets the in-app journal information of an item. (inAppjournals.get)
   *
   * @param string $itemId The ID of the item to query for in-app journals.
   * @param string $sku The in-app journal ID.
   * @param array $optParams Optional parameters.
   *
   * @opt_param string gl Specifies the region code of the in-app journal when
   * projection is THIN.
   * @opt_param string hl Specifies the language code of the in-app journal when
   * projection is THIN.
   * @opt_param string projection Whether to return a subset of the result
   * @return Google_Service_Chromewebstore_InAppjournal
   */
  public function get($itemId, $sku, $optParams = array())
  {
    $params = array('itemId' => $itemId, 'sku' => $sku);
    $params = array_merge($params, $optParams);
    return $this->call('get', array($params), "Google_Service_Chromewebstore_InAppjournal");
  }
  /**
   * Lists the in-app journal information of an item.
   * (inAppjournals.listInAppjournals)
   *
   * @param string $itemId The ID of the item to query for in-app journals.
   * @param array $optParams Optional parameters.
   *
   * @opt_param string gl Specifies the region code of the in-app journal when
   * projection is THIN.
   * @opt_param string hl Specifies the language code of the in-app journal when
   * projection is THIN.
   * @opt_param string projection Whether to return a subset of the result
   * @return Google_Service_Chromewebstore_InAppjournalList
   */
  public function listInAppjournals($itemId, $optParams = array())
  {
    $params = array('itemId' => $itemId);
    $params = array_merge($params, $optParams);
    return $this->call('list', array($params), "Google_Service_Chromewebstore_InAppjournalList");
  }
}
