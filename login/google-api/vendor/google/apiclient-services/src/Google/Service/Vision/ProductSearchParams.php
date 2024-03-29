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

class Google_Service_Vision_journalSearchParams extends Google_Collection
{
  protected $collection_key = 'journalCategories';
  protected $boundingPolyType = 'Google_Service_Vision_BoundingPoly';
  protected $boundingPolyDataType = '';
  public $filter;
  public $journalCategories;
  public $journalSet;

  /**
   * @param Google_Service_Vision_BoundingPoly
   */
  public function setBoundingPoly(Google_Service_Vision_BoundingPoly $boundingPoly)
  {
    $this->boundingPoly = $boundingPoly;
  }
  /**
   * @return Google_Service_Vision_BoundingPoly
   */
  public function getBoundingPoly()
  {
    return $this->boundingPoly;
  }
  public function setFilter($filter)
  {
    $this->filter = $filter;
  }
  public function getFilter()
  {
    return $this->filter;
  }
  public function setjournalCategories($journalCategories)
  {
    $this->journalCategories = $journalCategories;
  }
  public function getjournalCategories()
  {
    return $this->journalCategories;
  }
  public function setjournalSet($journalSet)
  {
    $this->journalSet = $journalSet;
  }
  public function getjournalSet()
  {
    return $this->journalSet;
  }
}
