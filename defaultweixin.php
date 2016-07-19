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
        } elseif ($this->isEventMsg()) {
            
        }
        //判断并处理事件推送
        else if($this->isEventMsg()){
        	switch($data->Event){
        		case 'subscribe':
        			$this->text("hi");
        		case 'Click':
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
                'title' => '福利来了',
                'discription' => $text,
                'picurl' => 'http://mmsns.qpic.cn/mmsns/XWia2Xj7RZ8mhQaESostBicFaX2HjVBbJYKKCBk9PkuicKrSZdfNL7XAw/0',
                'url' => 'http://mp.weixin.qq.com/mp/appmsg/show?__biz=MjM5MDE4Njg2MQ==&appmsgid=10000009&itemidx=1#wechat_redirect',
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
    	$eventKey = $data -> EventKey;
    	switch($eventKEy){
    		case 'V142857_RecommendSpot':
    			$this -> MenuRecommendSpot();
    			break;
    		case 'V142857_RecommendLine':
    			$this -> MenuRecommendLine();
    			break;
    		case 'V142857_Announcement':
    			$this -> MenuAnnouncement();
    			break;
    	}
    }
    
    //点击菜单中的“推荐景点”
    private function MenuRecommendSpot(){
    	$posts = array(
    			array(
    					'title' => '推荐景点',
    					'discription' => '不知道这东西在哪显示',
    					'picurl' => 'http://mmsns.qpic.cn/mmsns/XWia2Xj7RZ8mhQaESostBicFaX2HjVBbJYKKCBk9PkuicKrSZdfNL7XAw/0',
    					'url' => 'http://mp.weixin.qq.com/mp/appmsg/show?__biz=MjM5MDE4Njg2MQ==&appmsgid=10000009&itemidx=1#wechat_redirect',
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
    					'title' => '推荐线路',
    					'discription' => '不知道这东西在哪显示',
    					'picurl' => 'http://mmsns.qpic.cn/mmsns/XWia2Xj7RZ8mhQaESostBicFaX2HjVBbJYKKCBk9PkuicKrSZdfNL7XAw/0',
    					'url' => 'http://mp.weixin.qq.com/mp/appmsg/show?__biz=MjM5MDE4Njg2MQ==&appmsgid=10000009&itemidx=1#wechat_redirect',
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
    					'title' => '时过境迁，找寻老照片中的金陵旧影',
    					'discription' => '不知道这东西在哪显示',
    					'picurl' => 'http://mmsns.qpic.cn/mmsns/XWia2Xj7RZ8mhQaESostBicFaX2HjVBbJYKKCBk9PkuicKrSZdfNL7XAw/0',
    					'url' => 'http://mp.weixin.qq.com/mp/appmsg/show?__biz=MjM5MDE4Njg2MQ==&appmsgid=10000009&itemidx=1#wechat_redirect',
    			),
    			array(
    					'title' => '【讲座】民国时代的另一种上海——“吴作人展”介绍',
    					'discription' => '不知道这东西在哪显示',
    					'picurl' => 'http://mmsns.qpic.cn/mmsns/XWia2Xj7RZ8mhQaESostBicFaX2HjVBbJYKKCBk9PkuicKrSZdfNL7XAw/0',
    					'url' => 'http://mp.weixin.qq.com/mp/appmsg/show?__biz=MjM5MDE4Njg2MQ==&appmsgid=10000009&itemidx=1#wechat_redirect',
    			),
    			array(
    					'title' => '【展览】唤醒！消失的印记——宫藏陆元敏、海原修平摄影',
    					'discription' => '不知道这东西在哪显示',
    					'picurl' => 'http://mmsns.qpic.cn/mmsns/XWia2Xj7RZ8mhQaESostBicFaX2HjVBbJYKKCBk9PkuicKrSZdfNL7XAw/0',
    					'url' => 'http://mp.weixin.qq.com/mp/appmsg/show?__biz=MjM5MDE4Njg2MQ==&appmsgid=10000009&itemidx=1#wechat_redirect',
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




