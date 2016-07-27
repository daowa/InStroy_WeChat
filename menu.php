<?php

require 'weixin.class.php';

$ret=wxcommon::getToken();
$ACCESS_TOKEN=$ret['access_token'];
$menuPostData='{
"button":[
{
"name":"自助游玩",
"sub_button":[
	{
	"type":"click",
	"name":"附近景点",
	"key":"V142857_NearSpot"
	},
	{
	"type":"click",
	"name":"附近故事",
	"key":"V142857_NearStory"
	},
	{
	"type":"view",
	"name":"景区地图",
	"url":"http://instory.applinzi.com/web/Map/Map.php"
	},
	{
	"type":"view",
	"name":"语音导游",
	"url":"http://instory.applinzi.com/web/SelfGuide/SelfGuide.php"
	},
	{
	"type":"click",
	"name":"旅游线路",
	"key":"V142857_RecommendLine"
	}]
},
{
"name":"景区服务",
"sub_button":[
	{
	"type":"click",
	"name":"景区公告",
	"key":"V142857_Announcement"
	},
	{
	"type":"view",
	"name":"景区客服",
	"url":"http://instory.applinzi.com/web/Map/StoryDetail.php"
	},
	{
	"type":"view",
	"name":"真人导游",
	"url":"http://instory.applinzi.com/web/TourGuide/TourGuide.php"
	},
	{
	"type":"view",
	"name":"更换景区",
	"url":"http://instory.applinzi.com/web/ChangeSpot/ChangeSpot.php"
	}]
},
{
"name":"景点互动",
"sub_button":[
	{
	"type":"view",
	"name":"最美照片",
	"url":"http://instory.applinzi.com/web/Picture/Picture.php"
	},
	{
	"type":"view",
	"name":"我的足迹",
	"url":"http://instory.applinzi.com/web/TravelNotes/TravelNotes.php"
	},
	{
	"type":"view",
	"name":"个人中心",
	"url":"http://instory.applinzi.com/web/PersonalCenter/PersonalCenter.php"
	}]
}]
}';
 
// create new menu
$wxmenu=new wxmenu($ACCESS_TOKEN);
$create=$wxmenu->createMenu($menuPostData);

//get current menu
// $get=$wxmenu->getMenu();
// var_dump($get);

//delete current menu
// $del=$wxmenu->deleteMenu();
// var_dump($del);

?>