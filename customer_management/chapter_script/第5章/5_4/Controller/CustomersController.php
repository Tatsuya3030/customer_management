<?php
App::uses('AppController', 'Controller');
/**
 * Customers Controller
 *
 * @property Customer $Customer
 */
class CustomersController extends AppController {
/**
 * Module name
 *
 */
	public $name = 'Customers';

/**
 * Use Model
 *
 */
	public $uses = array(
		'Customer',
		'Company',
		'Prefecture',
	);

/**
 * Paginate setting
 *
 */
	public $paginate = array(
		'order' => 'Customer.customer_cd ASC',
	);

/**
 * index method
 */
	public function index() {
		$this->set('customers', $this->paginate());
	}

/**
 * add method
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Customer->create();
			if ($this->Customer->save($this->request->data)) {
				$this->Session->setFlash(__('顧客の登録に成功しました。'), 'Flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('顧客の登録に失敗しました。'));
			}
		}
		/** 会社情報を取得する */
		$companies = $this->Company->find('all');
		/** プルダウン用にデータを整える */
		$companies = set::Combine($companies, '{n}.Company.id', '{n}.Company.company_name');

		/** 都道府県情報を取得する */
		$prefectures = $this->Prefecture->find('all');
		/** プルダウン用にデータを整える */
		$prefectures = set::Combine($prefectures, '{n}.Prefecture.id', '{n}.Prefecture.pref_name');

		/** テンプレートに出力 */
		$this->set('company', $companies);
		$this->set('prefectures', $prefectures);
	}
}
