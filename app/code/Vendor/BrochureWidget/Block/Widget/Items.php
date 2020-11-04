<?php

namespace Vendor\BrochureWidget\Block\Widget;

use Magento\Framework\View\Element\Template;
use Magento\Widget\Block\BlockInterface;

class Items extends Template implements BlockInterface
{

    protected $_template = "widget/items.phtml";
    protected $_resourceConnection;

  	public function __construct(
      \Magento\Framework\App\ResourceConnection $resourceConnection,
      Template\Context $context,
      array $data = []
    ){
      $this->_resourceConnection = $resourceConnection;
      parent::__construct($context, $data);
    }
    
    public function getBrochure()
    {
      $id = $this->getData('brochure');
      
      $connection = $this->_resourceConnection->getConnection();
      $tableName = $this->_resourceConnection->getTableName('CUSTOM_TABLE_NAME_HERE');
      //change "row_id" with the entity id of your custom table
      $sql = $connection->select()->from($tableName)->where('row_id = ?', $id);
      $items = $connection->fetchAll($sql);
      
      return $items;
    }
  
 }   
