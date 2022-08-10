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

class Google_Service_AdExchangeBuyerII_journal extends Google_Collection
{
  protected $collection_key = 'targetingCriterion';
  public $availableEndTime;
  public $availableStartTime;
  public $createTime;
  protected $creatorContactsType = 'Google_Service_AdExchangeBuyerII_ContactInformation';
  protected $creatorContactsDataType = 'array';
  public $displayName;
  public $hasCreatorSignedOff;
  public $journalId;
  public $journalRevision;
  public $publisherProfileId;
  protected $sellerType = 'Google_Service_AdExchangeBuyerII_Seller';
  protected $sellerDataType = '';
  public $syndicationjournal;
  protected $targetingCriterionType = 'Google_Service_AdExchangeBuyerII_TargetingCriteria';
  protected $targetingCriterionDataType = 'array';
  protected $termsType = 'Google_Service_AdExchangeBuyerII_DealTerms';
  protected $termsDataType = '';
  public $updateTime;
  public $webPropertyCode;

  public function setAvailableEndTime($availableEndTime)
  {
    $this->availableEndTime = $availableEndTime;
  }
  public function getAvailableEndTime()
  {
    return $this->availableEndTime;
  }
  public function setAvailableStartTime($availableStartTime)
  {
    $this->availableStartTime = $availableStartTime;
  }
  public function getAvailableStartTime()
  {
    return $this->availableStartTime;
  }
  public function setCreateTime($createTime)
  {
    $this->createTime = $createTime;
  }
  public function getCreateTime()
  {
    return $this->createTime;
  }
  /**
   * @param Google_Service_AdExchangeBuyerII_ContactInformation
   */
  public function setCreatorContacts($creatorContacts)
  {
    $this->creatorContacts = $creatorContacts;
  }
  /**
   * @return Google_Service_AdExchangeBuyerII_ContactInformation
   */
  public function getCreatorContacts()
  {
    return $this->creatorContacts;
  }
  public function setDisplayName($displayName)
  {
    $this->displayName = $displayName;
  }
  public function getDisplayName()
  {
    return $this->displayName;
  }
  public function setHasCreatorSignedOff($hasCreatorSignedOff)
  {
    $this->hasCreatorSignedOff = $hasCreatorSignedOff;
  }
  public function getHasCreatorSignedOff()
  {
    return $this->hasCreatorSignedOff;
  }
  public function setjournalId($journalId)
  {
    $this->journalId = $journalId;
  }
  public function getjournalId()
  {
    return $this->journalId;
  }
  public function setjournalRevision($journalRevision)
  {
    $this->journalRevision = $journalRevision;
  }
  public function getjournalRevision()
  {
    return $this->journalRevision;
  }
  public function setPublisherProfileId($publisherProfileId)
  {
    $this->publisherProfileId = $publisherProfileId;
  }
  public function getPublisherProfileId()
  {
    return $this->publisherProfileId;
  }
  /**
   * @param Google_Service_AdExchangeBuyerII_Seller
   */
  public function setSeller(Google_Service_AdExchangeBuyerII_Seller $seller)
  {
    $this->seller = $seller;
  }
  /**
   * @return Google_Service_AdExchangeBuyerII_Seller
   */
  public function getSeller()
  {
    return $this->seller;
  }
  public function setSyndicationjournal($syndicationjournal)
  {
    $this->syndicationjournal = $syndicationjournal;
  }
  public function getSyndicationjournal()
  {
    return $this->syndicationjournal;
  }
  /**
   * @param Google_Service_AdExchangeBuyerII_TargetingCriteria
   */
  public function setTargetingCriterion($targetingCriterion)
  {
    $this->targetingCriterion = $targetingCriterion;
  }
  /**
   * @return Google_Service_AdExchangeBuyerII_TargetingCriteria
   */
  public function getTargetingCriterion()
  {
    return $this->targetingCriterion;
  }
  /**
   * @param Google_Service_AdExchangeBuyerII_DealTerms
   */
  public function setTerms(Google_Service_AdExchangeBuyerII_DealTerms $terms)
  {
    $this->terms = $terms;
  }
  /**
   * @return Google_Service_AdExchangeBuyerII_DealTerms
   */
  public function getTerms()
  {
    return $this->terms;
  }
  public function setUpdateTime($updateTime)
  {
    $this->updateTime = $updateTime;
  }
  public function getUpdateTime()
  {
    return $this->updateTime;
  }
  public function setWebPropertyCode($webPropertyCode)
  {
    $this->webPropertyCode = $webPropertyCode;
  }
  public function getWebPropertyCode()
  {
    return $this->webPropertyCode;
  }
}
