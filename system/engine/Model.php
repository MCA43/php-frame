<?php

namespace System\Engine;

use PDO;
use PDOException;

class Model
{
    protected $pdo = null;
    protected $table = null;

    public function __construct()
    {
        try {
            $this->pdo = new PDO('mysql:host=' . \DB_HOST . ';dbname=' . \DB_NAME, \DB_USER, \DB_PASS, \DB_OPTIONS);
        } catch (PDOException $e) {
            error_log('Veritabanı hatası: ' . $e->getMessage() . PHP_EOL, 3, \APP_ROOT . '/error_log.php');
            die($e->getMessage());
        }
    }

    public function get($id = null){
        $statement = $this->pdo->query('SELECT * FROM ' . $this->table . ' WHERE id = ' . $id);
        $response = $statement->fetch(\PDO::FETCH_ASSOC);

        return $response ?: [];
    }

    public function getRows($conditions = array()){
        $sql = 'SELECT ';
        $sql .= array_key_exists("select",$conditions)?$conditions['select']:'*';
        $sql .= ' FROM '.$this->table;
        if(array_key_exists("where",$conditions)){
            $sql .= ' WHERE ';
            $i = 0;
            foreach($conditions['where'] as $key => $value){
                $pre = ($i > 0)?' AND ':'';
                $sql .= $pre.$key." = '".$value."'";
                $i++;
            }
        }

        if(array_key_exists("order_by",$conditions)){
            $sql .= ' ORDER BY '.$conditions['order_by'];
        }

        if(array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
            $sql .= ' LIMIT '.$conditions['start'].','.$conditions['limit'];
        }elseif(!array_key_exists("start",$conditions) && array_key_exists("limit",$conditions)){
            $sql .= ' LIMIT '.$conditions['limit'];
        }

        $query = $this->pdo->prepare($sql);
        $query->execute();

        if(array_key_exists("return_type",$conditions) && $conditions['return_type'] != 'all'){
            switch($conditions['return_type']){
                case 'count':
                    $data = $query->rowCount();
                    break;
                case 'single':
                    $data = $query->fetch(PDO::FETCH_ASSOC);
                    break;
                default:
                    $data = '';
            }
        }else{
            if($query->rowCount() > 0){
                $data = $query->fetchAll();
            }
        }
        return !empty($data)?$data:false;
    }

    /*
     * Insert data into the database
     * @param string name of the table
     * @param array the data for inserting into the table
     */
    public function create($data){
        if(!empty($data) && is_array($data)){
            $columns = '';
            $values  = '';
            $i = 0;
            if(!array_key_exists('created_at',$data)){
                $data['created_at'] = date("Y-m-d H:i:s");
            }
            if(!array_key_exists('updated_at',$data)){
                $data['updated_at'] = date("Y-m-d H:i:s");
            }

            $columnString = implode(',', array_keys($data));
            $valueString = ":".implode(',:', array_keys($data));
            $sql = "INSERT INTO ".$this->table." (".$columnString.") VALUES (".$valueString.")";
            $query = $this->pdo->prepare($sql);
            foreach($data as $key=>$val){
                $query->bindValue(':'.$key, $val);
            }
            $insert = $query->execute();
            return $insert?$this->pdo->lastInsertId():false;
        }else{
            return false;
        }
    }

    /*
     * Update data into the database
     * @param string name of the table
     * @param array the data for updating into the table
     * @param array where condition on updating data
     */
    public function update($data,$conditions){
        if(!empty($data) && is_array($data)){
            $colvalSet = '';
            $whereSql = '';
            $i = 0;
            if(!array_key_exists('updated_at',$data)){
                $data['updated_at'] = date("Y-m-d H:i:s");
            }
            foreach($data as $key=>$val){
                $pre = ($i > 0)?', ':'';
                $colvalSet .= $pre.$key."='".$val."'";
                $i++;
            }
            if(!empty($conditions)&& is_array($conditions)){
                $whereSql .= ' WHERE ';
                $i = 0;
                foreach($conditions as $key => $value){
                    $pre = ($i > 0)?' AND ':'';
                    $whereSql .= $pre.$key." = '".$value."'";
                    $i++;
                }
            }
            $sql = "UPDATE ".$this->table." SET ".$colvalSet.$whereSql;
            $query = $this->pdo->prepare($sql);
            $update = $query->execute();
            return $update?$query->rowCount():false;
        }else{
            return false;
        }
    }

    /*
     * Delete data from the database
     * @param string name of the table
     * @param array where condition on deleting data
     */
    public function delete($conditions){
        $whereSql = '';
        if(!empty($conditions)&& is_array($conditions)){
            $whereSql .= ' WHERE ';
            $i = 0;
            foreach($conditions as $key => $value){
                $pre = ($i > 0)?' AND ':'';
                $whereSql .= $pre.$key." = '".$value."'";
                $i++;
            }
        }
        $sql = "DELETE FROM ".$this->table.$whereSql;
        $delete = $this->pdo->exec($sql);
        return $delete?$delete:false;
    }

}
