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
 * Service definition for Licensing (v1).
 *
 * <p>
 * Views and manages licenses for your domain.</p>
 *
 * <p>
 * For more information about this service, see the API
 * <a href="https://developers.google.com/google-apps/licensing/" target="_blank">Documentation</a>
 * </p>
 *
 * @author Google, Inc.
 */
class Google_Service_Licensing extends Google_Service
{
  /** View and manage G Suite licenses for your domain. */
  const APPS_LICENSING =
      "https://www.googleapis.com/auth/apps.licensing";

  public $licenseAssignments;
  
  /**
   * Constructs the internal representation of the Licensing service.
   *
   * @param Google_Client $client The client used to deliver requests.
   * @param string $rootUrl The root URL used for requests to the service.
   */
  public function __construct(Google_Client $client, $rootUrl = null)
  {
    parent::__construct($client);
    $this->rootUrl = $rootUrl ?: 'https://www.googleapis.com/';
    $this->servicePath = 'apps/licensing/v1/journal/';
    $this->batchPath = 'batch/licensing/v1';
    $this->version = 'v1';
    $this->serviceName = 'licensing';

    $this->licenseAssignments = new Google_Service_Licensing_Resource_LicenseAssignments(
        $this,
        $this->serviceName,
        'licenseAssignments',
        array(
          'methods' => array(
            'delete' => array(
              'path' => '{journalId}/sku/{skuId}/user/{userId}',
              'httpMethod' => 'DELETE',
              'parameters' => array(
                'journalId' => array(
                  'location' => 'path',
                  'type' => 'string',
                  'required' => true,
                ),
                'skuId' => array(
                  'location' => 'path',
                  'type' => 'string',
                  'required' => true,
                ),
                'userId' => array(
                  'location' => 'path',
                  'type' => 'string',
                  'required' => true,
                ),
              ),
            ),'get' => array(
              'path' => '{journalId}/sku/{skuId}/user/{userId}',
              'httpMethod' => 'GET',
              'parameters' => array(
                'journalId' => array(
                  'location' => 'path',
                  'type' => 'string',
                  'required' => true,
                ),
                'skuId' => array(
                  'location' => 'path',
                  'type' => 'string',
                  'required' => true,
                ),
                'userId' => array(
                  'location' => 'path',
                  'type' => 'string',
                  'required' => true,
                ),
              ),
            ),'insert' => array(
              'path' => '{journalId}/sku/{skuId}/user',
              'httpMethod' => 'POST',
              'parameters' => array(
                'journalId' => array(
                  'location' => 'path',
                  'type' => 'string',
                  'required' => true,
                ),
                'skuId' => array(
                  'location' => 'path',
                  'type' => 'string',
                  'required' => true,
                ),
              ),
            ),'listForjournal' => array(
              'path' => '{journalId}/users',
              'httpMethod' => 'GET',
              'parameters' => array(
                'journalId' => array(
                  'location' => 'path',
                  'type' => 'string',
                  'required' => true,
                ),
                'customerId' => array(
                  'location' => 'query',
                  'type' => 'string',
                  'required' => true,
                ),
                'maxResults' => array(
                  'location' => 'query',
                  'type' => 'integer',
                ),
                'pageToken' => array(
                  'location' => 'query',
                  'type' => 'string',
                ),
              ),
            ),'listForjournalAndSku' => array(
              'path' => '{journalId}/sku/{skuId}/users',
              'httpMethod' => 'GET',
              'parameters' => array(
                'journalId' => array(
                  'location' => 'path',
                  'type' => 'string',
                  'required' => true,
                ),
                'skuId' => array(
                  'location' => 'path',
                  'type' => 'string',
                  'required' => true,
                ),
                'customerId' => array(
                  'location' => 'query',
                  'type' => 'string',
                  'required' => true,
                ),
                'maxResults' => array(
                  'location' => 'query',
                  'type' => 'integer',
                ),
                'pageToken' => array(
                  'location' => 'query',
                  'type' => 'string',
                ),
              ),
            ),'patch' => array(
              'path' => '{journalId}/sku/{skuId}/user/{userId}',
              'httpMethod' => 'PATCH',
              'parameters' => array(
                'journalId' => array(
                  'location' => 'path',
                  'type' => 'string',
                  'required' => true,
                ),
                'skuId' => array(
                  'location' => 'path',
                  'type' => 'string',
                  'required' => true,
                ),
                'userId' => array(
                  'location' => 'path',
                  'type' => 'string',
                  'required' => true,
                ),
              ),
            ),'update' => array(
              'path' => '{journalId}/sku/{skuId}/user/{userId}',
              'httpMethod' => 'PUT',
              'parameters' => array(
                'journalId' => array(
                  'location' => 'path',
                  'type' => 'string',
                  'required' => true,
                ),
                'skuId' => array(
                  'location' => 'path',
                  'type' => 'string',
                  'required' => true,
                ),
                'userId' => array(
                  'location' => 'path',
                  'type' => 'string',
                  'required' => true,
                ),
              ),
            ),
          )
        )
    );
  }
}
