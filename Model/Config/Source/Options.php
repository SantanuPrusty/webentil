<?php
declare(strict_types=1);

namespace Webential\Testimonial\Model\Config\Source;

class Options implements \Magento\Framework\Option\ArrayInterface
{

  public function toOptionArray()
    {
      return [
        [
          'value' => 'Approved',
          'label' => __('Approved'),
          ],
          [
          'value' => 'Disapproved',
          'label' => __('Disapproved'),
        ],
      ];
    }
}
