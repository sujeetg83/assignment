<?php

namespace GyanMatrix\Contact\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use GyanMatrix\Contact\Model\ContactFactory;

class Save extends Action
{
    /**
     * @var JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * @var CustomFormFactory
     */
    protected $customFormFactory;

    /**
     * Constructor
     *
     * @param Context $context
     * @param JsonFactory $resultJsonFactory
     * @param ContactFactory $customFormFactory
     */
    public function __construct(
        Context $context,
        JsonFactory $resultJsonFactory,
        ContactFactory $customFormFactory
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->customFormFactory = $customFormFactory;
    }

    /**
     * Execute method
     *
     * @return \Magento\Framework\Controller\Result\Json
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->resultJsonFactory->create();
        $response = ['success' => false, 'message' => __('An error occurred.')];

        try {
            $postData = $this->getRequest()->getPostValue();

            if (!empty($postData)) {
                // Create a new custom form model
                $form = $this->customFormFactory->create();
                $form->setData($postData);

                // Save form data
                $form->save();

                $response = ['success' => true, 'message' => __('Form data has been saved successfully.')];
            } else {
                $response['message'] = __('No data provided.');
            }
        } catch (\Exception $e) {
            $response['message'] = __('Error: %1', $e->getMessage());
        }

        return $resultJson->setData($response);
    }
}