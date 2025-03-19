<?php
declare(strict_types=1);

namespace Gyanmatrix\ExportBlog\Test\Unit\Controller\Adminhtml\Grid;

use Gyanmatrix\ExportBlog\Controller\Adminhtml\Grid\Index;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

class IndexTest extends TestCase
{
    /**
     * @var MockObject|Context
     */
    private $context;

    /**
     * @var MockObject|PageFactory
     */
    private $resultPageFactory;

    /**
     * @var MockObject|Page
     */
    private $resultPage;

    /**
     * @var Index
     */
    private $indexController;

    protected function setUp(): void
    {
        // Create mock objects for dependencies.
        $this->context = $this->createMock(Context::class);
        $this->resultPageFactory = $this->createMock(PageFactory::class);
        $this->resultPage = $this->createMock(Page::class);

        // Configure the PageFactory mock to return the Page mock.
        $this->resultPageFactory->method('create')
            ->willReturn($this->resultPage);

        // Instantiate the controller with mocks.
        $this->indexController = new Index($this->context, $this->resultPageFactory);
    }

    public function testExecute(): void
    {
        // Configure the Page mock to expect method calls.
        $this->resultPage->expects($this->once())
            ->method('setActiveMenu')
            ->with('Gyanmatrix_ExportBlog::grid_list');

        $this->resultPage->expects($this->once())
            ->method('getConfig')
            ->willReturnSelf();

        $this->resultPage->expects($this->once())
            ->method('prepend')
            ->with(__('Grid List'));

        // Call the execute method and assert the result is as expected.
        $result = $this->indexController->execute();
        $this->assertSame($this->resultPage, $result);
    }

    public function testIsAllowed(): void
    {
        // Mock the _authorization method within context.
        $authorizationMock = $this->createMock(\Magento\Framework\AuthorizationInterface::class);
        $authorizationMock->expects($this->once())
            ->method('isAllowed')
            ->with('Gyanmatrix_ExportBlog::grid_list')
            ->willReturn(true);

        $this->context->method('getAuthorization')
            ->willReturn($authorizationMock);

        // Call the _isAllowed method and assert the result.
        $this->assertTrue($this->indexController->_isAllowed());
    }
}
