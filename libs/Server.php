<?
class Server
{
    private $service;
    public function __construct($service)
    {
        try
        {
            $this->chooseMethod($service);
        }
        catch (Exception $e)
        {
            echo json_encode(['errors' => $e->getMessage()]);
        } 
    }

    private function chooseMethod($service)
    {
        $this->service = $service;
        $url = $_SERVER['REQUEST_URI'];
        list($b, $c, $s, $a, $d, $e, $db, $func, $param) = explode('/', $url, 8);
        $method = $_SERVER['REQUEST_METHOD'];
        $functionName = ucfirst($func);
        $functionParams = explode('/', $param);
        $res = '';

        switch ($method)
        {
            case 'GET':
                $result = $this->setMethod('get' . $functionName, $functionParams, $_GET);
                break;
            case 'POST':
                $contents = file_get_contents('php://input');
                $queryParams = json_decode($contents, true);
                $result = $this->setMethod('post' . $functionName, $functionParams, $queryParams);
                break;
            case 'PUT':
                $queryParams = json_decode(file_get_contents('php://input'), true);
                $result = $this->setMethod('put' . $functionName, $functionParams, $queryParams);
                break;
            case 'DELETE':
                $queryParams = json_decode(file_get_contents('php://input'), true);
                $result = $this->setMethod('delete' . $functionName, $functionParams, $queryParams);
                break;
            default:
                return false;
        }
        $this->get_result($res); 
    }

    private function setMethod($functionName, $functionParams = false, $queryParams = false)
    {
        $result = false;
        if (method_exists($this->service, $funcName))
        {
            $result = call_user_func([$this->service, $functionName], $functionParams, $queryParams);
        }
        return $result;
    }

    private function get_result($res)
    {
        header('Content-Type: application/json');
        echo json_encode($res);
    }
}