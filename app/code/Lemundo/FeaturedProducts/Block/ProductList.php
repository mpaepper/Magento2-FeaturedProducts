<?php

namespace Lemundo\FeaturedProducts\Block;

/**
 * Get featured products collection
 *
 * @category   Lemundo
 * @package    Lemundo_FeaturedProducts
 * @author     Lemundo GmbH [mt]
 */
class ProductList extends \Magento\Catalog\Block\Product\AbstractProduct {

    /**
     * Product collection model
     *
     * @var Magento\Catalog\Model\Resource\Product\Collection
     */
    protected $_collection;


    /**
     * System configuration values
     *
     * @var array
     */
    protected $_config;


    /**
     * Image helper
     *
     * @var Magento\Catalog\Helper\Image
     */
    protected $_imageHelper;


    /**
     * Initialize
     *
     * @param Magento\Catalog\Block\Product\Context $context
     * @param Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param array $data
     */
    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Catalog\Model\Resource\Product\Collection $collection,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Catalog\Helper\Image $imageHelper,
        array $data = []
    ) {
        // $this->_objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $this->_collection = $collection;
        $this->_config = $scopeConfig->getValue('featured_products/settings');
        $this->_imageHelper = $imageHelper;

        parent::__construct($context, $data);
    }


    /**
     * Get product collection
     */
    public function getProducts() {
        $limit = $this->getProductLimit();

        $collection = $this->_collection
                           ->addMinimalPrice()
                           ->addFinalPrice()
                           ->addTaxPercents()
                           ->addAttributeToSelect('name')
                           ->addAttributeToSelect('image')
                           ->addAttributeToFilter('is_saleable', 1, 'left')
                           ->addAttributeToFilter('lemundo_featured_product', 1, 'left');

        $collection->getSelect()
                   ->order('rand()')
                   ->limit($limit);

        return $collection;
    }


    /**
     * Get image helper
     */
    public function getImageHelper() {
        return $this->_imageHelper;
    }


    /**
     * Get module configuration
     */
    public function getConfig() {
        return $this->_config;
    }

    /**
     * Get the configured limit of products
     * @return int
     */
    public function getProductLimit() {
        return $this->_config["limit"];
    }
    
    /**
     * Get the configured width of images
     * @return int
     */
    public function getImageWidth() {
        return $this->_config["image_width"];
    }
    
}