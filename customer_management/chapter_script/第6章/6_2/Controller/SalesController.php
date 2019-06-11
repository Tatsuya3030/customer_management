<?php
App::uses('AppController', 'Controller');
/**
 * Sales Controller
 *
 */
class SalesController extends AppController {
/**
 * Use Model
 *
 */
	public $uses = array(
		'Sale',
		'Customer',
		'Company',
		'Product'
	);

/**
 * index method
 */
	public function index() {
		/** バーチャルフィールドを使用し、個数*単価=金額を取得させる */
		$this->Sale->virtualFields = array('money' => '(Sale.amount * Product.unit_price)');

		/** 取得順序を設定 */
		$this->paginate = array('order' => 'Sale.money DESC');

		/** テンプレートに出力 */
		$this->set('sales', $this->paginate());
	}
}
