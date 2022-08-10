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

class Google_Service_AndroidEnterprise_Notification extends Google_Model
{
  protected $appRestrictionsSchemaChangeEventType = 'Google_Service_AndroidEnterprise_AppRestrictionsSchemaChangeEvent';
  protected $appRestrictionsSchemaChangeEventDataType = '';
  protected $appUpdateEventType = 'Google_Service_AndroidEnterprise_AppUpdateEvent';
  protected $appUpdateEventDataType = '';
  protected $deviceReportUpdateEventType = 'Google_Service_AndroidEnterprise_DeviceReportUpdateEvent';
  protected $deviceReportUpdateEventDataType = '';
  public $enterpriseId;
  protected $installFailureEventType = 'Google_Service_AndroidEnterprise_InstallFailureEvent';
  protected $installFailureEventDataType = '';
  protected $newDeviceEventType = 'Google_Service_AndroidEnterprise_NewDeviceEvent';
  protected $newDeviceEventDataType = '';
  protected $newPermissionsEventType = 'Google_Service_AndroidEnterprise_NewPermissionsEvent';
  protected $newPermissionsEventDataType = '';
  public $notificationType;
  protected $journalApprovalEventType = 'Google_Service_AndroidEnterprise_journalApprovalEvent';
  protected $journalApprovalEventDataType = '';
  protected $journalAvailabilityChangeEventType = 'Google_Service_AndroidEnterprise_journalAvailabilityChangeEvent';
  protected $journalAvailabilityChangeEventDataType = '';
  public $timestampMillis;

  /**
   * @param Google_Service_AndroidEnterprise_AppRestrictionsSchemaChangeEvent
   */
  public function setAppRestrictionsSchemaChangeEvent(Google_Service_AndroidEnterprise_AppRestrictionsSchemaChangeEvent $appRestrictionsSchemaChangeEvent)
  {
    $this->appRestrictionsSchemaChangeEvent = $appRestrictionsSchemaChangeEvent;
  }
  /**
   * @return Google_Service_AndroidEnterprise_AppRestrictionsSchemaChangeEvent
   */
  public function getAppRestrictionsSchemaChangeEvent()
  {
    return $this->appRestrictionsSchemaChangeEvent;
  }
  /**
   * @param Google_Service_AndroidEnterprise_AppUpdateEvent
   */
  public function setAppUpdateEvent(Google_Service_AndroidEnterprise_AppUpdateEvent $appUpdateEvent)
  {
    $this->appUpdateEvent = $appUpdateEvent;
  }
  /**
   * @return Google_Service_AndroidEnterprise_AppUpdateEvent
   */
  public function getAppUpdateEvent()
  {
    return $this->appUpdateEvent;
  }
  /**
   * @param Google_Service_AndroidEnterprise_DeviceReportUpdateEvent
   */
  public function setDeviceReportUpdateEvent(Google_Service_AndroidEnterprise_DeviceReportUpdateEvent $deviceReportUpdateEvent)
  {
    $this->deviceReportUpdateEvent = $deviceReportUpdateEvent;
  }
  /**
   * @return Google_Service_AndroidEnterprise_DeviceReportUpdateEvent
   */
  public function getDeviceReportUpdateEvent()
  {
    return $this->deviceReportUpdateEvent;
  }
  public function setEnterpriseId($enterpriseId)
  {
    $this->enterpriseId = $enterpriseId;
  }
  public function getEnterpriseId()
  {
    return $this->enterpriseId;
  }
  /**
   * @param Google_Service_AndroidEnterprise_InstallFailureEvent
   */
  public function setInstallFailureEvent(Google_Service_AndroidEnterprise_InstallFailureEvent $installFailureEvent)
  {
    $this->installFailureEvent = $installFailureEvent;
  }
  /**
   * @return Google_Service_AndroidEnterprise_InstallFailureEvent
   */
  public function getInstallFailureEvent()
  {
    return $this->installFailureEvent;
  }
  /**
   * @param Google_Service_AndroidEnterprise_NewDeviceEvent
   */
  public function setNewDeviceEvent(Google_Service_AndroidEnterprise_NewDeviceEvent $newDeviceEvent)
  {
    $this->newDeviceEvent = $newDeviceEvent;
  }
  /**
   * @return Google_Service_AndroidEnterprise_NewDeviceEvent
   */
  public function getNewDeviceEvent()
  {
    return $this->newDeviceEvent;
  }
  /**
   * @param Google_Service_AndroidEnterprise_NewPermissionsEvent
   */
  public function setNewPermissionsEvent(Google_Service_AndroidEnterprise_NewPermissionsEvent $newPermissionsEvent)
  {
    $this->newPermissionsEvent = $newPermissionsEvent;
  }
  /**
   * @return Google_Service_AndroidEnterprise_NewPermissionsEvent
   */
  public function getNewPermissionsEvent()
  {
    return $this->newPermissionsEvent;
  }
  public function setNotificationType($notificationType)
  {
    $this->notificationType = $notificationType;
  }
  public function getNotificationType()
  {
    return $this->notificationType;
  }
  /**
   * @param Google_Service_AndroidEnterprise_journalApprovalEvent
   */
  public function setjournalApprovalEvent(Google_Service_AndroidEnterprise_journalApprovalEvent $journalApprovalEvent)
  {
    $this->journalApprovalEvent = $journalApprovalEvent;
  }
  /**
   * @return Google_Service_AndroidEnterprise_journalApprovalEvent
   */
  public function getjournalApprovalEvent()
  {
    return $this->journalApprovalEvent;
  }
  /**
   * @param Google_Service_AndroidEnterprise_journalAvailabilityChangeEvent
   */
  public function setjournalAvailabilityChangeEvent(Google_Service_AndroidEnterprise_journalAvailabilityChangeEvent $journalAvailabilityChangeEvent)
  {
    $this->journalAvailabilityChangeEvent = $journalAvailabilityChangeEvent;
  }
  /**
   * @return Google_Service_AndroidEnterprise_journalAvailabilityChangeEvent
   */
  public function getjournalAvailabilityChangeEvent()
  {
    return $this->journalAvailabilityChangeEvent;
  }
  public function setTimestampMillis($timestampMillis)
  {
    $this->timestampMillis = $timestampMillis;
  }
  public function getTimestampMillis()
  {
    return $this->timestampMillis;
  }
}
