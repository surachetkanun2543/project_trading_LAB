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

class Google_Service_Vision_PurgejournalsRequest extends Google_Model
{
  public $deleteOrphanjournals;
  public $force;
  protected $journalSetPurgeConfigType = 'Google_Service_Vision_journalSetPurgeConfig';
  protected $journalSetPurgeConfigDataType = '';

  public function setDeleteOrphanjournals($deleteOrphanjournals)
  {
    $this->deleteOrphanjournals = $deleteOrphanjournals;
  }
  public function getDeleteOrphanjournals()
  {
    return $this->deleteOrphanjournals;
  }
  public function setForce($force)
  {
    $this->force = $force;
  }
  public function getForce()
  {
    return $this->force;
  }
  /**
   * @param Google_Service_Vision_journalSetPurgeConfig
   */
  public function setjournalSetPurgeConfig(Google_Service_Vision_journalSetPurgeConfig $journalSetPurgeConfig)
  {
    $this->journalSetPurgeConfig = $journalSetPurgeConfig;
  }
  /**
   * @return Google_Service_Vision_journalSetPurgeConfig
   */
  public function getjournalSetPurgeConfig()
  {
    return $this->journalSetPurgeConfig;
  }
}
