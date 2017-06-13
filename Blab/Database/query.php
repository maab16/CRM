<?php

namespace Blab\Database;

use Blab\Libs\Core as Core;
use Blab\Libs\ArrayMethods as ArrayMethods;
use Blab\Database\Exception as Exception;

class Query extends Core
{
    /**
    * @readwrite
    */
    protected $_connector;
    
    /**
    * @read
    */
    protected $_table;
    
    /**
    * @read
    */
    protected $_fields;
    
    /**
    * @read
    */
    protected $_limit;
    
    /**
    * @read
    */
    protected $_offset;
    
    /**
    * @read
    */
    protected $_order;
    
    /**
    * @read
    */
    protected $_direction;
    
    /**
    * @read
    */
    protected $_join = array();
    
    /**
    * @read
    */
    protected $_where;

    /**
    * @read
    */

    protected $_bindValues = array();
    
    protected function _getExceptionForImplementation($method)
    {
        return new \Exception("{$method} method not implemented");
    }
                
    protected function _quote($value)
    {
        if (is_string($value))
        {
            $escaped = $this->connector->escape($value);
            return "'{$escaped}'";
        }
        
        if (is_array($value))
        {
            $buffer = array();
            
            foreach ($value as $i)
            {
                array_push($buffer, $this->_quote($i));
            }
    
            $buffer = implode(", ", $buffer);
            return "({$buffer})";
        }
        
        if (is_null($value))
        {
            return "NULL";
        }
        
        if (is_bool($value))
        {
            return (int) $value;
        }
        
        return $this->connector->escape($value);
    }
    
    protected function _prepareSelect()
    {
        $fields = array();
        $where = $order = $limit = $join = "";
        // %s is formate symbole those are used by sprintf()
        $template = "SELECT %s FROM %s %s %s %s %s";

        if (!empty($this->_fields)) {

            $fields = implode(" , " , $this->_fields);
        }else {

            $fields = "*";
        }
        
        if (!empty($this->_join))
        {
            $join = implode(" ", $this->_join);
        }
        
        if (!empty($this->_where))
        {
            $this->_where = implode(" AND " , $this->_where);
            $where = "WHERE {$this->_where}";
        }
        
        if (!empty($this->_order))
        {
            $order = "ORDER BY {$this->_order} {$this->_direction}";
        }
        
        if (!empty($this->_limit))
        {
            $_offset = $this->_offset;
            
            if ($_offset)
            {
                $limit = "LIMIT {$_offset} , {$this->_limit} ";
            }
            else
            {
                $limit = "LIMIT {$this->_limit}";
            }
        }
        
       return sprintf($template, $fields, $this->_table, $join, $where, $order, $limit);
    }
    
    protected function _prepareInsert($data)
    {
        $template = "INSERT INTO `%s` (%s) VALUES (%s)";
        
        if ($totalElement = count($data)) {
                
                $fields = "";
                $values = "";
                $i = 1;
                foreach ($data as $field => $value) {
                    
                    $fields .= "`{$field}`";
                    $values .= "?";
                    $this->_bindValues[] = $value;

                    if ($i < $totalElement) {
                        
                        $fields .= ",";
                        $values .= ",";
                    }

                    $i++;
                }
            }

       return sprintf($template, $this->_table, $fields, $values);
    }
    
    protected function _prepareUpdate($data)
    {
        $fields = "";
        $values = array();
        $where = $limit = "";
        $template = "UPDATE %s SET %s %s %s";
        
        $i = 1;

        foreach ($data as $field => $value)
        {
            $fields .= "{$field} = ?";
            $values[] = $value;

            if ($i < count($data)) {
                
                $fields .= ",";
            }

            $i++;
        }

        // Push $values into _bindValues array first
        if (!empty($values)) {

            $i = count($values);

            while ($i) {
                
                array_unshift($this->_bindValues,$values[$i-1]);
                $i--;
            }
        }
        
        if (!empty($this->_where))
        {
            $this->_where = implode(" AND " , $this->_where);
            $where = "WHERE {$this->_where}";
        }
        
        if (!empty($this->_limit))
        {
            $_offset = $this->offset;
            $limit = "LIMIT {$this->_limit} {$_offset}";
        }

        return sprintf($template, $this->_table, $fields, $where, $limit);
    }
    
    protected function _prepareDelete()
    {
        if (empty($this->_table)) {
            
            throw new Exception\Argument("Table Name Invalid ");
        }
        $table = $this->_table;
        $where = $limit ="";
        $template = "DELETE FROM %s %s %s";
    
        if (!empty($this->_where))
        {
            $this->_where = implode(" AND " , $this->_where);
            $where = "WHERE {$this->_where}";
        }
        
        if (!empty($this->_limit))
        {
            $_offset = $this->offset;
            $limit = "LIMIT {$this->_limit} {$_offset}";
        }
        
        return sprintf($template, $table, $where, $limit);
    }

    public function isAssoc(array $arr){

        if (array() === $arr) return false;
        return (array_keys($arr) !== range(0, count($arr) - 1)) ? true : false;
    }

    public function insert($data){

        $sql = $this->_prepareInsert($data);

        $result = $this->_connector->execute($sql,$this->_bindValues);
        
        if ($result === false)
        {
            throw new Exception\Sql();
        }

        return $result;
    }

    public function update($data){

        $sql = $this->_prepareUpdate($data);

        $result = $this->_connector->execute($sql,$this->_bindValues);
        
        if ($result === false)
        {
            throw new Exception\Sql();
        }

        return $result->getAffectedRows();
    }
    
    public function delete()
    {
        $sql = $this->_prepareDelete();
        $result = $this->_connector->execute($sql,$this->_bindValues);
        
        if ($result === false)
        {
            throw new Exception\Sql();
        }
        
        return $this->_connector->getAffectedRows();
    }
    
    public function from($table, $fields = array())
    {
        $this->_fields = array();
        if (empty($table))
        {
            throw new Exception\Argument("Invalid argument");
        }
        
        $this->_table = $table;
        
        if (!empty($fields) && $this->isAssoc($fields))
        {

            $i = 1;
            foreach ($fields as $field => $value) {

               $this->_fields[] = "{$field} AS ?";

                $this->_bindValues[] = $value;   
            }        
        }
        else
        {
            foreach ($fields as $field) {

               $this->_fields[] = "{$field}"; 
            }
        }
        
        return $this;
    }

    public function into($table, $fields = array())
    {
        if (empty($table))
        {
            throw new Exception\Argument("Invalid argument");
        }
        
        $this->_table = $table;
        
        if (!empty($fields))
        {

            $i = 1;
            foreach ($fields as $field => $value) {

               $this->_fields[] = "{$field} AS ?";

                $this->_bindValues[] = $value;   
            }        
        }
        
        return $this;
    }
    
    public function join($type="INNER",$join, $on, $fields = array())
    {
        if (empty($join))
        {
            throw new Exception\Argument("Invalid argument");
        }
        
        if (empty($on))
        {
            throw new Exception\Argument("Invalid argument");
        }

        if (!empty($fields)) {
            
            foreach ($fields as $field => $value) {

               $this->_fields[] = "{$field} AS ?";

                $this->_bindValues[] = $value;
                    
            }
        }
        
        $this->_join[] = "{$type} JOIN {$join} ON {$on}";
        
        return $this;
    }
    
    public function limit($limit, $page = 1)
    {
        if (empty($limit))
        {
            throw new Exception\Argument("Invalid argument");
        }
        
        $this->_limit = $limit;
        $this->_offset = $limit * ($page - 1);
        
        return $this;
    }
    
    public function order($order=array())
    {
        $orderBy = "";
        $orderDirection = "";

        if (!empty($order))
        {
            foreach ($order as $key => $value) {
            
                $orderBy = $key;
                $orderDirection = $value;
            }
        }
       
        $this->_order = $orderBy;
        $this->_direction = $orderDirection;
        
        return $this;
    }
    
     public function where($where=array(),$oparator = "",$joint="AND")
    {

        if (empty($where)) {
            
            $this->_where = array();
            return $this;
        }

        if (!empty($oparator)) {
            
            $operators = array('=','<','>','<=','>=','<>','!=');

            if (in_array($oparator,$operators)) {
               
                foreach ($where as $field => $value) {
                    
                    $this->_where[] = "{$field} {$oparator} ?";
                    $this->_bindValues[] = $value;;
                }
            }
        }else{

            foreach ($where as $field => $value) {
                    
                $this->_where[] = "{$field} = ?";
                $this->_bindValues[] = $value;
            }
        }

        $this->_where[] = implode(" {$joint} ", $this->_where);
        array_splice($this->_where,0,-1);
        
        return $this;
    }

    public function andWhere($where=array(),$oparator="")
    {
        if (empty($where)) {
            
            $this->_where = array();
            return $this;
        }

        if (!empty($oparator)) {
            
            $operators = array('=','<','>','<=','>=','<>','!=');

            if (in_array($oparator,$operators)) {
               
                foreach ($where as $field => $value) {
                    
                    $this->_where[] = "{$field} {$oparator} ?";
                    $this->_bindValues[] = $value;;
                }
            }
        }else{

            foreach ($where as $field => $value) {
                    
                $this->_where[] = "{$field} = ?";
                $this->_bindValues[] = $value;
            }
        }

        $this->_where[] = implode(' AND ', $this->_where);
        array_splice($this->_where,0,-1);
        
        return $this;
    }

    public function orWhere($where=array(),$oparator="")
    {
        if (empty($where)) {
            
            $this->_where = array();
            return $this;
        }

        if (!empty($oparator)) {
            
            $operators = array('=','<','>','<=','>=','<>','!=');

            if (in_array($oparator,$operators)) {
               
                foreach ($where as $field => $value) {
                    
                    $this->_where[] = "{$field} {$oparator} ?";
                    $this->_bindValues[] = $value;;
                }
            }
        }else{

            foreach ($where as $field => $value) {
                    
                $this->_where[] = "{$field} = ?";
                $this->_bindValues[] = $value;
            }
        }

        $this->_where[] = implode(' OR ', $this->_where);
        array_splice($this->_where,0,-1);
        
        return $this;
    }
}
