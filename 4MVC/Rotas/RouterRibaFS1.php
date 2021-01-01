<?php
namespace Core;

class Router
{
    private $urlController;
    private $urlAction;
    private $urlParam;

    public function __construct(){
        // Chamando o método url()
        $this->url();

        // Caso não encontre um controller, execute o default com o action default
        if(!$this->urlController){
            // Verificar se o controller default entrado em config.php existe
            // Se existir o chame
            if((file_exists(APP . 'Controller/' . ucfirst(CONTROLLER_DEFAULT) . 'Controller.php'))){
                $controller = '\\App\\Controller\\'.ucfirst(CONTROLLER_DEFAULT) . 'Controller';
                $this->urlController = new $controller();
                $this->urlController->index();
            }
            // Caso não exista dispare o devido erro
            else{
	      				$action = $this->urlAction;
                $page = new \Core\Controller\ErrorsController();
                $page->index();
            }
        // Se o arquivo do controller existir
        }elseif(file_exists(APP . 'Controller/' . ucfirst($this->urlController) . 'Controller.php')){
            $controller = '\\App\\Controller\\'.ucfirst($this->urlController) . 'Controller';
            $this->urlController = new $controller();
            // Caso o action exista e seja chamável
            if(method_exists($controller, $this->urlAction) && is_callable(array($controller, $this->urlAction))){
								// Checar se os parâmetros não são vazios
                if (!empty($this->urlParams)) {
                    // Se existe chame o método e passe os argumentos para ele
                    call_user_func_array(array($this->urlController, $this->urlAction), $this->urlParams);
                		// Caso o parâmetro seja vazio, chame o controller e o action
                } else {
                    $this->urlController->{$this->urlAction}();
                }
            // Caso o método não exista
            }elseif (strlen($this->urlAction) == 0) {// Caso nada exista na posição do action
                $this->urlController->index();
            // Caso apareça um action que não existe
            }else{ 
			        $action = $this->urlAction;
              $page = new \Core\ErrorController();
              $page->index();
            }
        // Caso o controller não seja encontrado dispara o ErrorsController, passando action e controller como argumentos
        }else{
			        $action = $this->urlAction;
              $page = new \Core\ErrorController();
              $page->index();
        }
    }

    // url2 recebe o diretório atual em path cheio
    // url1 recebe a URL cheia, menos o host
     private function url(){
        $url2 = explode('/', dirname(__DIR__));// Captura a URL
        $url1 = explode('/', $_SERVER['REQUEST_URI']);// Captura a URL

        $this->url=array();
        foreach($url1 as $value) {
            if(in_array($value, $url2)) {
                continue; // Cai fora do laço
            }else{
                array_push($this->url,$value); // Adiciona ao array
            }
        }
        // Capturando a posição do controller, action e params da URL'
        $this->urlController = isset($this->url[0]) ? $this->url[0] : null;
        $this->urlAction = isset($this->url[1]) ? $this->url[1] : 'index';// index é o action default

        $this->urlParams = array_values($this->url);
        $this->urlParams = array_splice($this->urlParams, 2);// Reduzindo o array de params        
        return $this->url;
    }
}
