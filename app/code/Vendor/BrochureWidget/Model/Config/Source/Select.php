<?php

namespace Vendor\BrochureWidget\Model\Config\Source;

class Select implements \Magento\Framework\Option\ArrayInterface
{
    protected $_resourceConnection;

    public function __construct(
      \Magento\Framework\App\ResourceConnection $resourceConnection
    ){
      $this->_resourceConnection = $resourceConnection;
    }

    public function toOptionArray()
    {
        $output = [];
        array_push($output,['value' => '', 'label' => __('Select')]);
        $connection = $this->_resourceConnection->getConnection();

        $table = $this->_resourceConnection->getTableName('CUSTOM_TABLE_HERE');
        //CHANGE `is_active` if you don't have it
        $sql = $connection->select()->from($table)->where('is_active = ?', 1);
        $items = $connection->fetchAll($sql);
        foreach($items as $i){
          //CHANGE your `title` and `entity id`
          array_push($output,['value' => $i['row_id'], 'label' => __($i['title'])]);
        }

        return $output;
    }
}
