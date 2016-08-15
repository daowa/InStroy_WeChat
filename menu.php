<?php

require 'weixin.class.php';

$ret=wxcommon::getToken();
$ACCESS_TOKEN=$ret['access_token'];
$menuPostData='{
"button":[
{
"name":"附近",
"sub_button":[
	{
	{
	"type":"view",
	"name":"地图",
	"url":"http://instory.applinzi.com/web/Map/Map.php"
	},
	{
	"type":"view",
	"name":"景点",
	"url":"http://instory.applinzi.com/web/SelfGuide/SelfGuide.php"
	},
},
{
"name":导游",
"url":"http://instory.applinzi.com/web/SelfGuide/SelfGuide.php"
},
{
"name":"集游册",
"sub_button":[
	{
	"type":"view",
	"name":"集游册",
	"url":"http://instory.applinzi.com/web/Album/Album.php"
	},
	{
	"type":"view",
	"name":"游记",
	"url":"http://instory.applinzi.com/web/TravelNotes/TravelNotes.php"
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