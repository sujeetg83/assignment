<?php namespace Gyanmatrix\ExportBlog\Model\Api;

use Gyanmatrix\ExportBlog\Api\CustomInterface;
use Gyanmatrix\ExportBlog\Model\GridFactory;

class Custom implements CustomInterface
{
    private $moduleFactory;
    private $quote;
    protected $response = ['success' => false];

    public function __construct(GridFactory $moduleFactory, \Magento\Quote\Model\Quote $quote)
    {
        $this->quote = $quote;
        $this->moduleFactory = $moduleFactory;
    }

    /** * GET for Post api * @param string $title * @return string */
    public function getPost($title)
    {
        $insertData = $this->moduleFactory->create();
        try {
            $insertData->setTitle($data['title'])->save();
            $response = ['success' => true, 'message' => $data];
        } catch (\Exception $e) {
            $response = ['success' => false, 'message' => $e->getMessage()];
        }
        return $response;
    }

    /** * @return string */
    public function getData()
    {
        try {
            $data = $this->moduleFactory->create()->getCollection()->getData();
            return $data;
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /** * @param int $id * @return bool true on success */
    public function getDelete($id)
    {
        try {
            if ($id) {
                $data = $this->moduleFactory->create()->load($id);
                $data->delete();
                return "success";
            }
        } catch (\Exception $e) {
            $response = ['success' => false, 'message' => $e->getMessage()];
        }
        return "false";
    }

    /** * @param int $id * @return string */
    public function getById($id)
    {
        try {
            if ($id) {
                $data = $this->moduleFactory->create()->load($id)->getData();
                return ['success' => true, 'message' => json_encode($data)];
            }
        } catch (\Exception $e) {
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    /** * GET for Post api * @param string $title * @return string */
    public function getEdit($title)
    {
        $edit = file_get_contents("php://input");
        $data = json_decode($edit, true);
        $insertData = $this->moduleFactory->create();
        $id = $data['id'];
        if ($id) {
            try {
                $insertData->load($id);
                $insertData->setTitle($data['title'])->save();
                $response = ['success' => true, 'message' => $data];
            } catch (\Exception $e) {
                $response = ['success' => false, 'message' => $e->getMessage()];
            }
        }
        return response;
    }
}