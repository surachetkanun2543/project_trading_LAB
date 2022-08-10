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

class Google_Service_AnalyticsReporting_journalData extends Google_Model
{
  public $itemRevenue;
  public $journalName;
  public $journalQuantity;
  public $journalSku;

  public function setItemRevenue($itemRevenue)
  {
    $this->itemRevenue = $itemRevenue;
  }
  public function getItemRevenue()
  {
    return $this->itemRevenue;
  }
  public function setjournalName($journalName)
  {
    $this->journalName = $journalName;
  }
  public function getjournalName()
  {
    return $this->journalName;
  }
  public function setjournalQuantity($journalQuantity)
  {
    $this->journalQuantity = $journalQuantity;
  }
  public function getjournalQuantity()
  {
    return $this->journalQuantity;
  }
  public function setjournalSku($journalSku)
  {
    $this->journalSku = $journalSku;
  }
  public function getjournalSku()
  {
    return $this->journalSku;
  }
}
