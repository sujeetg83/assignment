<?php
namespace GyanMatrix\Contact\Api;

/**
 * Interface ContactusManagementInterface
 *
 * @package GyanMatrix\Contact\Api
 */
interface ContactusManagementInterface
{
    /**
     * Contact us form.
     *
     * @param mixed $contactForm
     *
     * @return \Vendor\ContactusApi\Api\Data\ContactusInterface
     */
    public function submitForm($contactForm);
}