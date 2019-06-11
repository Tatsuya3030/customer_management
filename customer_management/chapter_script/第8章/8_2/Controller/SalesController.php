<?php
App::uses('AppController', 'Controller');

/** HelperをControllerで使用する */
App::import('Helper', 'Tcpdf');

/**
 * Sales Controller
 *
 */
class SalesController extends AppController {
/**
 * Helpers
 *
 */
	public $helpers = array('Tcpdf');

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

/**
 * pdf method
 */
	public function pdf() {
		/** PDF出力ヘッダー */
		$this->response->type('pdf');
		$this->layout = false;
		
		/** バーチャルフィールドを使用し、個数*単価=金額を取得 */
		$this->Sale->virtualFields = array('money' => '(Sale.amount * Product.unit_price)');

		/** 取得順序を設定 */
		$this->paginate = array('order' => 'Sale.money DESC');

		/** テンプレートに出力 */
		$this->set('sales', $this->paginate());
	}

}
