<?php
class XmlOp {

	protected $path = '';
	protected $_class = '';
	/**
	 * XML 操作类构造函数
	 *<img key="" value=""></img>
	 */
	public function __construct($path,$_class) {

		$this->path = $path;
		$this->_class = $_class;
	}

	//通过key找到value
	public function getValueByKey($key) {

		$xmlDoc = new DOMDocument ( "1.0" );
		$xmlDoc->load($this->path);
		$root = $xmlDoc->documentElement;
		$children = $xmlDoc->getElementsByTagName($this->_class);
		foreach ($children as $child) {
			if($child->getAttribute("key")==$key){
				return $child->getAttribute("value");
			}
		}
	}

	//通过key设置value
	public function setValueByKey($key,$value){

		$xmlDoc = new DOMDocument ( "1.0" );
		$xmlDoc->load($this->path);
		$root = $xmlDoc->documentElement;
		$children = $xmlDoc->getElementsByTagName($this->_class);
		foreach ($children as $child) {
			if($child->getAttribute("key")==$key){
				$child->setAttribute("value",$value);
				return true;
			}
		}
		return false;
	}

	/**
	 * 根据节点某属性找到节点的内容
	 * att:节点名
	 * value:节点名对应的值
	 * 返回节点内容
	 */
	public function getContentByAtt($att,$value){

		$xmlDoc = new DOMDocument ( "1.0" );
		$xmlDoc->load($this->path);
		$root = $xmlDoc->documentElement;
		$children = $xmlDoc->getElementsByTagName($this->_class);
		foreach ($children as $child) {
			if($child->getAttribute($att)==$value){
				return $child->nodeValue;
			}
		}
	}
}
?>