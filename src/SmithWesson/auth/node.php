<?php

namespace SmithWesson\auth;

use think\Exception;

class node
{
	/**
	 * 模块名称
	 * @var  string
	 */
	private $modular;

	/**
	 * @var  string 框架文件基础路径
	 */


	public function __construct()
	{
		//获取初始化的模块
		$this->getModul();

	}

	/**
	 * 设置后台模块
	 * @return  node;
	 * @throws Exception
	 */
	private function getModul()
	{
		$modular = \think\facade\Config::get('app.admin_modular');
		if (!$modular) {
			throw new Exception('后台模块不存在');
		}
		$this->modular = $modular;
		return $this;
	}

	/**
	 * 设置后台模块
	 * @param string $Modul 后台模块
	 * @return $this
	 * @throws Exception
	 */
	public function setModul($modular = '')
	{
		if (!$modular) {
			throw new Exception('请设置模块');
		}
		$this->modular = $modular;
		return $this;
	}


	public function module($path)
	{
		$d = dir($path);
		while (false !== $dir = $d->read()) {
			if ($dir === '.' || $dir === '..') {
				continue;
			}
			if (is_dir($path . DIRECTORY_SEPARATOR . $dir)) {
				yield $dir;
			}
		}
	}

	/**
	 * 获取基础的配置
	 */
	public function getFileNodes()
	{
		//app 路径
		$appPath = \think\facade\Env::get('app.app_path');
		foreach ($this->module($appPath) as $module) {
			var_dump($module);
			die();
		}
	}
}