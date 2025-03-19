<?php

namespace GyanMatrix\Contact\Model\ResourceModel\Contact;

use GyanMatrix\Contact\Model\Contact as ContactModel;
use GyanMatrix\Contact\Model\ResourceModel\Contact as ContactResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            ContactModel::class,
            ContactResourceModel::class
        );
    }
}