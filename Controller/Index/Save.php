<?php
declare(strict_types=1);

namespace Webential\Testimonial\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Webential\Testimonial\Model\TestimonialListFactory  as MpListFactory;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\App\Action\Action;

class Save extends Action
{
    protected $resultPageFactory;
    /**
     * @var MpListFactory
     */
    private $mpListFactory;

    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        MpListFactory         $mpListFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->mpListFactory = $mpListFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $data = (array)$this->getRequest()->getPost();
            if ($data) {
              $customer_name = $this->getRequest()->getParam('customer_name');
              $comment = $this->getRequest()->getParam('comment');
                $model = $this->mpListFactory->create();
                $model->setData('customer_name', $customer_name);
                $model->setData('comment', $comment);
                $model->setData('approved_disapproved', 'Disapproved');
                $model->setData('status', 1)->save();
                $this->messageManager->addSuccessMessage(__("Data Send Successfully."));
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e, __("We can\'t submit your request, Please try again."));
        }
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
      $resultRedirect->setUrl($this->_redirect->getRefererUrl());
        return $resultRedirect;

    }
}
