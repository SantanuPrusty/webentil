<?php

namespace Webential\Testimonial\Block;

use Magento\Framework\View\Element\Template;
use Magento\Backend\Block\Template\Context;
use Webential\Testimonial\Model\ResourceModel\TestimonialList\CollectionFactory;

class Display extends Template
{
  /**
   * @var CollectionFactory
   */
  private $collectionFactory;
    public function __construct(
      Context $context,
      CollectionFactory         $collectionFactory,
      array $data = [])
    {
        parent::__construct($context, $data);
        $this->collectionFactory = $collectionFactory;
    }
    public function getTestimonialList()
    {
      return $this->collectionFactory->create();
    }
}
