<?php
App::uses('AppModel', 'Model');

/**
 * Company Model
 *
 * @property Customer $Customer
 */
class Company extends AppModel {
/**
 * hasMany associations
 *
 */
	public $hasMany = array(
		'Customer' => array(
			'className' => 'Customer',
			'foreignKey' => 'company_id',
			'dependent' => false,
		)
	);
}
