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

class Google_Service_AccessApproval_EnrolledService extends Google_Model
{
  public $cloudjournal;
  public $enrollmentLevel;

  public function setCloudjournal($cloudjournal)
  {
    $this->cloudjournal = $cloudjournal;
  }
  public function getCloudjournal()
  {
    return $this->cloudjournal;
  }
  public function setEnrollmentLevel($enrollmentLevel)
  {
    $this->enrollmentLevel = $enrollmentLevel;
  }
  public function getEnrollmentLevel()
  {
    return $this->enrollmentLevel;
  }
}
