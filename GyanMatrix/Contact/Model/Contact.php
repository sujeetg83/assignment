<?php

namespace GyanMatrix\Contact\Model;

use GyanMatrix\Contact\Model\ResourceModel\Contact as ContactResourceModel;
use Magento\Framework\Model\AbstractModel;


class Contact extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(ContactResourceModel::class);
    }
}