<?php

namespace GyanMatrix\Contact\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Contact extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('contact_us', 'id');
    }
}