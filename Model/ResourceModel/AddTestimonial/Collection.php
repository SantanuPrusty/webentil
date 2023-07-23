<?php
declare(strict_types=1);

namespace Webential\Testimonial\Model\ResourceModel\AddTestimonial;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Webential\Testimonial\Model\AddTestimonial as AddModel;
use Webential\Testimonial\Model\ResourceModel\AddTestimonial as AddResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(AddModel::class, AddResourceModel::class);
    }
}
