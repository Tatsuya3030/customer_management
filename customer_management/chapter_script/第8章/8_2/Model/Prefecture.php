<?php
App::uses('AppModel', 'Model');

/**
 * Prefecture Model
 *
 * @property Customer $Customer
 */
class Prefecture extends AppModel {
/**
 * hasMany associations
 *
 */
	public $hasMany = array(
		'Customer' => array(
			'className' => 'Customer',
			'foreignKey' => 'prefecture_id',
			'dependent' => false,
		)
	);
}
