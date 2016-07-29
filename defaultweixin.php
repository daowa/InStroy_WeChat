<?php

require 'weixin.class.php';

class DefaultWeixin extends wxmessage {


	public function processRequest($data) {
		// $input is the content that user inputs
		$input = $data->Content;
		// deal with text msg from user
		if ($this->isTextMsg()) {
			switch ($input) {
				case 'subscribe'://new user subscribes
					$this->welcome();
					break;
				case 'Hello2BizUser'://only available before March 26,2013
					$this->welcome();
					break;
				case 'news'://news 
					$this->fulinews();
					break;
				case 'music':
					$this->yishengmusic();
					break;
				case 'joke':
					$this->xiaohua();
					break;
				default:
					$this->text($input);
					break;
					 
			}
		}
		// deal with geographical location
		elseif ($this->isLocationMsg()) {
			$this->fulinews();
		} elseif ($this->isImageMsg()) {
			$this->fulinews();
		} elseif ($this->isLinkMsg()) {
			$this->fulinews();
		}
		//判断并处理事件推送
		else if($this->isEventMsg()){
			switch($data->Event){
				case 'subscribe':
					$this->text("欢迎使用集游册:)\r\n\r\n根据您所在的地理位置，您现在所在的景点是：\r\n华师大\r\n\r\n您可以点击“自助游玩”→“更换景区”更改所在景区，或者点击以下链接进行更改：\r\n<a href=\"http://www.bilibili.com\">更换景区</a>");
				case 'CLICK':
					$this->click($data);
					break;
			}
		}
		else {
		}
	}

	 
	/**
	 * return news
	 */
	private function fulinews() {
		$text = 'QQ榛勯捇銆佽摑閽汇�佺孩閽汇�佺豢閽绘垨10Q甯佷换閫夊叾涓�';
		$posts = array(
				array(
						'title' => '退役当教练，圆梦西雅图',
						'discription' => $text,
						'picurl' => 'http://img2.imgtn.bdimg.com/it/u=2577400875,2279098005&fm=21&gp=0.jpg',
						'url' => 'http://www.bilibili.com',
				)
		);
		$xml = $this->outputNews($posts);
		header('Content-Type: application/xml');
		echo $xml;
	}

	/**
	 * return text
	 */
	private function text($text) {
		$xml = $this->outputText($text);
		header('Content-Type: application/xml');
		echo $xml;
	}

	/**
	 * return jokes
	 */
	private function xiaohua() {
		$text = "浣犲ソ锛屼翰鐖辩殑鏈嬪弸锛屾垜鍙兘涓嶅湪鐢佃剳鏃併�傚厛鐪嬩釜绗戣瘽鍚с�傛湁涓皬濮戝绌夸簡涓�浠剁櫧鑹插ぇ琛ｅ湪绛夎溅锛屼竴涓唺瀛╁瓙鎶婂阀鍏嬪姏闆硶鏁翠釜鎷嶅ス韬笂浜嗭紝瀛╁瓙浠栧璇村涓嶈捣瀛╁瓙寰堢毊锛屽濞樿共涓嬭韩鍜岃敿鐨勮锛氬皬鏈嬪弸锛屾垜浠媺閽╋紝浠ュ悗璋佸湪澶ч┈璺笂鐬庨椆璋佸氨姝诲叏瀹跺ソ涓嶅ソ锛熷瀛愪粬濡堝悡灏夸簡~";
		$xml = $this->outputText($text);
		header('Content-Type: application/xml');
		echo $xml;
	}

	/**
	 * return welcome msg
	 */
	private function welcome() {
		$text = "浜茬埍鐨勬湅鍙嬶紝娆㈣繋鍏虫敞鍏斿瓙銆傚洖澶嶁�渘ews鈥濈湅鐪嬪厰瀛愮殑10鍏僎甯佸皬绀煎惂銆�";
		// outputText 鐢ㄦ潵杩斿洖鏂囨湰淇℃伅
		$xml = $this->outputText($text);
		header('Content-Type: application/xml');
		echo $xml;
	}

	private function music() {
		$music = array(
				'title' => '鍦ㄦ槬澶╅噷',
				'discription' => '鍦ㄦ槬澶╅噷-姹嘲',
				'musicurl' => 'http://rubyeye-rubyeye.stor.sinaapp.com/inspring.wma',
				'hdmusicurl' => 'http://rubyeye-rubyeye.stor.sinaapp.com/inspring.mp3'
		);
		$xml = $this->outputMusic($music);
		//sae_log($xml);
		header('Content-Type: application/xml');
		echo $xml;
	}

	private function yishengmusic() {
		$music = array(
				'title' => '涓�鐢熸墍鐖�',
				'discription' => '涓轰粈涔堥�夎繖棣栨瓕鍛紵鍥犱负鎴戠殑姊︽兂鏄笌涓�鐢熸墍鐖辩殑浜哄揩涔愪竴鐢熴�備綘鐨勫憿锛屼翰鐖辩殑鏈嬪弸锛�',
				'musicurl' => 'http://rubyeye-rubyeye.stor.sinaapp.com/song/%E5%8D%A2%E5%86%A0%E5%BB%B7-%E4%B8%80%E7%94%9F%E6%89%80%E7%88%B1.mp3',
				'hdmusicurl' => 'http://rubyeye-rubyeye.stor.sinaapp.com/song/%E5%8D%A2%E5%86%A0%E5%BB%B7-%E4%B8%80%E7%94%9F%E6%89%80%E7%88%B1.mp3'
		);
		$xml = $this->outputMusic($music);
		header('Content-Type: application/xml');
		echo $xml;
	}

	/**
	 * 分类处理点击事件
	 * @param type $data 微信消息体
	 */
	private function click($data){
		$eventKey = $data->EventKey;
		switch($eventKey){
			case 'V142857_NearSpot':
				$this->MenuNearSpot();
				break;
			case 'V142857_NearStory':
				$this->MenuNearStory();
				break;
			case 'V142857_RecommendLine':
				$this->MenuRecommendLine();
				break;
			case 'V142857_Announcement':
				$this->MenuAnnouncement();
				break;
		}
	}

	//点击菜单中的“附近景点”
	private function MenuNearSpot(){
		$posts = array(
				array(
						'title' => '【大天后宫】前身为明朝宁靖王府邸',
						'discription' => '不知道这东西在哪显示',
						'picurl' => 'http://file111.mafengwo.net/s7/M00/4A/7D/wKgB6lTy05CAGy9mABktAObr9sw29.jpeg?imageView2%2F2%2Fw%2F1920%2Fh%2F9999%2Fq%2F90',
						'url' => 'http://instory.applinzi.com/web/SpotList/SpotDetail.php',
				),
				array(
						'title' => '【赤崁楼】郑成功时期全岛最高行政机构',
						'discription' => '不知道这东西在哪显示',
						'picurl' => 'http://file30.mafengwo.net/M00/76/51/wKgBpVXPPfuAfn7dAAtGd8uGorI85.mdd.w250.jpeg',
						'url' => 'http://instory.applinzi.com/web/SpotList/SpotDetail.php',
				),
				array(
						'title' => '【安平老街】荷兰人所建街道，是台南少有的西式旧建筑',
						'discription' => '不知道这东西在哪显示',
						'picurl' => 'http://file31.mafengwo.net/M00/8E/38/wKgBs1aJalWAN2qMABN35o_DqcE33.mdd.w250.jpeg',
						'url' => 'http://instory.applinzi.com/web/SpotList/SpotDetail.php',
				),
				array(
						'title' => '【安平古堡】安平夕照是最美的旧“台湾八景”之一',
						'discription' => '不知道这东西在哪显示',
						'picurl' => 'http://file30.mafengwo.net/M00/61/21/wKgBpVW9u4-AfNbEABIYNrDL0rQ07.mdd.w250.jpeg',
						'url' => 'http://instory.applinzi.com/web/SpotList/SpotDetail.php',
				),
				array(
						'title' => '【花园夜市】台南最大的综合夜市，吃喝玩乐一应俱全',
						'discription' => '不知道这东西在哪显示',
						'picurl' => 'http://file29.mafengwo.net/M00/73/9C/wKgBpVXF73CAQtI3AA6qtlPmFNw37.rbook_comment.w200.jpeg',
						'url' => 'http://instory.applinzi.com/web/SpotList/SpotDetail.php',
				)
		);
		$xml = $this->outputNews($posts);
		header('Content-Type: application/xml');
		echo $xml;
	}
	
	//点击菜单中的“附近故事”
	private function MenuNearStory(){
		$posts = array(
				array(
						'title' => '三十天走遍美国',
						'picurl' => 'http://img2.imgtn.bdimg.com/it/u=875101194,90095390&fm=11&gp=0.jpg',
						'url' => 'http://instory.applinzi.com/web/SpotList/StoryDetail.php',
				),
				array(
						'title' => '七天学会英语',
						'picurl' => 'http://img4.imgtn.bdimg.com/it/u=3465674042,1628308734&fm=21&gp=0.jpg',
						'url' => 'http://instory.applinzi.com/web/SpotList/StoryDetail.php',
				),
				array(
						'title' => 'java从入门到精通',
						'picurl' => 'http://img4.imgtn.bdimg.com/it/u=3138304874,3977545554&fm=21&gp=0.jpg',
						'url' => 'http://instory.applinzi.com/web/SpotList/StoryDetail.php',
				),
				array(
						'title' => 'c++从入门到放弃',
						'picurl' => 'http://img1.imgtn.bdimg.com/it/u=638799363,2449663312&fm=21&gp=0.jpg',
						'url' => 'http://instory.applinzi.com/web/SpotList/StoryDetail.php',
				),
				array(
						'title' => 'python真好用',
						'discription' => '不知道这东西在哪显示',
						'picurl' => 'http://img5.imgtn.bdimg.com/it/u=2690817382,2844461393&fm=21&gp=0.jpg',
						'url' => 'http://instory.applinzi.com/web/SpotList/StoryDetail.php',
				)
		);
		$xml = $this->outputNews($posts);
		header('Content-Type: application/xml');
		echo $xml;
	}

	//点击菜单中的“推荐线路”
	private function MenuRecommendLine(){
		$posts = array(
				array(
						'title' => '【美食路线】宽窄巷子 → 武侯祠 → 锦里',
						'discription' => '不知道这东西在哪显示',
						'picurl' => 'http://file29.mafengwo.net/M00/DB/EC/wKgBpVWosLaAO4DuAAGtkNDLhxE37.mdd.w250.jpeg',
						'url' => 'http://instory.applinzi.com/web/RecommendLine/RecommendLine.php',
				),
				array(
						'title' => '【旧址路线】金沙遗址博物馆 → 杜甫草堂 → 青羊宫 → 九眼桥',
						'discription' => '不知道这东西在哪显示',
						'picurl' => 'http://file31.mafengwo.net/M00/A3/E2/wKgBs1ZJTM6ACFMiADFuNhZNmOE89.mdd.w250.jpeg',
						'url' => 'http://instory.applinzi.com/web/RecommendLine/RecommendLine.php',
				),
				array(
						'title' => '【自然路线】丽宁十八弯观景台 → 泸沽湖观景台 → 大落水码头 → 洛克岛 → 里格岛',
						'discription' => '不知道这东西在哪显示',
						'picurl' => 'http://file27.mafengwo.net/M00/9A/4A/wKgB6lT5I9mATCa9AAgTc5eEcz800.mdd.w250.jpeg',
						'url' => 'http://instory.applinzi.com/web/RecommendLine/RecommendLine.php',
				)
		);
		$xml = $this->outputNews($posts);
		header('Content-Type: application/xml');
		echo $xml;
	}

	//点击菜单中的“景区公告”
	private function MenuAnnouncement(){
		$posts = array(
				array(
						'title' => '【活动】时过境迁，找寻老照片中的金陵旧影',
						'discription' => '不知道这东西在哪显示',
						'picurl' => 'http://cdn.sinacloud.net/picture.instory.com/photo/old.jpg?KID=sina,2dieczkaBHVelyldaa1V&Expires=1468915220&ssig=i1y6kTEEjO',
						'url' => 'http://mp.weixin.qq.com/s?__biz=MzA3OTkxNDg3OA==&mid=2651335669&idx=1&sn=7e11a2e04e971fb835c2e13c50b104a9&scene=0#wechat_redirect',
				),
				array(
						'title' => '【讲座】民国时代的另一种上海——“吴作人展”介绍',
						'discription' => '不知道这东西在哪显示',
						'picurl' => 'http://cdn.sinacloud.net/picture.instory.com/photo/d7df3f12df8f5a0.jpg?KID=sina,2dieczkaBHVelyldaa1V&Expires=1468915628&ssig=uX%2B5nFgXec',
						'url' => 'http://mp.weixin.qq.com/s?__biz=MjM5MDQ5OTMxNA==&mid=2657293210&idx=2&sn=32f96946044bb5253b9dadd67c818f1d&scene=0#wechat_redirect',
				),
				array(
						'title' => '【展览】唤醒！消失的印记——宫藏陆元敏、海原修平摄影',
						'discription' => '不知道这东西在哪显示',
						'picurl' => 'http://cdn.sinacloud.net/picture.instory.com/photo/1325465665347490060.jpg?KID=sina,2dieczkaBHVelyldaa1V&Expires=1468915738&ssig=A1%2B0WwXFj1',
						'url' => 'http://mp.weixin.qq.com/s?__biz=MjM5MDQ5OTMxNA==&mid=2657292982&idx=1&sn=7176b5435340734a9f4b0badbab8ca5d&scene=0#wechat_redirect',
				)
		);
		$xml = $this->outputNews($posts);
		header('Content-Type: application/xml');
		echo $xml;
	}

	/**
	 * Pre processing锛宑ommon usage:save the request into your database.
	 * Because weixin save your msgs only 5 days.
	 * @return boolean
	 */
	protected function beforeProcess($postData) {

		return true;
	}

	protected function afterProcess() {
	}

	public function errorHandler($errno, $error, $file = '', $line = 0) {
		$msg = sprintf('%s - %s - %s - %s', $errno, $error, $file, $line);
	}

	public function errorException(Exception $e) {
		$msg = sprintf('%s - %s - %s - %s', $e->getCode(), $e->getMessage(), $e->getFile(), $e->getLine());
	}

	private function saveRequest($request) {

	}

}




