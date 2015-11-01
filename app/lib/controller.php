<?php
//判断不同请求调用不同controller
class Controller {
	private $data = array(); //保存view使用的变量值

	//设置模板使用变量值	
	public function assign($var, $val) {
		$this->data[$var] = $val;
	}
	//显示模板
	function view($template) {
		$data = $this->data; //	把类中的data数组变为该函数的局部变量，给视图模板中使用
		include TEMPLATE_FILE_DIR.$template;
	}
}
