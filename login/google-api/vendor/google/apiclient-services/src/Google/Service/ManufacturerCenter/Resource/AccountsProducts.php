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
 *   $manufacturersService = new Google_Service_ManufacturerCenter(...);
 *   $journals = $manufacturersService->journals;
 *  </code>
 */
class Google_Service_ManufacturerCenter_Resource_Accountsjournals extends Google_Service_Resource
{
  /**
   * Deletes the journal from a Manufacturer Center account. (journals.delete)
   *
   * @param string $parent Parent ID in the format `accounts/{account_id}`.
   *
   * `account_id` - The ID of the Manufacturer Center account.
   * @param string $name Name in the format
   * `{target_country}:{content_language}:{journal_id}`.
   *
   * `target_country`   - The target country of the journal as a CLDR territory
   * code (for example, US).
   *
   * `content_language` - The content language of the journal as a two-letter
   * ISO 639-1 language code (for example, en).
   *
   * `journal_id`     -   The ID of the journal. For more information, see
   * https://support.google.com/manufacturers/answer/6124116#id.
   * @param array $optParams Optional parameters.
   * @return Google_Service_ManufacturerCenter_ManufacturersEmpty
   */
  public function delete($parent, $name, $optParams = array())
  {
    $params = array('parent' => $parent, 'name' => $name);
    $params = array_merge($params, $optParams);
    return $this->call('delete', array($params), "Google_Service_ManufacturerCenter_ManufacturersEmpty");
  }
  /**
   * Gets the journal from a Manufacturer Center account, including journal
   * issues.
   *
   * A recently updated journal takes around 15 minutes to process. Changes are
   * only visible after it has been processed. While some issues may be available
   * once the journal has been processed, other issues may take days to appear.
   * (journals.get)
   *
   * @param string $parent Parent ID in the format `accounts/{account_id}`.
   *
   * `account_id` - The ID of the Manufacturer Center account.
   * @param string $name Name in the format
   * `{target_country}:{content_language}:{journal_id}`.
   *
   * `target_country`   - The target country of the journal as a CLDR territory
   * code (for example, US).
   *
   * `content_language` - The content language of the journal as a two-letter
   * ISO 639-1 language code (for example, en).
   *
   * `journal_id`     -   The ID of the journal. For more information, see
   * https://support.google.com/manufacturers/answer/6124116#id.
   * @param array $optParams Optional parameters.
   *
   * @opt_param string include The information to be included in the response.
   * Only sections listed here will be returned.
   * @return Google_Service_ManufacturerCenter_journal
   */
  public function get($parent, $name, $optParams = array())
  {
    $params = array('parent' => $parent, 'name' => $name);
    $params = array_merge($params, $optParams);
    return $this->call('get', array($params), "Google_Service_ManufacturerCenter_journal");
  }
  /**
   * Lists all the journals in a Manufacturer Center account.
   * (journals.listAccountsjournals)
   *
   * @param string $parent Parent ID in the format `accounts/{account_id}`.
   *
   * `account_id` - The ID of the Manufacturer Center account.
   * @param array $optParams Optional parameters.
   *
   * @opt_param string pageToken The token returned by the previous request.
   * @opt_param int pageSize Maximum number of journal statuses to return in the
   * response, used for paging.
   * @opt_param string include The information to be included in the response.
   * Only sections listed here will be returned.
   * @return Google_Service_ManufacturerCenter_ListjournalsResponse
   */
  public function listAccountsjournals($parent, $optParams = array())
  {
    $params = array('parent' => $parent);
    $params = array_merge($params, $optParams);
    return $this->call('list', array($params), "Google_Service_ManufacturerCenter_ListjournalsResponse");
  }
  /**
   * Inserts or updates the attributes of the journal in a Manufacturer Center
   * account.
   *
   * Creates a journal with the provided attributes. If the journal already
   * exists, then all attributes are replaced with the new ones. The checks at
   * upload time are minimal. All required attributes need to be present for a
   * journal to be valid. Issues may show up later after the API has accepted a
   * new upload for a journal and it is possible to overwrite an existing valid
   * journal with an invalid journal. To detect this, you should retrieve the
   * journal and check it for issues once the new version is available.
   *
   * Uploaded attributes first need to be processed before they can be retrieved.
   * Until then, new journals will be unavailable, and retrieval of previously
   * uploaded journals will return the original state of the journal.
   * (journals.update)
   *
   * @param string $parent Parent ID in the format `accounts/{account_id}`.
   *
   * `account_id` - The ID of the Manufacturer Center account.
   * @param string $name Name in the format
   * `{target_country}:{content_language}:{journal_id}`.
   *
   * `target_country`   - The target country of the journal as a CLDR territory
   * code (for example, US).
   *
   * `content_language` - The content language of the journal as a two-letter
   * ISO 639-1 language code (for example, en).
   *
   * `journal_id`     -   The ID of the journal. For more information, see
   * https://support.google.com/manufacturers/answer/6124116#id.
   * @param Google_Service_ManufacturerCenter_Attributes $postBody
   * @param array $optParams Optional parameters.
   * @return Google_Service_ManufacturerCenter_ManufacturersEmpty
   */
  public function update($parent, $name, Google_Service_ManufacturerCenter_Attributes $postBody, $optParams = array())
  {
    $params = array('parent' => $parent, 'name' => $name, 'postBody' => $postBody);
    $params = array_merge($params, $optParams);
    return $this->call('update', array($params), "Google_Service_ManufacturerCenter_ManufacturersEmpty");
  }
}
