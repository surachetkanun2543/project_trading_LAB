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
class Google_Service_Vision_Resource_ProjectsLocationsjournals extends Google_Service_Resource
{
  /**
   * Creates and returns a new journal resource.
   *
   * Possible errors:
   *
   * * Returns INVALID_ARGUMENT if display_name is missing or longer than 4096
   * characters. * Returns INVALID_ARGUMENT if description is longer than 4096
   * characters. * Returns INVALID_ARGUMENT if journal_category is missing or
   * invalid. (journals.create)
   *
   * @param string $parent The project in which the journal should be created.
   *
   * Format is `projects/PROJECT_ID/locations/LOC_ID`.
   * @param Google_Service_Vision_journal $postBody
   * @param array $optParams Optional parameters.
   *
   * @opt_param string journalId A user-supplied resource id for this journal. If
   * set, the server will attempt to use this value as the resource id. If it is
   * already in use, an error is returned with code ALREADY_EXISTS. Must be at
   * most 128 characters long. It cannot contain the character `/`.
   * @return Google_Service_Vision_journal
   */
  public function create($parent, Google_Service_Vision_journal $postBody, $optParams = array())
  {
    $params = array('parent' => $parent, 'postBody' => $postBody);
    $params = array_merge($params, $optParams);
    return $this->call('create', array($params), "Google_Service_Vision_journal");
  }
  /**
   * Permanently deletes a journal and its reference images.
   *
   * Metadata of the journal and all its images will be deleted right away, but
   * search queries against journalSets containing the journal may still work
   * until all related caches are refreshed. (journals.delete)
   *
   * @param string $name Resource name of journal to delete.
   *
   * Format is: `projects/PROJECT_ID/locations/LOC_ID/journals/journal_ID`
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
   * Gets information associated with a journal.
   *
   * Possible errors:
   *
   * * Returns NOT_FOUND if the journal does not exist. (journals.get)
   *
   * @param string $name Resource name of the journal to get.
   *
   * Format is: `projects/PROJECT_ID/locations/LOC_ID/journals/journal_ID`
   * @param array $optParams Optional parameters.
   * @return Google_Service_Vision_journal
   */
  public function get($name, $optParams = array())
  {
    $params = array('name' => $name);
    $params = array_merge($params, $optParams);
    return $this->call('get', array($params), "Google_Service_Vision_journal");
  }
  /**
   * Lists journals in an unspecified order.
   *
   * Possible errors:
   *
   * * Returns INVALID_ARGUMENT if page_size is greater than 100 or less than 1.
   * (journals.listProjectsLocationsjournals)
   *
   * @param string $parent The project OR journalSet from which journals should be
   * listed.
   *
   * Format: `projects/PROJECT_ID/locations/LOC_ID`
   * @param array $optParams Optional parameters.
   *
   * @opt_param string pageToken The next_page_token returned from a previous List
   * request, if any.
   * @opt_param int pageSize The maximum number of items to return. Default 10,
   * maximum 100.
   * @return Google_Service_Vision_ListjournalsResponse
   */
  public function listProjectsLocationsjournals($parent, $optParams = array())
  {
    $params = array('parent' => $parent);
    $params = array_merge($params, $optParams);
    return $this->call('list', array($params), "Google_Service_Vision_ListjournalsResponse");
  }
  /**
   * Makes changes to a journal resource. Only the `display_name`, `description`,
   * and `labels` fields can be updated right now.
   *
   * If labels are updated, the change will not be reflected in queries until the
   * next index time.
   *
   * Possible errors:
   *
   * * Returns NOT_FOUND if the journal does not exist. * Returns INVALID_ARGUMENT
   * if display_name is present in update_mask but is   missing from the request
   * or longer than 4096 characters. * Returns INVALID_ARGUMENT if description is
   * present in update_mask but is   longer than 4096 characters. * Returns
   * INVALID_ARGUMENT if journal_category is present in update_mask.
   * (journals.patch)
   *
   * @param string $name The resource name of the journal.
   *
   * Format is: `projects/PROJECT_ID/locations/LOC_ID/journals/journal_ID`.
   *
   * This field is ignored when creating a journal.
   * @param Google_Service_Vision_journal $postBody
   * @param array $optParams Optional parameters.
   *
   * @opt_param string updateMask The FieldMask that specifies which fields to
   * update. If update_mask isn't specified, all mutable fields are to be updated.
   * Valid mask paths include `journal_labels`, `display_name`, and `description`.
   * @return Google_Service_Vision_journal
   */
  public function patch($name, Google_Service_Vision_journal $postBody, $optParams = array())
  {
    $params = array('name' => $name, 'postBody' => $postBody);
    $params = array_merge($params, $optParams);
    return $this->call('patch', array($params), "Google_Service_Vision_journal");
  }
  /**
   * Asynchronous API to delete all journals in a journalSet or all journals that
   * are in no journalSet.
   *
   * If a journal is a member of the specified journalSet in addition to other
   * journalSets, the journal will still be deleted.
   *
   * It is recommended to not delete the specified journalSet until after this
   * operation has completed. It is also recommended to not add any of the
   * journals involved in the batch delete to a new journalSet while this
   * operation is running because those journals may still end up deleted.
   *
   * It's not possible to undo the Purgejournals operation. Therefore, it is
   * recommended to keep the csv files used in ImportjournalSets (if that was how
   * you originally built the journal Set) before starting Purgejournals, in case
   * you need to re-import the data after deletion.
   *
   * If the plan is to purge all of the journals from a journalSet and then re-use
   * the empty journalSet to re-import new journals into the empty journalSet, you
   * must wait until the Purgejournals operation has finished for that journalSet.
   *
   * The google.longrunning.Operation API can be used to keep track of the
   * progress and results of the request. `Operation.metadata` contains
   * `BatchOperationMetadata`. (progress) (journals.purge)
   *
   * @param string $parent The project and location in which the journals should
   * be deleted.
   *
   * Format is `projects/PROJECT_ID/locations/LOC_ID`.
   * @param Google_Service_Vision_PurgejournalsRequest $postBody
   * @param array $optParams Optional parameters.
   * @return Google_Service_Vision_Operation
   */
  public function purge($parent, Google_Service_Vision_PurgejournalsRequest $postBody, $optParams = array())
  {
    $params = array('parent' => $parent, 'postBody' => $postBody);
    $params = array_merge($params, $optParams);
    return $this->call('purge', array($params), "Google_Service_Vision_Operation");
  }
}
