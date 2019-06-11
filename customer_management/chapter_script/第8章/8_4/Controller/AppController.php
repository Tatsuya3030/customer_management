<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/** OAuthプラグイン読込 */
App::import('Vendor', 'OAuth/OAuthClient');

/** Facebookプラグイン読込 */
App::import('Vendor', 'facebook/facebook');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
/**
 * Helpers
 *
 */
	public $helpers = array(
		'Html',
		'Form',
		'Session',
		'Number',
	);

/**
 * Components
 *
 */
	public $components = array(
		'Session',
		'Auth' => array(
			'loginRedirect' => array(
				'controller' => 'customers',
				'action' => 'index'
			),
			'logoutRedirect' => array(
				'controller' => 'users',
				'action' => 'login'
			),
			'loginAction' => array(
				'controller' => 'users',
				'action' => 'login'
			)
		),
		'RequestHandler',
	);

/**
 * Twitterインスタンス格納用
 */
	public $Twitter = null;

/**
 * Twitterアクセストークン格納用
 */
	public $accessToken = null;

/**
 * Facebookインスタンス格納用
 */
	public $Facebook = null;


/**
 * setTwitterid method
 */
	public function setTwitterid($appId, $secret) {
		if (!empty($appId) && !empty($secret)) {
			/** TwitterのOAuthClientインスタンスを格納 */
			$twitter = new OAuthClient(
				$appId,
				$secret
			);
			$this->Twitter = $twitter;
			/** セッションにTwitter情報を格納 */
			$this->Session->write('twitter', $twitter);
		} else{
			$this->Twitter = null;
		}
	}

/**
 * setFacebookid method
 */
	public function setFacebookid($appId, $secret) {
		if (!empty($appId) && !empty($secret)) {
			/** Facebookインスタンスを格納 */
			$facebook = new Facebook(array(
				'appId' => $appId,
				'secret' => $secret,
				'cookie'=>true
			));
			$this->Facebook = $facebook;
			/** セッションにFacebook情報を格納 */
			$this->Session->write('facebook', $facebook);
		} else{
			$this->Facebook = null;
		}
	}

/**
 * beforeFilter method
 */
	public function beforeFilter() {
		/** セッションを取得してメンバ変数に格納 */
		if ($this->Session->check('twitter')) {
			$this->Twitter = $this->Session->read('twitter');
		}
		if ($this->Session->check('twitter_accessToken')) {
			$this->accessToken = $this->Session->read('twitter_accessToken');
		}
		if ($this->Session->check('facebook')) {
			$this->Facebook = $this->Session->read('facebook');
		}
	}

}
