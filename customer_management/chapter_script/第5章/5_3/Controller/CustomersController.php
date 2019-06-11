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
}