<?php
App::uses('AppHelper', 'View/Helper');
/** Tcpdfを使用する */
App::import('Vendor', 'tcpdf/tcpdf');

/**
 * Tcpdf Helper
 */
class TcpdfHelper extends AppHelper {
	public $helpers = array();
	public $pdf;

/**
 * constructor method
 */
	function __construct($view, $options = null) {
		/** デフォルトの設定 */
		$defaults = array(
			'orientation' => 'L',
			'unit' => 'mm',
			'format' => 'A4',
			'unicode' => true,
			'encoding' => 'UTF-8'
		);

		/** オプションが設定されていた場合、オプションを使用する */
		$options = (is_array($options)) ? am($defaults, $options) : $defaults;
		extract(am($defaults, $options));

		/** Tcpdfのコンストラクタを起動 */
		$this->pdf = new TCPDF($orientation, $unit, $format, $unicode, $encoding);
	}
}
?>
