<?php

//especifica o namespace
namespace Hcode;

//ao instanciar o Tpl é do namespace Rain
use Rain\Tpl;


class Page{

	private $tpl;
	private $options = [];
	private $defaults=[
		"data"=>[]
	];


	public function __construct($opts = array(), $tpl_dir = "/views/"){

		$this->options = array_merge($this->defaults, $opts);
  
   // precisa de uma pasta para pegar um html
	$config = array(
					"tpl_dir"       => $_SERVER["DOCUMENT_ROOT"].$tpl_dir,
					"cache_dir"     => $_SERVER["DOCUMENT_ROOT"]."/views-cache/",
					"debug"         => false 
				   );

	Tpl::configure( $config );
    
    //This diz que é atributo da nossa classe
	$this->tpl = new Tpl;
	$this->setData($this->options["data"]);
	$this->tpl->draw("header");  //header é carregado em todas as páginas
   }

	

	private function setData($data = array())
	{
            foreach ($data as $key => $value) {
        	$this->tpl->assign($key,$value);
          }
	}

	//aqui são os métodos do conteúdo

   public function setTpl($name, $data = array(), $returnHTML = false)
   {       
   		$this->setData($data);
   		return $this->tpl->draw($name, $returnHTML);

   }


	public function __destruct()
	{
		//footer
    $this->tpl->draw("footer");

	}
}

?>