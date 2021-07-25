<?php
namespace Magelearn\GstCheckout\Block\Adminhtml;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Template\Context;
use Magelearn\GstCheckout\Model\Config;

class GstNumber extends Template
{
    /**
     * @var Config
     */
    private $config;

    /**
     * GST Number constructor.
     *
     * @param Context $context
     * @param Config $config
     * @param array $data
     */
    public function __construct(
        Context $context,
        Config $config,
        array $data = []
    ) {
    	$this->config = $config;
        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function getConfig()
    {
        return $this->config->getstatus();
    }

}