<?php

namespace GyanMatrix\CustomField\Block;

class LayoutProcessor implements \Magento\Checkout\Block\Checkout\LayoutProcessorInterface
{
    public function process($jsLayout)
    {
        $attributeCode = 'delivery_recieve';
        $fieldConfiguration = [
            'component' => 'Magento_Ui/js/form/element/textarea',
            'config' => [
                'customScope' => 'shippingAddress.extension_attributes',
                'customEntry' => null,
                'template' => 'ui/form/field',
                'elementTmpl' => 'ui/form/element/radio',
                'tooltip' => [
                    'description' => 'Here you can leave  Shipment Recieve ',
                ],
            ],
            'dataScope' => 'shippingAddress.extension_attributes' . '.' . $attributeCode,
            'label' => ' Shipment Recieve ',
            'provider' => 'checkoutProvider',
            'sortOrder' => 1000,
            'validation' => [
                'required-entry' => true
            ],
            'filterBy' => null,
            'customEntry' => null,
            'visible' => true,
            'value' => '',
            'options' => [
                ['value' => 'work', 'label' => 'Work'],
                ['value' => 'home', 'label' => 'Home'],
                ['value' => 'other', 'label' => 'Other'],
            ],
        ];

        $jsLayout['components']['checkout']['children']
        ['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['shipping-address-fieldset']
        ['children'][$attributeCode] = $fieldConfiguration;
        return $jsLayout;
    }
}