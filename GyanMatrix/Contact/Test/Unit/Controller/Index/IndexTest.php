<?php
declare(strict_types=1);

namespace GyanMatrix\Contact\Test\Unit\Controller\Index;

use PHPUnit\Framework\TestCase;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use GyanMatrix\Contact\Controller\Index\Index;

class IndexTest extends TestCase
{
    /**
     * @var \Magento\Framework\App\Action\Context|\PHPUnit\Framework\MockObject\MockObject
     */
    private $contextMock;

    /**
     * @var \Magento\Framework\View\Result\PageFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    private $pageFactoryMock;

    /**
     * @var \Magento\Framework\View\Result\Page|\PHPUnit\Framework\MockObject\MockObject
     */
    private $pageMock;

    /**
     * @var \GyanMatrix\Contact\Controller\Index\Index
     */
    private $controller;

    protected function setUp(): void
    {
        // Mock the context
        $this->contextMock = $this->createMock(Context::class);

        // Mock the PageFactory
        $this->pageFactoryMock = $this->createMock(PageFactory::class);

        // Mock the Page result
        $this->pageMock = $this->createMock(Page::class);

        // Configure the PageFactory mock to return the Page mock
        $this->pageFactoryMock->method('create')->willReturn($this->pageMock);

        // Initialize the controller
        $this->controller = new Index(
            $this->contextMock,
            $this->pageFactoryMock
        );
    }

    public function testExecute()
    {
        // Act: Call the execute method
        $result = $this->controller->execute();

        // Assert: Check that the returned result is the mocked Page instance
        $this->assertSame($this->pageMock, $result);
    }
}