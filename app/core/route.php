<?php

class Route
{

   
	protected $controller = "home";
	protected $method = "index";
	Protected $params = [];
    public static $page = '_404';
	public function __construct()
	{
		$url = $this->splitURL();
		
		if(file_exists("../App/Controller/". strtolower($url[0]) . ".php"))
		{

			$this->controller = strtolower($url[0]);
			unset($url[0]);
            self::$page = $url[0];
		}
        require "../app/controllers/".strtolower($url[0]).".php";
        $controllerName = 'App\Controllers\\' . ucfirst($url[0]);
        $this->controller = new $controllerName;

		if(isset($url[1]))
		{
			if(method_exists($this->controller, $url[1]))
			{
				$this->method = $url[1];
				unset($url[1]);
			}
		}

		$this->params = array_values($url);
		call_user_func_array([$this->controller,$this->method], $this->params);
       
	}

	private function splitURL()
	{   
		$url = isset($_GET['url']) ? $_GET['url'] : "home";
		return explode("/", filter_var(trim($url,"/"),FILTER_SANITIZE_URL));
	}
}