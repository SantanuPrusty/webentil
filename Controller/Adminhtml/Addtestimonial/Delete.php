<?php
declare(strict_types=1);

namespace Webential\Testimonial\Controller\Adminhtml\Addtestimonial;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;

class Delete extends Action
{

    /**
     * @var \Webential\Testimonial\Model\AddTestimonial
     */
    protected $modelAdd;

    /**
     * @param Context                  $context
     * @param \Webential\Testimonial\Model\AddTestimonial $addFactory
     */
    public function __construct(
        Context $context,
        \Webential\Testimonial\Model\AddTestimonial $addFactory
    ) {
        parent::__construct($context);
        $this->modelAdd = $addFactory;
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Webential_Testimonial::addtestimonial_delete');
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
                $model = $this->modelAdd;
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('Record deleted successfully.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['id' => $id]);
            }
        }
        $this->messageManager->addError(__('Record does not exist.'));
        return $resultRedirect->setPath('*/*/');
    }
}
