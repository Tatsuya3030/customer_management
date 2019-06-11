<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {
/**
 * Module name
 *
 */
	public $name = 'Users';

/**
 * Use Model
 *
 */
	public $uses = array('User');

/**
 * beforeFilter method
 */
	public function beforeFilter() {
		/** ログインしていない時に許可するアクション */
		$this->Auth->autoRedirect = false;
		$this->Auth->allow('login', 'add');
		$this->layout = 'login';
	}

/**
 * login method
 */
	public function login() {
		/** POST送信時にログイン認証処理を行う */
		if ($this->request->is('post')) {
			/** ログイン認証処理 */
			if ($this->Auth->login()) {
				/** 認証後のリダイレクト処理 */
				$this->redirectlogin();
			} else {
				/** 認証エラーメッセージ出力 */
				$this->Session->setFlash(__('ログインに失敗しました。'));
			}
		}else{
			/** ログイン認証済の場合、顧客画面へ遷移 */
			if ($this->Auth->login()) {
				$this->redirectlogin();
			}
		}
	}

/**
 * redirectlogin method
 */
	public function redirectlogin() {
		try {
			/** 顧客一覧ページのURLを格納 */
			$redirectUrl = $this->Auth->redirect();
			/** 顧客一覧ページにリダイレクト */
			$this->redirect($redirectUrl);
		} catch (Exception $e) {
			/** エラー（ログアウト） */
			$this->Auth->logout();
			/** 認証エラーメッセージ出力 */
			$this->Session->setFlash(__('ログインに失敗しました。'));
		}
	}

/**
 * logout method
 */
	public function logout() {
		$this->Session->destroy();
		$this->redirect($this->Auth->logout());
	}

/**
 * index method
 */
	public function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}
	
/**
 * add method
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->User->create();
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 */
	public function edit($id = null) {
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->User->save($this->request->data)) {
				$this->Session->setFlash(__('The user has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->User->read(null, $id);
		}
	}

/**
 * delete method
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->User->id = $id;
		if (!$this->User->exists()) {
			throw new NotFoundException(__('Invalid user'));
		}
		if ($this->User->delete()) {
			$this->Session->setFlash(__('User deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('User was not deleted'));
		$this->redirect(array('action' => 'index'));
	}

}
