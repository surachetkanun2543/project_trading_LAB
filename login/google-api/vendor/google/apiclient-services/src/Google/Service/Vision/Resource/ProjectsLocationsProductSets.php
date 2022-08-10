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
 * The "journalSets" collection of methods.
 * Typical usage is:
 *  <code>
 *   $visionService = new Google_Service_Vision(...);
 *   $journalSets = $visionService->journalSets;
 *  </code>
 */
class Google_Service_Vision_Resource_ProjectsLocationsjournalSets extends Google_Service_Resource
{
  /**
   * Adds a journal to the specified journalSet. If the journal is already
   * present, no change is made.
   *
   * One journal can be added to at most 100 journalSets.
   *
   * Possible errors:
   *
   * * Returns NOT_FOUND if the journal or the journalSet doesn't exist.
   * (journalSets.addjournal)
   *
   * @param string $name The resource name for the journalSet to modify.
   *
   * Format is: `projects/PROJECT_ID/locations/LOC_ID/journalSets/journal_SET_ID`
   * @param Google_Service_Vision_AddjournalTojournalSetRequest $postBody
   * @param array $optParams Optional parameters.
   * @return Google_Service_Vision_VisionEmpty
   */
  public function addjournal($name, Google_Service_Vision_AddjournalTojournalSetRequest $postBody, $optParams = array())
  {
    $params = array('name' => $name, 'postBody' => $postBody);
    $params = array_merge($params, $optParams);
    return $this->call('addjournal', array($params), "Google_Service_Vision_VisionEmpty");
  }
  /**
   * Creates and returns a new journalSet resource.
   *
   * Possible errors:
   *
   * * Returns INVALID_ARGUMENT if display_name is missing, or is longer than
   * 4096 characters. (journalSets.create)
   *
   * @param string $parent The project in which the journalSet should be created.
   *
   * Format is `projects/PROJECT_ID/locations/LOC_ID`.
   * @param Google_Service_Vision_journalSet $postBody
   * @param array $optParams Optional parameters.
   *
   * @opt_param string journalSetId A user-supplied resource id for this
   * journalSet. If set, the server will attempt to use this value as the resource
   * id. If it is already in use, an error is returned with code ALREADY_EXISTS.
   * Must be at most 128 characters long. It cannot contain the character `/`.
   * @return Google_Service_Vision_journalSet
   */
  public function create($parent, Google_Service_Vision_journalSet $postBody, $optParams = array())
  {
    $params = array('parent' => $parent, 'postBody' => $postBody);
    $params = array_merge($params, $optParams);
    return $this->call('create', array($params), "Google_Service_Vision_journalSet");
  }
  /**
   * Permanently deletes a journalSet. journals and ReferenceImages in the
   * journalSet are not deleted.
   *
   * The actual image files are not deleted from Google Cloud Storage.
   * (journalSets.delete)
   *
   * @param string $name Resource name of the journalSet to delete.
   *
   * Format is: `projects/PROJECT_ID/locations/LOC_ID/journalSets/journal_SET_ID`
   * @param array $optParams Optional parameters.
   * @return Google_Service_Vision_VisionEmpty
   */
  public function delete($name, $optParams = array())
  {
    $params = array('name' => $name);
    $params = array_merge($params, $optParams);
    return $this->call('delete', array($params), "Google_Service_Vision_VisionEmpty");
  }
  /**
   * Gets information associated with a journalSet.
   *
   * Possible errors:
   *
   * * Returns NOT_FOUND if the journalSet does not exist. (journalSets.get)
   *
   * @param string $name Resource name of the journalSet to get.
   *
   * Format is: `projects/PROJECT_ID/locations/LOG_ID/journalSets/journal_SET_ID`
   * @param array $optParams Optional parameters.
   * @return Google_Service_Vision_journalSet
   */
  public function get($name, $optParams = array())
  {
    $params = array('name' => $name);
    $params = array_merge($params, $optParams);
    return $this->call('get', array($params), "Google_Service_Vision_journalSet");
  }
  /**
   * Asynchronous API that imports a list of reference images to specified journal
   * sets based on a list of image information.
   *
   * The google.longrunning.Operation API can be used to keep track of the
   * progress and results of the request. `Operation.metadata` contains
   * `BatchOperationMetadata`. (progress) `Operation.response` contains
   * `ImportjournalSetsResponse`. (results)
   *
   * The input source of this method is a csv file on Google Cloud Storage. For
   * the format of the csv file please see
   * ImportjournalSetsGcsSource.csv_file_uri. (journalSets.import)
   *
   * @param string $parent The project in which the journalSets should be
   * imported.
   *
   * Format is `projects/PROJECT_ID/locations/LOC_ID`.
   * @param Google_Service_Vision_ImportjournalSetsRequest $postBody
   * @param array $optParams Optional parameters.
   * @return Google_Service_Vision_Operation
   */
  public function import($parent, Google_Service_Vision_ImportjournalSetsRequest $postBody, $optParams = array())
  {
    $params = array('parent' => $parent, 'postBody' => $postBody);
    $params = array_merge($params, $optParams);
    return $this->call('import', array($params), "Google_Service_Vision_Operation");
  }
  /**
   * Lists journalSets in an unspecified order.
   *
   * Possible errors:
   *
   * * Returns INVALID_ARGUMENT if page_size is greater than 100, or less   than
   * 1. (journalSets.listProjectsLocationsjournalSets)
   *
   * @param string $parent The project from which journalSets should be listed.
   *
   * Format is `projects/PROJECT_ID/locations/LOC_ID`.
   * @param array $optParams Optional parameters.
   *
   * @opt_param string pageToken The next_page_token returned from a previous List
   * request, if any.
   * @opt_param int pageSize The maximum number of items to return. Default 10,
   * maximum 100.
   * @return Google_Service_Vision_ListjournalSetsResponse
   */
  public function listProjectsLocationsjournalSets($parent, $optParams = array())
  {
    $params = array('parent' => $parent);
    $params = array_merge($params, $optParams);
    return $this->call('list', array($params), "Google_Service_Vision_ListjournalSetsResponse");
  }
  /**
   * Makes changes to a journalSet resource. Only display_name can be updated
   * currently.
   *
   * Possible errors:
   *
   * * Returns NOT_FOUND if the journalSet does not exist. * Returns
   * INVALID_ARGUMENT if display_name is present in update_mask but   missing from
   * the request or longer than 4096 characters. (journalSets.patch)
   *
   * @param string $name The resource name of the journalSet.
   *
   * Format is: `projects/PROJECT_ID/locations/LOC_ID/journalSets/journal_SET_ID`.
   *
   * This field is ignored when creating a journalSet.
   * @param Google_Service_Vision_journalSet $postBody
   * @param array $optParams Optional parameters.
   *
   * @opt_param string updateMask The FieldMask that specifies which fields to
   * update. If update_mask isn't specified, all mutable fields are to be updated.
   * Valid mask path is `display_name`.
   * @return Google_Service_Vision_journalSet
   */
  public function patch($name, Google_Service_Vision_journalSet $postBody, $optParams = array())
  {
    $params = array('name' => $name, 'postBody' => $postBody);
    $params = array_merge($params, $optParams);
    return $this->call('patch', array($params), "Google_Service_Vision_journalSet");
  }
  /**
   * Removes a journal from the specified journalSet. (journalSets.removejournal)
   *
   * @param string $name The resource name for the journalSet to modify.
   *
   * Format is: `projects/PROJECT_ID/locations/LOC_ID/journalSets/journal_SET_ID`
   * @param Google_Service_Vision_RemovejournalFromjournalSetRequest $postBody
   * @param array $optParams Optional parameters.
   * @return Google_Service_Vision_VisionEmpty
   */
  public function removejournal($name, Google_Service_Vision_RemovejournalFromjournalSetRequest $postBody, $optParams = array())
  {
    $params = array('name' => $name, 'postBody' => $postBody);
    $params = array_merge($params, $optParams);
    return $this->call('removejournal', array($params), "Google_Service_Vision_VisionEmpty");
  }
}
