<?php
declare(strict_types=1);

namespace Webential\Testimonial\Model\ResourceModel\TestimonialList;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Webential\Testimonial\Model\TestimonialList as ListModel;
use Webential\Testimonial\Model\ResourceModel\TestimonialList as ListResourceModel;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(ListModel::class, ListResourceModel::class);
    }
}
