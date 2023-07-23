<?php
declare(strict_types=1);

namespace Webential\Testimonial\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class AddTestimonial extends AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('testimonial_new_add', 'id');
    }
}
