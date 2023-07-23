<?php
declare(strict_types=1);

namespace Webential\Testimonial\Controller\Adminhtml\AddTestimonial;

use Magento\Backend\App\Action;
use Magento\Backend\Model\Session;
use Webential\Testimonial\Model\AddTestimonial;
use Webential\Testimonial\Model\ResourceModel\TestimonialList\CollectionFactory;
use Webential\Testimonial\Model\TestimonialListFactory  as MpListFactory;

class Save extends \Magento\Backend\App\Action
{

    /**
     * @var AddTestimonial
     */
    protected $addmodel;

    /**
     * @var Session
     */
    protected $adminsession;
    /**
     * @var CollectionFactory
     */
    private $collectionFactory;
    /**
     * @var MpListFactory
     */
    private $mpListFactory;

    /**
     * @param Action\Context $context
     * @param AddTestimonial           $addmodel
     * @param Session        $adminsession
     */
    public function __construct(
        Action\Context $context,
        AddTestimonial $addmodel,
        Session $adminsession,
        CollectionFactory         $collectionFactory,
        MpListFactory         $mpListFactory
    ) {
        parent::__construct($context);
        $this->addmodel = $addmodel;
        $this->adminsession = $adminsession;
        $this->collectionFactory = $collectionFactory;
        $this->mpListFactory = $mpListFactory;
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
            $blog_id = $this->getRequest()->getParam('id');
            if ($blog_id) {
                $this->addmodel->load($blog_id);
            }

            $this->addmodel->setData($data);

            try {
                $this->addmodel->save();

                // Start - Store Data In testimonial_list Table
                $currentId = $this->addmodel->getId();
                $customer_name = $this->getRequest()->getParam('customer_name');
                $approved_disapproved = $this->getRequest()->getParam('approved_disapproved');
                $status = $this->getRequest()->getParam('status');
                $comment = $this->getRequest()->getParam('comment');
                $listId = $this->collectionFactory->create()
                    ->addFieldToSelect('id')->addFieldToFilter('admin_create_id', $currentId);
                    $tableId = $listId->getData();
                    if(!$tableId){
                      $model = $this->mpListFactory->create();
                      $model->setCustomerName($customer_name);
                      $model->setComment($comment);
                      $model->setApprovedDisapproved($approved_disapproved);
                      $model->setStatus($status);
                      $model->setAdminCreateId($currentId);
                      $model->save();
                    }else{
                      $updateData = $this->mpListFactory->create()->load($tableId);
                      $updateData->setData('customer_name', $customer_name);
                      $updateData->setData('comment', $comment);
                      $updateData->setData('approved_disapproved', $approved_disapproved);
                      $updateData->setData('status', $status);
                      $updateData->save();
                    }
                // End - Store Data In testimonial_list Table

                $this->messageManager->addSuccess(__('The data has been saved.'));
                $this->adminsession->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    if ($this->getRequest()->getParam('back') == 'add') {
                        return $resultRedirect->setPath('*/*/add');
                    } else {
                        return $resultRedirect->setPath('*/*/edit', ['id' => $this->addmodel->getId(), '_current' => true]);
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
