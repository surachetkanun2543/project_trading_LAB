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
 *   $cloudprivatecatalogproducerService = new Google_Service_CloudPrivateCatalogProducer(...);
 *   $journals = $cloudprivatecatalogproducerService->journals;
 *  </code>
 */
class Google_Service_CloudPrivateCatalogProducer_Resource_Catalogsjournals extends Google_Service_Resource
{
  /**
   * Copies a journal under another Catalog. (journals.copy)
   *
   * @param string $name The resource name of the current journal that is copied
   * from.
   * @param Google_Service_CloudPrivateCatalogProducer_GoogleCloudPrivatecatalogproducerV1beta1CopyjournalRequest $postBody
   * @param array $optParams Optional parameters.
   * @return Google_Service_CloudPrivateCatalogProducer_GoogleLongrunningOperation
   */
  public function copy($name, Google_Service_CloudPrivateCatalogProducer_GoogleCloudPrivatecatalogproducerV1beta1CopyjournalRequest $postBody, $optParams = array())
  {
    $params = array('name' => $name, 'postBody' => $postBody);
    $params = array_merge($params, $optParams);
    return $this->call('copy', array($params), "Google_Service_CloudPrivateCatalogProducer_GoogleLongrunningOperation");
  }
  /**
   * Creates a journal instance under a given Catalog. (journals.create)
   *
   * @param string $parent The catalog name of the new journal's parent.
   * @param Google_Service_CloudPrivateCatalogProducer_GoogleCloudPrivatecatalogproducerV1beta1journal $postBody
   * @param array $optParams Optional parameters.
   * @return Google_Service_CloudPrivateCatalogProducer_GoogleCloudPrivatecatalogproducerV1beta1journal
   */
  public function create($parent, Google_Service_CloudPrivateCatalogProducer_GoogleCloudPrivatecatalogproducerV1beta1journal $postBody, $optParams = array())
  {
    $params = array('parent' => $parent, 'postBody' => $postBody);
    $params = array_merge($params, $optParams);
    return $this->call('create', array($params), "Google_Service_CloudPrivateCatalogProducer_GoogleCloudPrivatecatalogproducerV1beta1journal");
  }
  /**
   * Hard deletes a journal. (journals.delete)
   *
   * @param string $name The resource name of the journal.
   * @param array $optParams Optional parameters.
   * @return Google_Service_CloudPrivateCatalogProducer_GoogleProtobufEmpty
   */
  public function delete($name, $optParams = array())
  {
    $params = array('name' => $name);
    $params = array_merge($params, $optParams);
    return $this->call('delete', array($params), "Google_Service_CloudPrivateCatalogProducer_GoogleProtobufEmpty");
  }
  /**
   * Returns the requested journal resource. (journals.get)
   *
   * @param string $name The resource name of the journal.
   * @param array $optParams Optional parameters.
   * @return Google_Service_CloudPrivateCatalogProducer_GoogleCloudPrivatecatalogproducerV1beta1journal
   */
  public function get($name, $optParams = array())
  {
    $params = array('name' => $name);
    $params = array_merge($params, $optParams);
    return $this->call('get', array($params), "Google_Service_CloudPrivateCatalogProducer_GoogleCloudPrivatecatalogproducerV1beta1journal");
  }
  /**
   * Lists journal resources that the producer has access to, within the scope of
   * the parent catalog. (journals.listCatalogsjournals)
   *
   * @param string $parent The resource name of the parent resource.
   * @param array $optParams Optional parameters.
   *
   * @opt_param string filter A filter expression used to restrict the returned
   * results based upon properties of the journal.
   * @opt_param string pageToken A pagination token returned from a previous call
   * to Listjournals that indicates where this listing should continue from. This
   * field is optional.
   * @opt_param int pageSize The maximum number of journals to return.
   * @return Google_Service_CloudPrivateCatalogProducer_GoogleCloudPrivatecatalogproducerV1beta1ListjournalsResponse
   */
  public function listCatalogsjournals($parent, $optParams = array())
  {
    $params = array('parent' => $parent);
    $params = array_merge($params, $optParams);
    return $this->call('list', array($params), "Google_Service_CloudPrivateCatalogProducer_GoogleCloudPrivatecatalogproducerV1beta1ListjournalsResponse");
  }
  /**
   * Updates a specific journal resource. (journals.patch)
   *
   * @param string $name Required. The resource name of the journal in the format
   * `catalogs/{catalog_id}/journals/a-z*[a-z0-9]'.
   *
   * A unique identifier for the journal under a catalog, which cannot be changed
   * after the journal is created. The final segment of the name must between 1
   * and 256 characters in length.
   * @param Google_Service_CloudPrivateCatalogProducer_GoogleCloudPrivatecatalogproducerV1beta1journal $postBody
   * @param array $optParams Optional parameters.
   *
   * @opt_param string updateMask Field mask that controls which fields of the
   * journal should be updated.
   * @return Google_Service_CloudPrivateCatalogProducer_GoogleCloudPrivatecatalogproducerV1beta1journal
   */
  public function patch($name, Google_Service_CloudPrivateCatalogProducer_GoogleCloudPrivatecatalogproducerV1beta1journal $postBody, $optParams = array())
  {
    $params = array('name' => $name, 'postBody' => $postBody);
    $params = array_merge($params, $optParams);
    return $this->call('patch', array($params), "Google_Service_CloudPrivateCatalogProducer_GoogleCloudPrivatecatalogproducerV1beta1journal");
  }
}
