<?php
/**
 * Grid Grid ResourceModel.
 * @category    GyanMatrix
 * @author      GyanMatrix Software Private Limited
 */
namespace Gyanmatrix\ExportBlog\Model;

use Gyanmatrix\ExportBlog\Api\Data\GridInterface;

class Grid extends \Magento\Framework\Model\AbstractModel implements GridInterface
{
    /**
     * CMS page cache tag.
     */
    const CACHE_TAG = 'exportblog';

    /**
     * @var string
     */
    protected $_cacheTag = 'exportblog';

    /**
     * Prefix of model events names.
     *
     * @var string
    */
    protected $_eventPrefix = 'exportblog';

    /**
     * Initialize resource model.
    */
    protected function _construct()
    {
        $this->_init('Gyanmatrix\ExportBlog\Model\ResourceModel\Grid');
    }

    /**
     * Get EntityId.
     *
     * @return int
    */
    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * Set EntityId.
    */
    public function setEntityId($articleId)
    {
        return $this->setData(self::ENTITY_ID, $articleId);
    }

    /**
     * Get Title.
     *
     * @return varchar
    */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * Set Title.
    */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Get Title.
     *
     * @return varchar
    */
    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * Set Title.
    */
    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * Get Created Date.
     *
     * @return varchar
    */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Set Created Date.
    */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $created_at);
    }

    /**
     * Get IsActive.
     *
     * @return varchar
    */
    public function getIsActive()
    {
        return $this->getData(self::IS_ACTIVE);
    }

    /**
     * Set IsActive.
    */
    public function setIsActive($isActive)
    {
        return $this->setData(self::IS_ACTIVE, $isActive);
    }
    
    /**
     * Get UpdateTime.
     *
     * @return varchar
    */
    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * Set UpdateTime.
    */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }
}