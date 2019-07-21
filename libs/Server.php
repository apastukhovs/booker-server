<?php
class Server
{
    public function __construct($className)
    {
        try
        {
            $this->parseMethod($className);
        }
        catch (Exception $e)
        {
            echo json_encode(['errors' => $e->getMessage()]);
        }
    }
    private function parseMethod($className)
    {
        $this->className = $className;
        //var_dump($className);
        $url = $_SERVER['REQUEST_URI'];
        list($b, $a, $db, $className, $funcName, $path) = explode('/', $url, 7);
        //var_dump($b, $a, $db, $className, $funcName, $path);
        $params = explode('/', $url, 2);
        //var_dump($params);
        $method = $_SERVER['REQUEST_METHOD'];
        $funcParams = explode('/', $path);
        //var_dump($funcParams);
        $result = '';
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Headers: *');
		header('Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS, PUT');
        header('Content-Type: application/json');
        //var_dump($method);
        switch ($method) {
            case 'GET':
                $result = $this->setMethod('get' . $funcName, $funcParams);
                 break;
            case 'POST':
                $result = $this->setMethod('post' . $funcName, $funcParams);
                break;
            case 'PUT':
            $result = $this->setMethod('put' . $funcName, $funcParams);
                break;
            case 'DELETE':
            $result = $this->setMethod('delete' . $funcName, $funcParams);
                break;
            default:
                return false;
        }
		
        return $this->show_results($result);
    }
    public function setMethod($funcName, $param = false)
    {
        var_dump($funcName);
        if (method_exists($this->className, $funcName))
        {
            return call_user_func([$this->className, $funcName], $param);
        } else {
			return "No such method: " . $funcName;
		}
    }
	public function show_results($result)
	{
        echo json_encode($result);
               
    }
    
}
