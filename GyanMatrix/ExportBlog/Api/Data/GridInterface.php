<?php
declare(strict_types=1);
/**
 * Grid Grid ResourceModel.
 * @category    GyanMatrix
 * @author      GyanMatrix Software Private Limited
*/
namespace GyanMatrix\ExportBlog\Api\Data;

interface GridInterface
{
    public const ENTITY_ID = 'entity_id';
    public const TITLE = 'title';
    public const CONTENT = 'content';
    public const CREATED_AT = 'created_at';
    public const IS_ACTIVE = 'is_active';
    public const UPDATED_AT = 'updated_at';

    /**
     * Get EntityId.
     *
     * @return int
    */
    public function getEntityId();
    
    /**
     * Set $entityId.
     *
     * @param int $entityId
    */
    public function setEntityId($entityId);
    
    /**
     * Get Title.
     *
     * @return varchar
    */
    public function getTitle();
    
    /**
     * Set Title.
     *
     * @param String $title
    */
    public function setTitle($title);
    
    /**
     * Get Content.
     *
     * @return varchar
    */
    public function getContent();
    
    /**
     * Set Content.
     *
     * @param String $content
    */
    public function setContent($content);

    /**
     * Get IsActive.
     *
     * @return varchar
    */
    public function getIsActive();
    
    /**
     * Set Enable or Disable.
     *
     * @param int $isActive
    */
    public function setIsActive($isActive);
    
    /**
     * Get updatedAt.
     *
     * @return varchar
    */
    public function getUpdatedAt();

    /**
     * Set UpdatedAt.
     *
     * @param string $updatedAt
     */
    public function setUpdatedAt($updatedAt);

    /**
     * Get CreatedAt.
     *
     * @return varchar
     */
    public function getCreatedAt();

    /**
     * Set CreatedAt.
     *
     * @param string $createdAt
    */
    public function setCreatedAt($createdAt);
}
