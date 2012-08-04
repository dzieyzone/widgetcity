<?php
class MultiProductEditor {
	public $p;

	function __construct($obj) {
		$this->p = json_decode($obj);				
	}

	function update() {
		foreach ($this->p as $item) {
		  $ret = db_query("UPDATE {uc_products} SET 
				model = '%s',
				list_price = %f,
				cost = %f,
				sell_price = %f,
				shippable = %d,
				weight = %f,
				length = %f,
				width = %f,
				height = %f 
				WHERE vid = %d",
				$item->sku,
				$item->listprice,
				$item->cost,
				$item->sellprice,
				$item->shippable,
				$item->weight,
				$item->length,
				$item->width,
				$item->height,
				$item->vid);
			if ($ret){
				drupal_set_message(t('Product has been updated.'));
			}
			else {
				drupal_set_message(t('Failed to save data.'));
			}
		}
	}
}
?>