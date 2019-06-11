<?php
App::uses('AppModel', 'Model');

/**
 * Customer Model
 *
 * @property Company $Company
 * @property Prefecture $Prefecture
 */
class Customer extends AppModel {
/**
 * belongsTo associations
 *
 */
	public $belongsTo = array(
		'Company' => array(
			'className' => 'Company',
			'foreignKey' => 'company_id',
			'conditions' => '',
			'fields' => 'id, company_name',
			'order' => ''
		),
			'Prefecture' => array(
			'className' => 'Prefecture',
			'foreignKey' => 'prefecture_id',
			'conditions' => '',
			'fields' => 'id, pref_name',
			'order' => ''
		),
	);
}