<?php
App::uses('AppController', 'Controller');
/**
 * Datatotals Controller
 *
 */
class DatatotalsController extends AppController {
/**
 * Use Model
 *
 */
	public $uses = array(
		'BusinessCategory',
		'Sale',
		'Customer',
		'Product',
		'Company'
	);

/**
 * industry method
 */
	public function industry() {
		/** バーチャルフィールドを使用し、副問い合わせ */
		$this->BusinessCategory->virtualFields = array(
			'customer_count' => 'COUNT(`Customer`.`name`)');
		
		/** 会社テーブルを結合 */
		$options = array(
			'conditions' => '',
			'fields' => '',
			'order' => 'BusinessCategory.customer_count DESC, `BusinessCategory`.`id`',
			'group' => 'BusinessCategory.id',
			'joins' => array(
				array('type' => 'LEFT',
					'table' => 'companies',
					'alias' => 'Company',
					'conditions' => '`BusinessCategory`.`id`=`Company`.`business_category_id`',
				),
				array('type' => 'LEFT',
					'table' => 'customers',
					'alias' => 'Customer',
					'conditions' => '`Company`.`id`=`Customer`.`company_id`',
				)
			)
		);

		/** 業種情報/顧客数を取得する */
		$businesscategories = $this->BusinessCategory->find('all',$options);
		/** テンプレートに出力 */
		$this->set('businesscategories', $businesscategories);
	}

/**
 * ranking method
 */
	public function ranking() {
		/** バーチャルフィールドを使用し、個数*単価=金額と個数の合計を取得 */
		$this->Sale->virtualFields = array(
			'money' => 'SUM(Sale.amount * Product.unit_price)',
			'unit_amount' => 'SUM(Sale.amount)'
		);

		/** グループ化と取得順序を設定 */
		$options = array(
			'conditions' => 'GROUP BY Sale.product_id',
			'fields' => '',
			'order' => 'money DESC'
		);

		/** 売上情報を取得する */
		$sales = $this->Sale->find('all', $options);
		/** テンプレートに出力 */
		$this->set('sales', $sales);
	}

/**
 * avg method
 */
	public function avg() {
		/** バーチャルフィールドを使用し、個数*単価=金額の平均を取得 */
		$this->Sale->virtualFields = array(
			'avg' => 'AVG(Sale.amount * Product.unit_price)'
		);

		/** グループ化と取得順序を設定 */
		$options = array(
			'conditions' => 'GROUP BY Sale.customer_id',
			'fields' => '',
			'order' => 'Sale.customer_id ASC'
		);

		/** 売上情報を取得する */
		$sales = $this->Sale->find('all', $options);
		/** テンプレートに出力 */
		$this->set('sales', $sales);
	}
}
