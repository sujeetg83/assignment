<?php
/**
 *
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace GyanMatrix\Contact\Controller\Index;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ObjectManager;
use GyanMatrix\Contact\Model\ContactFactory;
use Magento\Framework\App\Action\Context;
use Magento\Contact\Model\ConfigInterface;
use Magento\Contact\Model\MailInterface;
use Psr\Log\LoggerInterface;


class Post extends \Magento\Contact\Controller\Index\Post
{
    /**
     * @var ContactFactory
     */
    protected $_contactFactory;

    /**
     * @var DataPersistorInterface
     */
    private $dataPersistor;



    public function __construct(
        Context $context,
        ConfigInterface $contactsConfig,
        MailInterface $mail,
        DataPersistorInterface $dataPersistor,
        LoggerInterface $logger = null,
        ContactFactory $_contactFactory
    ) {
        $this->_contactFactory = $_contactFactory;
        parent::__construct($context, $contactsConfig, $mail, $dataPersistor, $logger);
    }

    /**
     * Post action
     *
     */
    public function execute($coreRoute = null)
    {

        if (!$this->getRequest()->isPost()) {
            return $this->resultRedirectFactory->create()->setPath('*/*/');
        }
        try {
            $post = $this->getRequest()->getPostValue();
            $formData = $this->_contactFactory->create();
            $formData->setData($post);
            $formData->save();
            $this->sendEmail($this->validatedParams());
            $this->messageManager->addSuccessMessage(
                __('Thanks for contacting us with your comments and questions. We\'ll respond to you very soon.')
            );
            $this->dataPersistor->clear('contact_us');
        } catch (LocalizedException $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            $this->dataPersistor->set('contact_us', $this->getRequest()->getParams());
        } catch (\Exception $e) {
            $this->logger->critical($e);
            $this->messageManager->addErrorMessage(
                __('An error occurred while processing your form. Please try again later.')
            );
            $this->dataPersistor->set('contact_us', $this->getRequest()->getParams());
        }
        return $this->resultRedirectFactory->create()->setPath('contact/index');
    }
}