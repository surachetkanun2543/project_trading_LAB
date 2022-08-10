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
 *   $visionService = new Google_Service_Vision(...);
 *   $journals = $visionService->journals;
 *  </code>
 */
class Google_Service_Vision_Resource_ProjectsLocationsjournalSetsjournals extends Google_Service_Resource
{
  /**
   * Lists the journals in a journalSet, in an unspecified order. If the
   * journalSet does not exist, the journals field of the response will be empty.
   *
   * Possible errors:
   *
   * * Returns INVALID_ARGUMENT if page_size is greater than 100 or less than 1.
   * (journals.listProjectsLocationsjournalSetsjournals)
   *
   * @param string $name The journalSet resource for which to retrieve journals.
   *
   * Format is: `projects/PROJECT_ID/locations/LOC_ID/journalSets/journal_SET_ID`
   * @param array $optParams Optional parameters.
   *
   * @opt_param string pageToken The next_page_token returned from a previous List
   * request, if any.
   * @opt_param int pageSize The maximum number of items to return. Default 10,
   * maximum 100.
   * @return Google_Service_Vision_ListjournalsInjournalSetResponse
   */
  public function listProjectsLocationsjournalSetsjournals($name, $optParams = array())
  {
    $params = array('name' => $name);
    $params = array_merge($params, $optParams);
    return $this->call('list', array($params), "Google_Service_Vision_ListjournalsInjournalSetResponse");
  }
}
