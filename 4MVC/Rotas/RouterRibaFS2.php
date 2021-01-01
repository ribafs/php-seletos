<?php
// Nesta versão são passados para o index() do ErrorController, os parâmetros $controller e $action
// Para ajudar quem está vendo o erro
namespace Core;

class Router
{
    private $urlController;
    private $urlAction;
    private $urlParam;

    public function __construct(){
        $this->url();

        // Caso não encontre um controller, execute o default com o action default
        if(!$this->urlController){
            // Verificar se o controller default entrado em config.php existe. Se existir chame-o
            if((file_exists(APP . 'Controller/' . ucfirst(DEFAULT_CONTROLLER) . 'Controller.php'))){
                $controller = '\\App\\Controllers\\'.ucfirst(DEFAULT_CONTROLLER) . 'Controller';
                $this->urlController = new $controller();
                $this->urlController->index();
            }
        // Se o arquivo do controller da url existir
        }elseif(file_exists(APP . 'Controllers/' . ucfirst($this->urlController) . 'Controller.php')){
            $controller = '\\App\\Controllers\\'.ucfirst($this->urlController) . 'Controller';
            $this->urlController = new $controller();
            // Caso o action exista e seja chamável
            if(method_exists($controller, $this->urlAction) && is_callable(array($controller, $this->urlAction))){
								// Checar se os parâmetros não são vazios
                if (!empty($this->urlParams)) {
                    // Se existe chame o método e passe os argumentos para ele
                    call_user_func_array(array($this->urlController, $this->urlAction), $this->urlParams);
                		// Caso o parâmetro seja vazio, chame somente o controller com o action
                } else {
                    $this->urlController->{$this->urlAction}();
                }
            // Caso o método não exista, ou seja, nada exista ao lado do controller na url, chamar o controller da url com index()
            }elseif (strlen($this->urlAction) == 0) {// Caso nada exista na posição do action
                $this->urlController->index();
		            // Caso apareça um action que não existe
            }else{ // Erro do action
			        $action = $this->urlAction;
              $page = new \Core\ErrorController();
              $page->index($this->urlController, $action,1);
            }
        // Caso o controller não seja encontrado dispara o ErrorsController, passando action e controller como argumentos e indicando o $type
        // $type = 2 - controller, $type = 1 - action
        }else{ // Erro do cotnroller
			        $action = $this->urlAction;
              $page = new \Core\ErrorController();
              $page->index($this->urlController, $action,2);
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
