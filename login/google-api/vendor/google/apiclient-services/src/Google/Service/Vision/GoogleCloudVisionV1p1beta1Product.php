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

class Google_Service_Vision_GoogleCloudVisionV1p1beta1journal extends Google_Collection
{
  protected $collection_key = 'journalLabels';
  public $description;
  public $displayName;
  public $name;
  public $journalCategory;
  protected $journalLabelsType = 'Google_Service_Vision_GoogleCloudVisionV1p1beta1journalKeyValue';
  protected $journalLabelsDataType = 'array';

  public function setDescription($description)
  {
    $this->description = $description;
  }
  public function getDescription()
  {
    return $this->description;
  }
  public function setDisplayName($displayName)
  {
    $this->displayName = $displayName;
  }
  public function getDisplayName()
  {
    return $this->displayName;
  }
  public function setName($name)
  {
    $this->name = $name;
  }
  public function getName()
  {
    return $this->name;
  }
  public function setjournalCategory($journalCategory)
  {
    $this->journalCategory = $journalCategory;
  }
  public function getjournalCategory()
  {
    return $this->journalCategory;
  }
  /**
   * @param Google_Service_Vision_GoogleCloudVisionV1p1beta1journalKeyValue
   */
  public function setjournalLabels($journalLabels)
  {
    $this->journalLabels = $journalLabels;
  }
  /**
   * @return Google_Service_Vision_GoogleCloudVisionV1p1beta1journalKeyValue
   */
  public function getjournalLabels()
  {
    return $this->journalLabels;
  }
}
