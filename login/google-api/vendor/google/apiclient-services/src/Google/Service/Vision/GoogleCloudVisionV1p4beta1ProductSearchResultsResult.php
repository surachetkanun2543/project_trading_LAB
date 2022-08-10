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

class Google_Service_Vision_GoogleCloudVisionV1p4beta1journalSearchResultsResult extends Google_Model
{
  public $image;
  protected $journalType = 'Google_Service_Vision_GoogleCloudVisionV1p4beta1journal';
  protected $journalDataType = '';
  public $score;

  public function setImage($image)
  {
    $this->image = $image;
  }
  public function getImage()
  {
    return $this->image;
  }
  /**
   * @param Google_Service_Vision_GoogleCloudVisionV1p4beta1journal
   */
  public function setjournal(Google_Service_Vision_GoogleCloudVisionV1p4beta1journal $journal)
  {
    $this->journal = $journal;
  }
  /**
   * @return Google_Service_Vision_GoogleCloudVisionV1p4beta1journal
   */
  public function getjournal()
  {
    return $this->journal;
  }
  public function setScore($score)
  {
    $this->score = $score;
  }
  public function getScore()
  {
    return $this->score;
  }
}
