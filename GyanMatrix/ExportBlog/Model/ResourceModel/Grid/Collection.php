<?php
/**
 * Grid Grid ResourceModel.
 * @category    GyanMatrix
 * @author      GyanMatrix Software Private Limited
*/

namespace GyanMatrix\ExportBlog\Model\ResourceModel\Grid;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @var string
    */
    protected $_idFieldName = 'id';

    /**
     * Define resource model.
     */
    protected function _construct()
    {
        $this->_init('Gyanmatrix\ExportBlog\Model\Grid', 'anmatrix\ExportBlog\Model\ResourceModel\Grid');
    }
} 