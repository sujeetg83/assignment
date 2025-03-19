<?php

namespace GyanMatrix\CustomField\Plugin;

use Magento\Quote\Api\CartRepositoryInterface;

class ShippingInformationManagement
{
    public $cartRepository;

    public function __construct(
        CartRepositoryInterface $cartRepository
    ) {
        $this->cartRepository = $cartRepository;
    }

    public function beforeSaveAddressInformation($subject, $cartId, $addressInformation)
    {
        $quote = $this->cartRepository->getActive($cartId);
        $deliveryRecieve = $addressInformation->getShippingAddress()->getExtensionAttributes()->getDeliveryRecieve();
        $quote->setDeliveryRecieve($deliveryRecieve);
        $this->cartRepository->save($quote);
        return [$cartId, $addressInformation];
    }
}