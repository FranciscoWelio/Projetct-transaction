<?php

use PDO;
use Exception;

class H2Connection{


    protected $connection;


    public function __construct(){
        try{
            $this->connection =new PDO(
                "odbc:Driver={H2};URL=jbdc:h2:mem:projetoTransaction;DB_CLOSE_DELAY=-1",
                "sa",
                "");
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(Exception $e){
            die("Erro durante a conexão com H2: ". $e->getMessage());
        }
    }
    public function getConnection(){
        return $this->connection;
    }

}