<?php
/**
 * Grid Grid ResourceModel.
 * @category    GyanMatrix
 * @author      GyanMatrix Software Private Limited
*/
namespace Gyanmatrix\ExportBlog\Controller\Adminhtml\Grid;

use Magento\Framework\Controller\ResultFactory;

class AddRow extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

    /**
     * @var \Gyanmatrix\ExportBlog\Model\GridFactory
     */
    private $gridFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry,
     * @param \Gyanmatrix\ExportBlog\Model\GridFactory $gridFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Gyanmatrix\ExportBlog\Model\GridFactory $gridFactory
    ) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->gridFactory = $gridFactory;
    }

    /**
     * Mapped Grid List page.
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $rowId = (int) $this->getRequest()->getParam('id');
        $rowData = $this->gridFactory->create();
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        if ($rowId) {
           $rowData = $rowData->load($rowId);
           $rowTitle = $rowData->getTitle();
           if (!$rowData->getEntityId()) {
               $this->messageManager->addError(__('row data no longer exist.'));
               $this->_redirect('expotblog/grid/rowdata');
               return;
           }
       }

       $this->coreRegistry->register('row_data', $rowData);
       $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
       $title = $rowId ? __('Edit Row Data ').$rowTitle : __('Add Row Data');
       $resultPage->getConfig()->getTitle()->prepend($title);
       return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Gyanmatrix_ExportBlog::add_row');
    }
}