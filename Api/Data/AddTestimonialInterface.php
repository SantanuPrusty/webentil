<?php
declare(strict_types=1);

namespace Webential\Testimonial\Api\Data;

interface AddTestimonialInterface
{
  public const ID = 'id';
  public const CUSTOMER_NAME = 'customer_name';
  public const COMMENT = 'comment';
  public const APPROVEDDISAPPROVED = 'approved_disapproved';
  public const STATUS = 'status';

  /**
   * @return int
   */
  public function getId();

  /**
   * @param int $id
   *
   * @return \\Webential\Testimonial\Api\Data\AddTestimonialInterface
   */
  public function setId($id);

  /**
   * @return string
   */
  public function getCustomerName();

  /**
   * @param string $customerName
   *
   * @return \Webential\Testimonial\Api\Data\AddTestimonialInterface
   */
  public function setCustomerName($customerName);
  /**
   * @return string
   */
  public function getComment();

  /**
   * @param string $comment
   *
   * @return \Webential\Testimonial\Api\Data\AddTestimonialInterface
   */
  public function setComment($comment);
  /**
   * @return string
   */
  public function getApprovedDisapproved();

  /**
   * @param string $approvedDisapproved
   *
   * @return \Webential\Testimonial\Api\Data\AddTestimonialInterface
   */
  public function setApprovedDisapproved($approvedDisapproved);
  /**
   * @return string
   */
  public function getStatus();

  /**
   * @param string $status
   *
   * @return \Webential\Testimonial\Api\Data\AddTestimonialInterface
   */
  public function setStatus($status);
}
