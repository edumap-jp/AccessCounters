<?php
/**
 * AccessCounter::getAccessCounterFrameSetting()のテスト
 *
 * @property AccessCounter $AccessCounter
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('NetCommonsGetTest', 'NetCommons.TestSuite');

/**
 * AccessCounterFrameSetting::getAccessCounterFrameSetting()のテスト
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\AccessCounters\Test\Case\Model\AccessCounter
 */
class AccessCounterFrameSettingGetAccessCounterFrameSettingTest extends NetCommonsGetTest {

/**
 * Plugin name
 *
 * @var array
 */
	public $plugin = 'access_counters';

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.access_counters.access_counter',
		'plugin.access_counters.access_counter_frame_setting',
	);

/**
 * Model name
 *
 * @var array
 */
	protected $_modelName = 'AccessCounterFrameSetting';

/**
 * Method name
 *
 * @var array
 */
	protected $_methodName = 'getAccessCounterFrameSetting';

/**
 * Getのテスト
 *
 * @param bool  $created 生成フラグ
 * @param array $exist 取得するキー情報
 * @param array $expected 期待値（取得したキー情報）
 * @dataProvider dataProviderGet
 *
 * @return void
 */
	public function testGet($created, $exist, $expected) {
		$model = $this->_modelName;
		$method = $this->_methodName;

		//事前準備
		$testCurrentData = Hash::expand($exist);
		Current::$current = Hash::merge(Current::$current, $testCurrentData);

		//テスト実行
		$result = $this->$model->$method($created);
		if (empty($result)) {//Createしないとき
			$this->assertEquals($result, $expected);
		} else {
			foreach ($expected as $key => $val) {
				$this->assertEquals($result[$model][$key], $val);
			}
		}
	}

/**
 * getのDataProvider
 *
 * #### 戻り値
 *  - bool  生成フラグ($created)
 *  - array 取得するキー情報
 *  - array 期待値 （取得したキー情報）
 *
 * @return array
 */
	public function dataProviderGet() {
		$existData = array('Frame.key' => 'frame_1'); // データあり
		$notExistData = array('Frame.key' => 'frame_xxx'); // データなし

		return array(
			array(true, $existData, array( 'id' => '1' )),
			array(false, $existData, array( 'id' => '1' )),
			array(true, $notExistData, array( 'frame_key' => 'frame_xxx' )),
			array(false, $notExistData, array()),
		);
	}

}
