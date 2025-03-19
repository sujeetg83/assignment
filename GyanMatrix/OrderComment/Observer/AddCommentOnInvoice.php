<?php

namespace GyanMatrix\OrderComment\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Backend\Model\Auth\Session as AdminSession;

/**
 * Observer to add a comment to the order history when a Invoice is created.
 */
class AddCommentOnInvoice implements ObserverInterface
{
    /**
     * Constant TEMP_USER
    */
    const TEMP_USER = 'System';

    /**
     * @var AdminSession
    */
    protected $adminSession;

    /**
     * Constructor.
     *
     * @param AdminSession $adminSession
    */
    public function __construct(AdminSession $adminSession)
    {
        $this->adminSession = $adminSession;
    }

    /**
     * Execute observer.
     *
     * Adds a comment with the admin username and current date to the order
     * history when a Invoice is created.
     *
     * @param Observer $observer
     * @return void
    */
    public function execute(Observer $observer)
    {
        $invoice = $observer->getEvent()->getInvoice();
        $order = $invoice->getOrder();
        $adminUser = $this->adminSession->getUser();
        $adminName = $adminUser ? $adminUser->getUsername() : self::TEMP_USER;
        $comment = sprintf('Invoice created by %s on %s', $adminName, date('Y-m-d H:i:s'));
        $order->addStatusHistoryComment($comment)->save();
    }
}