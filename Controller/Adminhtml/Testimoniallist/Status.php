<?php

namespace Webential\Testimonial\Controller\Adminhtml\Testimoniallist;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

class Status extends Action
{

    /**
     * @var \Webential\Testimonial\Model\TestimonialList
     */
    protected $modelList;

    /**
     * @param Context                  $context
     * @param \Webential\Testimonial\Model\TestimonialList $listFactory
     */
    public function __construct(
        Context $context,
        \Webential\Testimonial\Model\TestimonialList $listFactory
    ) {
        parent::__construct($context);
        $this->modelList = $listFactory;
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Webential_Testimonial::testimoniallist_status');
    }

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->modelList;
                $model->load($id);
                $status = $model->getStatus();
                if($status !== "0"){
                  $model->setStatus("0");
                  $model->save();
                }else{
                  $model->setStatus("1");
                  $model->save();
                }
                $this->messageManager->addSuccess(__('Status Change successfully.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/', ['id' => $id]);
            }
        }
        $this->messageManager->addError(__('Record does not exist.'));
        return $resultRedirect->setPath('*/*/');
    }
}
