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

		/** キャッシュを作成 */
		Cache::write('businesscategories', $businesscategories);
	}

/**
 * industry_graph method
 */
	public function industryGraph() {
		/** pChartを使用する */
		App::import('Vendor', 'pChart/pData');
		App::import('Vendor', 'pChart/pChart');

		/* Cacheに保存された値を読み込む */
		$businesscategories = Cache::read('businesscategories');
		Cache::delete('businesscategories');

		$a = array();
		$b = array();
		foreach ($businesscategories as $businesscategory) {
			array_push($a, $businesscategory['BusinessCategory']['business_category_name']);
			array_push($b, $businesscategory['BusinessCategory']['customer_count']);
		}

		/** pDataインスタンス生成 */
		$pdata = new pData;

		/** データのセット */
		$pdata->AddPoint($b, 'Serie1');
		$pdata->AddPoint($a, 'Serie2');
		$pdata->AddAllSeries();

		/** ラベルの設定 */
		$pdata->SetAbsciseLabelSerie('Serie2');

		/** グラフ初期化 (画像サイズを設定: width, height) */
		$pchart = new pChart(300, 200);

		/** 角の丸い線グラフを描画 */
		$pchart->drawFilledRoundedRectangle(7,7,293,193,5,240,240,240);
		$pchart->drawRoundedRectangle(5,5,295,195,5,230,230,230);
		$pchart->drawFilledCircle(122,102,70,200,200,200);

		/** ラベルに使うFont設定 */
		$pchart->setFontProperties('/var/www/html/cake/app/Vendor/pChart/Fonts/ipagp.ttf', 8);

		/** グラフの配色設定 */
		$pchart->loadColorPalette('/var/www/html/cake/app/Vendor/pChart/Fonts/softtones.txt');

		/** グラフ領域を描画 */
		$pchart->drawBasicPieGraph(
			$pdata->GetData(),
			$pdata->GetDataDescription(),
			120,
			100,
			70,
			PIE_PERCENTAGE,
			255,
			255,
			218
		);

		$pchart->drawPieLegend(
			230,
			15,
			$pdata->GetData(),
			$pdata->GetDataDescription(),
			250,
			250,
			250
		);

		/** グラフをブラウザに描画 */
		$pchart->Stroke();
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
