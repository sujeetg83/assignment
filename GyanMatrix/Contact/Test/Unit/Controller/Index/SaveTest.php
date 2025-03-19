<?php
declare(strict_types=1);

namespace GyanMatrix\Contact\Test\Unit\Controller\Index;

use PHPUnit\Framework\TestCase;
use Magento\Framework\App\Request\Http as Request;
use Magento\Framework\Controller\Result\Json as JsonResult;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\App\Action\Context;
use GyanMatrix\Contact\Controller\Index\Save;
use GyanMatrix\Contact\Model\Contact;
use GyanMatrix\Contact\Model\ContactFactory;

class SaveTest extends TestCase
{
    /**
     * @var \Magento\Framework\App\Request\Http|\PHPUnit\Framework\MockObject\MockObject
     */
    private $requestMock;

    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    private $resultJsonFactoryMock;

    /**
     * @var \Magento\Framework\Controller\Result\Json|\PHPUnit\Framework\MockObject\MockObject
     */
    private $resultJsonMock;

    /**
     * @var \GyanMatrix\Contact\Model\ContactFactory|\PHPUnit\Framework\MockObject\MockObject
     */
    private $contactFactoryMock;

    /**
     * @var \GyanMatrix\Contact\Model\Contact|\PHPUnit\Framework\MockObject\MockObject
     */
    private $contactMock;

    /**
     * @var Save
     */
    private $controller;

    protected function setUp(): void
    {
        // Mock dependencies
        $this->requestMock = $this->createMock(Request::class);
        $this->resultJsonFactoryMock = $this->createMock(JsonFactory::class);
        $this->resultJsonMock = $this->createMock(JsonResult::class);
        $this->contactFactoryMock = $this->createMock(ContactFactory::class);
        $this->contactMock = $this->createMock(Contact::class);

        // Mock Result Json Factory behavior
        $this->resultJsonFactoryMock->method('create')->willReturn($this->resultJsonMock);

        // Mock ContactFactory behavior
        $this->contactFactoryMock->method('create')->willReturn($this->contactMock);

        // Create controller instance
        $contextMock = $this->createMock(Context::class);
        $contextMock->method('getRequest')->willReturn($this->requestMock);

        $this->controller = new Save(
            $contextMock,
            $this->resultJsonFactoryMock,
            $this->contactFactoryMock
        );
    }

    public function testExecuteWithValidData()
    {
        $postData = ['name' => 'Sujeet test', 'email' => 'Sujeet@example.com', 'telephone' => '8754839390', 'comment' => 'Test message'];

        // Mock Request behavior
        $this->requestMock->method('getPostValue')->willReturn($postData);

        // Expect setData and save to be called on the contact model
        $this->contactMock->expects($this->once())->method('setData')->with($postData);
        $this->contactMock->expects($this->once())->method('save');

        // Expect Json response with success
        $this->resultJsonMock->expects($this->once())->method('setData')->with([
            'success' => true,
            'message' => __('Form data has been saved successfully.')
        ]);

        // Execute the controller
        $this->controller->execute();
    }

    public function testExecuteWithNoData()
    {
        // Mock Request behavior to return no data
        $this->requestMock->method('getPostValue')->willReturn([]);

        // Expect Json response with no data error
        $this->resultJsonMock->expects($this->once())->method('setData')->with([
            'success' => false,
            'message' => __('No data provided.')
        ]);

        // Execute the controller
        $this->controller->execute();
    }

    public function testExecuteWithException()
    {
        $postData = ['name' => 'Sujeet test', 'email' => 'Sujeet@example.com', 'telephone' => '8754839390', 'comment' => 'Test message'];

        // Mock Request behavior
        $this->requestMock->method('getPostValue')->willReturn($postData);

        // Expect setData to be called on the contact model
        $this->contactMock->expects($this->once())->method('setData')->with($postData);

        // Expect save to throw an exception
        $this->contactMock->expects($this->once())->method('save')->willThrowException(new \Exception('Test exception'));

        // Expect Json response with error
        $this->resultJsonMock->expects($this->once())->method('setData')->with([
            'success' => false,
            'message' => __('Error: %1', 'Test exception')
        ]);

        // Execute the controller
        $this->controller->execute();
    }
}