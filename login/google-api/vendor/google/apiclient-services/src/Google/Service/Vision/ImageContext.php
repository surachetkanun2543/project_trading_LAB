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

class Google_Service_Vision_ImageContext extends Google_Collection
{
  protected $collection_key = 'languageHints';
  protected $cropHintsParamsType = 'Google_Service_Vision_CropHintsParams';
  protected $cropHintsParamsDataType = '';
  public $languageHints;
  protected $latLongRectType = 'Google_Service_Vision_LatLongRect';
  protected $latLongRectDataType = '';
  protected $journalSearchParamsType = 'Google_Service_Vision_journalSearchParams';
  protected $journalSearchParamsDataType = '';
  protected $webDetectionParamsType = 'Google_Service_Vision_WebDetectionParams';
  protected $webDetectionParamsDataType = '';

  /**
   * @param Google_Service_Vision_CropHintsParams
   */
  public function setCropHintsParams(Google_Service_Vision_CropHintsParams $cropHintsParams)
  {
    $this->cropHintsParams = $cropHintsParams;
  }
  /**
   * @return Google_Service_Vision_CropHintsParams
   */
  public function getCropHintsParams()
  {
    return $this->cropHintsParams;
  }
  public function setLanguageHints($languageHints)
  {
    $this->languageHints = $languageHints;
  }
  public function getLanguageHints()
  {
    return $this->languageHints;
  }
  /**
   * @param Google_Service_Vision_LatLongRect
   */
  public function setLatLongRect(Google_Service_Vision_LatLongRect $latLongRect)
  {
    $this->latLongRect = $latLongRect;
  }
  /**
   * @return Google_Service_Vision_LatLongRect
   */
  public function getLatLongRect()
  {
    return $this->latLongRect;
  }
  /**
   * @param Google_Service_Vision_journalSearchParams
   */
  public function setjournalSearchParams(Google_Service_Vision_journalSearchParams $journalSearchParams)
  {
    $this->journalSearchParams = $journalSearchParams;
  }
  /**
   * @return Google_Service_Vision_journalSearchParams
   */
  public function getjournalSearchParams()
  {
    return $this->journalSearchParams;
  }
  /**
   * @param Google_Service_Vision_WebDetectionParams
   */
  public function setWebDetectionParams(Google_Service_Vision_WebDetectionParams $webDetectionParams)
  {
    $this->webDetectionParams = $webDetectionParams;
  }
  /**
   * @return Google_Service_Vision_WebDetectionParams
   */
  public function getWebDetectionParams()
  {
    return $this->webDetectionParams;
  }
}
