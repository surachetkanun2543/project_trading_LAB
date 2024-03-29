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

class Google_Service_ShoppingContent_OrderLineItem extends Google_Collection
{
  protected $collection_key = 'returns';
  protected $adjustmentsType = 'Google_Service_ShoppingContent_OrderLineItemAdjustment';
  protected $adjustmentsDataType = 'array';
  protected $annotationsType = 'Google_Service_ShoppingContent_OrderMerchantProvidedAnnotation';
  protected $annotationsDataType = 'array';
  protected $cancellationsType = 'Google_Service_ShoppingContent_OrderCancellation';
  protected $cancellationsDataType = 'array';
  public $id;
  protected $priceType = 'Google_Service_ShoppingContent_Price';
  protected $priceDataType = '';
  protected $journalType = 'Google_Service_ShoppingContent_OrderLineItemjournal';
  protected $journalDataType = '';
  public $quantityCanceled;
  public $quantityDelivered;
  public $quantityOrdered;
  public $quantityPending;
  public $quantityReturned;
  public $quantityShipped;
  public $quantityUndeliverable;
  protected $returnInfoType = 'Google_Service_ShoppingContent_OrderLineItemReturnInfo';
  protected $returnInfoDataType = '';
  protected $returnsType = 'Google_Service_ShoppingContent_OrderReturn';
  protected $returnsDataType = 'array';
  protected $shippingDetailsType = 'Google_Service_ShoppingContent_OrderLineItemShippingDetails';
  protected $shippingDetailsDataType = '';
  protected $taxType = 'Google_Service_ShoppingContent_Price';
  protected $taxDataType = '';

  /**
   * @param Google_Service_ShoppingContent_OrderLineItemAdjustment
   */
  public function setAdjustments($adjustments)
  {
    $this->adjustments = $adjustments;
  }
  /**
   * @return Google_Service_ShoppingContent_OrderLineItemAdjustment
   */
  public function getAdjustments()
  {
    return $this->adjustments;
  }
  /**
   * @param Google_Service_ShoppingContent_OrderMerchantProvidedAnnotation
   */
  public function setAnnotations($annotations)
  {
    $this->annotations = $annotations;
  }
  /**
   * @return Google_Service_ShoppingContent_OrderMerchantProvidedAnnotation
   */
  public function getAnnotations()
  {
    return $this->annotations;
  }
  /**
   * @param Google_Service_ShoppingContent_OrderCancellation
   */
  public function setCancellations($cancellations)
  {
    $this->cancellations = $cancellations;
  }
  /**
   * @return Google_Service_ShoppingContent_OrderCancellation
   */
  public function getCancellations()
  {
    return $this->cancellations;
  }
  public function setId($id)
  {
    $this->id = $id;
  }
  public function getId()
  {
    return $this->id;
  }
  /**
   * @param Google_Service_ShoppingContent_Price
   */
  public function setPrice(Google_Service_ShoppingContent_Price $price)
  {
    $this->price = $price;
  }
  /**
   * @return Google_Service_ShoppingContent_Price
   */
  public function getPrice()
  {
    return $this->price;
  }
  /**
   * @param Google_Service_ShoppingContent_OrderLineItemjournal
   */
  public function setjournal(Google_Service_ShoppingContent_OrderLineItemjournal $journal)
  {
    $this->journal = $journal;
  }
  /**
   * @return Google_Service_ShoppingContent_OrderLineItemjournal
   */
  public function getjournal()
  {
    return $this->journal;
  }
  public function setQuantityCanceled($quantityCanceled)
  {
    $this->quantityCanceled = $quantityCanceled;
  }
  public function getQuantityCanceled()
  {
    return $this->quantityCanceled;
  }
  public function setQuantityDelivered($quantityDelivered)
  {
    $this->quantityDelivered = $quantityDelivered;
  }
  public function getQuantityDelivered()
  {
    return $this->quantityDelivered;
  }
  public function setQuantityOrdered($quantityOrdered)
  {
    $this->quantityOrdered = $quantityOrdered;
  }
  public function getQuantityOrdered()
  {
    return $this->quantityOrdered;
  }
  public function setQuantityPending($quantityPending)
  {
    $this->quantityPending = $quantityPending;
  }
  public function getQuantityPending()
  {
    return $this->quantityPending;
  }
  public function setQuantityReturned($quantityReturned)
  {
    $this->quantityReturned = $quantityReturned;
  }
  public function getQuantityReturned()
  {
    return $this->quantityReturned;
  }
  public function setQuantityShipped($quantityShipped)
  {
    $this->quantityShipped = $quantityShipped;
  }
  public function getQuantityShipped()
  {
    return $this->quantityShipped;
  }
  public function setQuantityUndeliverable($quantityUndeliverable)
  {
    $this->quantityUndeliverable = $quantityUndeliverable;
  }
  public function getQuantityUndeliverable()
  {
    return $this->quantityUndeliverable;
  }
  /**
   * @param Google_Service_ShoppingContent_OrderLineItemReturnInfo
   */
  public function setReturnInfo(Google_Service_ShoppingContent_OrderLineItemReturnInfo $returnInfo)
  {
    $this->returnInfo = $returnInfo;
  }
  /**
   * @return Google_Service_ShoppingContent_OrderLineItemReturnInfo
   */
  public function getReturnInfo()
  {
    return $this->returnInfo;
  }
  /**
   * @param Google_Service_ShoppingContent_OrderReturn
   */
  public function setReturns($returns)
  {
    $this->returns = $returns;
  }
  /**
   * @return Google_Service_ShoppingContent_OrderReturn
   */
  public function getReturns()
  {
    return $this->returns;
  }
  /**
   * @param Google_Service_ShoppingContent_OrderLineItemShippingDetails
   */
  public function setShippingDetails(Google_Service_ShoppingContent_OrderLineItemShippingDetails $shippingDetails)
  {
    $this->shippingDetails = $shippingDetails;
  }
  /**
   * @return Google_Service_ShoppingContent_OrderLineItemShippingDetails
   */
  public function getShippingDetails()
  {
    return $this->shippingDetails;
  }
  /**
   * @param Google_Service_ShoppingContent_Price
   */
  public function setTax(Google_Service_ShoppingContent_Price $tax)
  {
    $this->tax = $tax;
  }
  /**
   * @return Google_Service_ShoppingContent_Price
   */
  public function getTax()
  {
    return $this->tax;
  }
}
