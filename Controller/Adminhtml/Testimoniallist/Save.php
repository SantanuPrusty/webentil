<?php

namespace Webential\Testimonial\Controller\Adminhtml\Testimoniallist;

use Magento\Backend\App\Action;
use Magento\Backend\Model\Session;
use Webential\Testimonial\Model\TestimonialList;
use Webential\Testimonial\Model\AddTestimonial;
use Webential\Testimonial\Model\ResourceModel\AddTestimonial\CollectionFactory;

class Save extends \Magento\Backend\App\Action
{

    /**
     * @var TestimonialList
     */
    protected $listmodel;

    /**
     * @var Session
     */
    protected $adminsession;

     /**
      * @var AddTestimonial
      */
     protected $addmodel;
     /**
      * @var CollectionFactory
      */
     private $collectionFactory;

    public function __construct(
        Action\Context $context,
        TestimonialList $listmodel,
        Session $adminsession,
        AddTestimonial $addmodel,
        CollectionFactory         $collectionFactory
    ) {
        parent::__construct($context);
        $this->listmodel = $listmodel;
        $this->adminsession = $adminsession;
        $this->addmodel = $addmodel;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * Save blog record action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

        $resultRedirect = $this->resultRedirectFactory->create();

        if ($data) {
          $admin_create_id = $this->getRequest()->getParam('admin_create_id');
          $admin_id = $this->collectionFactory->create()
              ->addFieldToSelect('id')->addFieldToFilter('id', $admin_create_id);

            $tableId = $admin_id->getData();
            $customer_name = $this->getRequest()->getParam('customer_name');
            $approved_disapproved = $this->getRequest()->getParam('approved_disapproved');
            $status = $this->getRequest()->getParam('status');
            $comment = $this->getRequest()->getParam('comment');
            if($tableId){
              $updateAdminData = $this->addmodel->load($tableId);
              $updateAdminData->setData('customer_name', $customer_name);
              $updateAdminData->setData('comment', $comment);
              $updateAdminData->setData('approved_disapproved', $approved_disapproved);
              $updateAdminData->setData('status', $status);
              $updateAdminData->save();
            }
            $blog_id = $this->getRequest()->getParam('id');
            if ($blog_id) {
                $this->listmodel->load($blog_id);
            }

            $this->listmodel->setData($data);

            try {
                $this->listmodel->save();
                $this->messageManager->addSuccess(__('The data has been saved.'));
                $this->adminsession->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    if ($this->getRequest()->getParam('back') == 'add') {
                        return $resultRedirect->setPath('*/*/add');
                    } else {
                        return $resultRedirect->setPath('*/*/edit', ['id' => $this->listmodel->getId(), '_current' => true]);
                    }
                }

                return $resultRedirect->setPath('*/*/');
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the data.'));
            }

            $this->_getSession()->setFormData($data);
            return $resultRedirect->setPath('*/*/edit', ['id' => $this->getRequest()->getParam('id')]);
        }

        return $resultRedirect->setPath('*/*/');
    }
}
