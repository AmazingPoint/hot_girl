<?php 

/*
* 单例模式的数据库连接类
*/
class DataBaseUtil{

	private static $link = null;
	private static $host = 'localhost';
	private static $user = 'root';
	private static $password = 'larry-andy';
	private static $db = 'hotgirl';
	private static $_instance;

	/*
	* 构造函数
	* 私有
	*/
	private function _constant(){} 

	/*
	* 实例化方法（防止被clone）
	* 私有
	*/
	private static function _clone(){}
	public static function getInstance(){
		if(!(self::$_instance instanceof self)){
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/*
	* 连接数据库
	* return mysql_link $link
	*/
	public function connect(){
		if(!self::$link){
			self::$link = mysql_connect(self::$host, self::$user, self::$password);
			mysql_set_charset('UTF8');
			if(!self::$link){
				die('mysql connect error'. mysql_error());
			}
			mysql_selectdb(self::$db, self::$link);
		}
		return self::$link;
	}

}
