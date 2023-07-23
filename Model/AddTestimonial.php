<?php
declare(strict_types=1);

namespace Webential\Testimonial\Model;

use Magento\Framework\Model\AbstractModel;
use Webential\Testimonial\Model\ResourceModel\AddTestimonial as AddResourceModel;
use Webential\Testimonial\Api\Data\AddTestimonialInterface;

class AddTestimonial extends \Magento\Framework\Model\AbstractModel implements AddTestimonialInterface
{
  /**
   * @var string
   */
  protected $_cacheTag = 'testimonial_new_add';

  /**
   * Prefix of model events names.
   *
   * @var string
   */
  protected $_eventPrefix = 'testimonial_new_add';

    protected function _construct()
    {
        $this->_init(AddResourceModel::class);
    }
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * Set Id.
     */
    public function setId($Id)
    {
        return $this->setData(self::ID, $Id);
    }
    /**
     * Get CustomerName
     *
     * @return varchar
     */
    public function getCustomerName()
    {
        return $this->getData(self::CUSTOMER_NAME);
    }

    /**
     * Set CustomerName
     */
    public function setCustomerName($customerName)
    {
        return $this->setData(self::CUSTOMER_NAME, $customerName);
    }
    /**
     * Get Comment
     *
     * @return varchar
     */
    public function getComment()
    {
        return $this->getData(self::COMMENT);
    }

    /**
     * Set Comment
     */
    public function setComment($comment)
    {
        return $this->setData(self::COMMENT, $comment);
    }
    /**
     * Get Approved/Disapproved.
     *
     * @return varchar
     */
    public function getApprovedDisapproved()
    {
        return $this->getData(self::APPROVEDDISAPPROVED);
    }

    /**
     * Set Approved/Disapproved.
     */
    public function setApprovedDisapproved($approvedDisapproved)
    {
        return $this->setData(self::APPROVEDDISAPPROVED, $approvedDisapproved);
    }
    /**
     * Get status.
     *
     * @return varchar
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * Set status.
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }
}
