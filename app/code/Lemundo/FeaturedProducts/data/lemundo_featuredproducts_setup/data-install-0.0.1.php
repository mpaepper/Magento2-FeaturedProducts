<?php

/** @var $installer \Magento\Catalog\Model\Resource\Setup */
$installer = $this;

$installer->startSetup();

$installer->addAttribute(
    \Magento\Catalog\Model\Product::ENTITY,
    'lemundo_featured_product',
    [
        'type' => 'int',
        'backend' => '',
        'frontend' => '',
        'label' => 'Is Featured Product',
        'input' => 'select',
        'class' => '',
        'source' => 'Magento\Eav\Model\Entity\Attribute\Source\Boolean',
        'global' => \Magento\Catalog\Model\Resource\Eav\Attribute::SCOPE_GLOBAL,
        'visible' => true,
        'required' => false,
        'user_defined' => true,
        'default' => '0',
        'searchable' => false,
        'filterable' => false,
        'comparable' => false,
        'visible_on_front' => false,
        'used_in_product_listing' => true,
        'unique' => false,
        'group' => 'Product Details'
    ]
);

$installer->endSetup();