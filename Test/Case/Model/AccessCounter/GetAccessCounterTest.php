<?php
/**
 * AccessCounter::getAccessCounter()のテスト
 *
 * @property AccessCounter $AccessCounter
 *
 * @author Noriko Arai <arai@nii.ac.jp>
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @link http://www.netcommons.org NetCommons Project
 * @license http://www.netcommons.org/license.txt NetCommons License
 * @copyright Copyright 2014, NetCommons Project
 */

App::uses('AccessCounters', 'AccessCounters.Model');
App::uses('AccessCounterFrameSetting', 'AccessCounters.Model');
App::uses('NetCommonsGetTest', 'NetCommons.TestSuite');

/**
 * AccessCounter::getAccessCounter()のテスト
 *
 * @author Shohei Nakajima <nakajimashouhei@gmail.com>
 * @package NetCommons\AccessCounters\Test\Case\Model\AccessCounter
 */
class AccessCounterGetAccessCounterTest extends NetCommonsGetTest {

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
 * Getのテスト
 *
 * @param array 
 * @dataProvider dataProviderGet
 * @return void
 */
	public function testGet($created, $exist, $expected) {
		//事前準備
		$testCurrentData = Hash::expand($exist);
		Current::$current = Hash::merge(Current::$current, $testCurrentData);

		//テスト実行
		$result = $this->AccessCounter->getAccessCounter($created);
		if (empty($result)) {//Createしないとき
			$this->assertEquals($result, $expected);
		} else {
			foreach ($expected as $key => $val) {
				$this->assertEquals($result['AccessCounter'][$key], $val);
			}
		}
	}

/**
 * getのDataProvider
 *
 * ### 戻り値
 *  - data 取得データ
 *
 * @return void
 */
	public function dataProviderGet() {
		$existData = array('Block.key' => 'block_1', 'Block.room_id' => '1'); // データあり
		$notExistData = array('Block.key' => 'block_xxx', 'Block.room_id' => '4'); // データなし

		return array(
			array(true, $existData, array( 'id' => '1' )),
			array(false, $existData, array( 'id' => '1' )),
			array(true, $notExistData, array( 'block_key' => 'block_xxx' )),
			array(false, $notExistData, array()),
		);
	}

}
