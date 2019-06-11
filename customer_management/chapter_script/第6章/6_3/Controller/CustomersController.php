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
		'limit' => 5,
	);

/**
 * index method
 */
	public function index() {
		$option = array();
		$searchword = array();
		$lasttrade_start = null;
		$lasttrade_end = null;
		if (!empty($this->data) || count($this->passedArgs) > 1) {
			if (!isset($this->request->data['clear'])) {
				/** 検索ボタンをクリックした場合 */
				if (isset($this->request->data['search'])) {
					$searchword = $this->request->data['Customer'];
				} else {
					/** パラメータが検索ワード */
					foreach ($this->passedArgs as $argkey => $argvalue) {
						if ($argkey != 'sort' && $argkey != 'direction' && $argkey != 'page') {
							if ($argkey != 'lasttrade_start' && $argkey != 'lasttrade_end') {
								$searchword[$argkey] = urldecode($argvalue);
							} else {
								$searchword[$argkey]['year'] = urldecode($argvalue['year']);
								$searchword[$argkey]['month'] = urldecode($argvalue['month']);
								$searchword[$argkey]['day'] = urldecode($argvalue['day']);
							}
						}
					}
					/** フォームに値を格納するため、リクエストに代入 */
					$this->request->data['Customer'] = $searchword;
				}

				foreach ($searchword as $search_key => $search_value) {
					if ($search_key != 'sort' && $search_key != 'direction' && $search_key != 'page') {
						if (isset($search_value) && $search_value != '') {
							if (strstr($search_key, '_id')) {
								/** _idを含む場合、完全一致にする */
								$option[$search_key] = $search_value;
							} elseif (strstr($search_key, 'lasttrade')) {
								/** 日付の検索 */
								$year = strval($search_value['year']);
								$month = strval($search_value['month']);
								$day = strval($search_value['day']);

								if (!empty($year) && !empty($month) && !empty($day)) {
									/** 日付が存在するか確認 */
									if (checkdate($month, $day, $year)) {
										if(strstr($search_key, '_start')) {
											$lasttrade_start = $year.'-'.$month.'-'.$day;
										} elseif(strstr($search_key, '_end')) {
											$lasttrade_end = $year.'-'.$month.'-'.$day;
										}
									}
								}
							} else {
								/** その他の項目は部分一致 */
								$option[$search_key.' LIKE'] = "%{$search_value}%";
							}
						}
					}
				}
				/** 開始日と終了日を検索する */
				if ($lasttrade_start || $lasttrade_end) {
					if ($lasttrade_start == null) {
						$lasttrade_start = date('Y')-100 .'-'. date('m') .'-'. date('d');
					}
					if ($lasttrade_end == null) {
						$lasttrade_end = date('Y')+100 .'-'. date('m') .'-'. date('d');
					}
					$option['lasttrade BETWEEN ? AND ?'] = array($lasttrade_start, $lasttrade_end);
				}
			} else {
				/** 検索内容のクリア */
				$this->redirect(array('action' => 'index'));
			}
		}

		/** 都道府県情報を取得する */
		$prefectures = $this->Prefecture->find('all');
		/** プルダウン用にデータを整える */
		$prefectures = set::Combine(
			$prefectures,
			'{n}.Prefecture.id',
			'{n}.Prefecture.pref_name'
		);

		/** テンプレートに出力 */
		$this->set('searchword', $searchword);
		$this->set('prefectures', $prefectures);
		$this->set('customers', $this->paginate($option));
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

/**
 * edit method
 */
	public function edit($id = null) {
		$this->Customer->id = $id;
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Customer->save($this->request->data)) {
				$this->Session->setFlash(__('顧客の登録に成功しました。'), 'Flash/success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('顧客の登録に失敗しました。'));
			}
		} else {
			$this->request->data = $this->Customer->read(null, $id);
		}
		/** 会社情報を取得する */
		$companies = $this->Company->find('all');
		/** プルダウン用にデータを整える */
		$companies = set::Combine($companies, '{n}.Company.id', '{n}.Company.company_name');

		/** 都道府県情報を取得する */
		$prefectures = $this->Prefecture->find('all');
		/** プルダウン用にデータを整える */
		$prefectures = set::Combine(
			$prefectures,
			'{n}.Prefecture.id',
			'{n}.Prefecture.pref_name'
		);

		/** Viewに値を渡す */
		$this->set('company', $companies);
		$this->set('prefectures', $prefectures);
	}

/**
 * delete method
 */
	public function delete($id = null) {
		$this->Customer->id = $id;
		if (!$this->Customer->exists()) {
			throw new NotFoundException(__('Invalid customer'));
		}
		if ($this->Customer->delete()) {
			$this->Session->setFlash(__('顧客を削除しました。'), 'Flash/success');
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('顧客の削除に失敗しました。'));
		$this->redirect(array('action' => 'index'));
	}
}
