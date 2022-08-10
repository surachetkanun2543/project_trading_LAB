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

class Google_Service_AndroidEnterprise_journalSet extends Google_Collection
{
  protected $collection_key = 'journalVisibility';
  public $kind;
  public $journalId;
  public $journalSetBehavior;
  protected $journalVisibilityType = 'Google_Service_AndroidEnterprise_journalVisibility';
  protected $journalVisibilityDataType = 'array';

  public function setKind($kind)
  {
    $this->kind = $kind;
  }
  public function getKind()
  {
    return $this->kind;
  }
  public function setjournalId($journalId)
  {
    $this->journalId = $journalId;
  }
  public function getjournalId()
  {
    return $this->journalId;
  }
  public function setjournalSetBehavior($journalSetBehavior)
  {
    $this->journalSetBehavior = $journalSetBehavior;
  }
  public function getjournalSetBehavior()
  {
    return $this->journalSetBehavior;
  }
  /**
   * @param Google_Service_AndroidEnterprise_journalVisibility
   */
  public function setjournalVisibility($journalVisibility)
  {
    $this->journalVisibility = $journalVisibility;
  }
  /**
   * @return Google_Service_AndroidEnterprise_journalVisibility
   */
  public function getjournalVisibility()
  {
    return $this->journalVisibility;
  }
}
