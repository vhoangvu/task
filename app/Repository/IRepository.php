<?php
  namespace App\Repository;
  
  interface IRepository {
 
    public function read_list();
    
    public function read_list_by($column, $value, $operator = '=', $return_columns = array('*'));
 
    public function insert(array $data);
 
    public function delete($id);    
}
