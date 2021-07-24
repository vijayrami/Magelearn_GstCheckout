<?php
namespace Magelearn\GstCheckout\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;
use Magento\Quote\Model\QuoteRepository;

class SalesModelServiceQuoteSubmitBefore implements ObserverInterface
{
	/**
     * @var \Magento\Framework\DataObject\Copy
     */
    protected $objectCopyService;
    /**
     * @var QuoteRepository
     */
    private $quoteRepository;
	
    /**
     * SalesModelServiceQuoteSubmitBefore constructor.
     *
     * @param QuoteRepository $quoteRepository
     * @param Validator $validator
     */
     /**
     * @param \Magento\Framework\DataObject\Copy $objectCopyService
     */
    public function __construct(
        QuoteRepository $quoteRepository,
        \Magento\Framework\DataObject\Copy $objectCopyService
    ) {
        $this->quoteRepository = $quoteRepository;
		$this->objectCopyService = $objectCopyService;
    }

    /**
     * @param EventObserver $observer
     * @return $this
     * @throws \Exception
     */
    public function execute(EventObserver $observer)
    {
		/** @var \Magento\Sales\Model\Order $order */
        $order = $observer->getEvent()->getData('order');
        /** @var \Magento\Quote\Model\Quote $quote */
        $quote = $observer->getEvent()->getData('quote');
		
		$order->setGstNumber($quote->getGstNumber());
        
		$this->objectCopyService->copyFieldsetToTarget('sales_convert_quote', 'to_order', $quote, $order);

        return $this;
    }
}