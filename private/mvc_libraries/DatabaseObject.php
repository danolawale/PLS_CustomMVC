<?php
//This is a DatabaseObject class uses PDO and is based on the Active Record design pattern

class DatabaseObject {

  protected static $database;
  protected static $table_name = '';
  protected static $table_columns = [];

  public static function set_database($database) {
    self::$database = $database;
  }

  protected static function prepare_and_execute_sql($sql, $array){
    $sth = self::$database->prepare($sql);
    $result;
    if(empty($array)){
      $result = $sth->execute();
    }else{
      $result = $sth->execute($array);
    }
    if(!$result){
      exit("Database query failed: ". $sth->errorInfo()[2]);
    }
    return $sth;
  }

  public static function query_and_instantiate_results($sql, $array=[]){ //when you want to instantiate multipe
    $sth = static::prepare_and_execute_sql($sql, $array);
    $sth->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, get_called_class(), $array);
    $objects_array = [];
    foreach($sth as $row){
      $objects_array[] = $row;
    }
    return $objects_array;
  }

  public static function fetch_pairs_into_assoc($sql, $array=[]){
    $sth = static::prepare_and_execute_sql($sql, $array);
    $result = $sth->fetchAll(PDO::FETCH_KEY_PAIR);
    return $result; //an associative array with key-value pairs
  }

  public static function find_all(){
    $sql = "SELECT * FROM " . static::$table_name;
    return static::query_and_instantiate_results($sql);
  }

  public static function find_by_id($id){
    #$sql = "SELECT * FROM " . static::$table_name . " WHERE id = ?";
    $sql = "SELECT * FROM " . static::$table_name . " WHERE id = ?";
    $array = [$id];
    $object_array = static::query_and_instantiate_results($sql, $array);
    if(!empty($object_array)){
      return array_shift($object_array);
    }else{
      return false;
    }

  }

  public function create(){
    $attributes = $this->get_attributes();
    $sql = "INSERT INTO " . static::$table_name . "( ";
    $sql .= join(", ", array_keys($attributes));
    $sql .= ") VALUES (:";
    $sql .= join(', :', array_keys($attributes)) . ");";

    $sth = static::prepare_and_execute_sql($sql, $attributes);
    if(!$sth->rowCount()){
      return false;
    }
    $this->id = self::$database->lastInsertId();
    return true;
  }

  public function update(){
    $attribute_key_params = [];
    $attribute_key_values = [];
    foreach($this->get_attributes() as $key => $value){
      $attribute_key_params[] = "{$key}= :{$key}"; //creating named place holders
      $attribute_key_values[$key] = $value;
    }

    $sql = "UPDATE ". static::$table_name . " SET ";
    $sql .= join(', ', $attribute_key_params);
    $sql .= " WHERE id = :id";

    $attribute_key_values['id'] = $this->id;
    $sth = static::prepare_and_execute_sql($sql, $attribute_key_values);
    if(!$sth->rowCount()){
      return false;
    }
    return true;
  }

  public function delete(){
    $sql = "DELETE FROM " . static::$table_name;
    $sql .= " WHERE id = ?";
    $array = [$this->id];
    $sth = static::prepare_and_execute_sql($sql, $array);
    if(!$sth->rowCount()){
      return false;
    }
    return true;
  }

  public function merge_attributes($args=[]){
    foreach($args as $key => $value){
      if(array_key_exists($key, $this->data) && !is_null($value)){ #if the class properties are stored in an array
        $this->data[$key] = $value;
      }elseif(property_exists($this, $key) && !is_null($value)){ #if the class properties are pre defined
        $this->$key = $value;
      }
    }
  }

  protected function get_attributes(){
    $attributes = [];

    foreach(static::$table_columns as $column){
      #if($column == 'id') { continue; }
      if($column == 'id') { continue; }
      $attributes[$column] = $this->$column;
    }
    return $attributes;
  }
}

?>
