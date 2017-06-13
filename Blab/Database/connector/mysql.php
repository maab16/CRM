<?php

namespace Blab\Database\Connector;

use Blab\Database;
use Blab\Database\Exception;

class Mysql extends Database\Connector
{
	protected $_service;

	protected $_query;

	protected $_lastInsertId;

	protected $_error;
	/**
	 *@readwrite
	 */
	protected $_results;
	/**
	 *@readwrite
	 */
	protected $_count;

	/**
	 *@readwrite
	 */

	protected $_host;

	/**
	 *@readwrite
	 */

	protected $_username;

	/**
	 *@readwrite
	 */

	protected $_password;

	/**
	 *@readwrite
	 */

	protected $_dbName;

	/**
	 *@readwrite
	 */

	protected $_port= "3306";

	/**
	 *@readwrite
	 */

	protected $_charset = "utf8";

	/**
	 *@readwrite
	 */

	protected $_engine = "InoDB";

	/**
	 *@readwrite
	 */

	protected $_isConnected = false;

	// checks if connected to the database
	protected function _isValidService(){

		$isInstance = $this->_service instanceof \PDO;

		if (!empty($this->_service) && $isInstance && $this->isConnected) {
			
			return true ;
		}

		return false;
	}

	protected function _prepareSql($sql,$params = array()){

		if ($_query = $this->_service->prepare($sql)) {
				
				$x=1;
				if (count($params)) {
					
					foreach ($params as $param) {
					
						$_query->bindValue($x,$param);

						$x++;
					}
				}

			return $_query;
		}
	}

	// connects to the database
	public function connect(){

		if (!$this->_isValidService()) {

			$dsn = 'mysql:dbname='.$this->_dbName.';host='.$this->_host;
			$options = array(
					    \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
					); 
			try{
				$this->_service = new \PDO($dsn,$this->_username,$this->_password,$options);
				$this->_isConnected = true;

			}catch(\PDOException $e){

				die($e->getMessage());
			}
		}

		return $this;
	}

	// disconnects from the database
	public function close(){

		if ($this->_isValidService()) {
			
			$this->_isConnected = false;
			$this->_service=null;
		}

		return $this;
	}

	public function createTable($model)
    {
        $lines = array();
        $indices = array();
        $columns = $model->getColumns();
        $template = "CREATE TABLE `%s` (\n%s,\n%s\n);";
            
        foreach ($columns as $column)
        {
        	$raw = $column["raw"];
        	$name = $column["name"];
        	$type = $column["type"];
        	$length = $column["length"];
                
        	if ($column["primary"])
            {
                $indices[] = "PRIMARY KEY (`{$name}`)";
            }
            if ($column["index"])
            {
                $indices[] = "KEY `{$name}` (`{$name}`)";
            }
                
            switch ($type)
            {
                case "autonumber":
                {
                    $lines[] = "`{$name}` int(11) NOT NULL AUTO_INCREMENT";
                    break;
                }
                case "text":
                {
                    if ($length !== null && $length <= 255)
                    {
                        $lines[] = "`{$name}` varchar({$length}) DEFAULT NULL";
                    }
                    else
                    {
                    	$lines[] = "`{$name}` text";
                    }
                    break;
                } 
                case "integer":
                {
                        $lines[] = "`{$name}` int(11) DEFAULT NULL";
                        break;
                    }
                    case "decimal":
                    {
                        $lines[] = "`{$name}` float DEFAULT NULL";
                        break;
                    }
                    case "boolean":
                    {
                        $lines[] = "`{$name}` tinyint(4) DEFAULT NULL";
                        break;
                    }
                    case "datetime":
                    {
                        $lines[] = "`{$name}` datetime DEFAULT NULL";
                        break;
                    }
                }
            }
            
            $table = $model->getTable();
            $sql = sprintf(
                $template,
                $table,
                join(",\n", $lines),
                join(",\n", $indices)
            );
            
            $result = $this->_service->exec("DROP TABLE IF EXISTS {$table};");
            if ($result === false)
            {
                $error = $this->lastError;
                throw new Exception\Sql("There was an error in the query: {$error}");
            }
      	
            $result = $this->_service->exec($sql);
            if ($result === false)
            {
                //$error = $this->lastError;
                throw new Exception\Sql("There was an error in the query: ");
            }
            
            return $this;
        }

	// returns a corresponding query instance
	public function query(){

		return new Database\Query\Mysql(array(

				"connector"=>$this
			));
	}

	// executes the provided SQL statement

	public function execute($sql,$params = array()){

		if (!$this->_isValidService()) {
			
			throw new Exception\Service("Unable to connect service");
		}

			if ($this->_query = $this->_service->prepare($sql)) {
				
				$x=1;
				if (!empty($params)) {
					//print_r($params);
					foreach ($params as $param) {
					
						$this->_query->bindValue($x,$param);

						$x++;
					}
				}

				if ($this->_query->execute()) {

					$this->_lastInsertId = $this->_service->lastInsertId();

					$this->_results = $this->_query->fetchAll(\PDO::FETCH_OBJ);

					$this->_count = $this->_query->rowCount();
			
					return $this;

				}else{

					return false;
				}
			}

			return false;
	}

	public function getResults(){

		return $this->_results;
	}

	// escapes the provided value to make it safe for queries

	// escapes the provided value to make it safe for queries
        public function escape($value)
        {
            if (!$this->_isValidService())
            {
                throw new Exception\Service("Not connected to a valid service");
            }
            
            return $this->_service->quote($value);
        }
        
        // returns the ID of the last row
        // to be inserted
        public function getLastInsertId()
        {
            if (!$this->_isValidService())
            {
                throw new Exception\Service("Not connected to a valid service");
            }
            
            return $this->_lastInsertId;
        }
        
        // returns the number of rows affected
        // by the last SQL query executed
        public function getAffectedRows()
        {
            if (!$this->_isValidService())
            {
                throw new Exception\Service("Not connected to a valid service");
            }
            
            return $this->_count;
        }
        
        // returns the last error of occur
        public function getLastError()
        {
            if (!$this->_isValidService())
            {
                throw new Exception\Service("Not connected to a valid service");
            }
            
            return $this->_service->errorInfo();
        }
}