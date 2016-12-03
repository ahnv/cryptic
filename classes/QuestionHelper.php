<?php
  class QuestionHelper{
    private $db;
    private $app;
    public function __construct($db) { $this->db =  $db; $this->app = new APP();}
    public function add($level, $hint1, $hint2, $answer){
      $answer = $this->app->_cleanString($answer);
      if (!$hint1 || !$hint2 || !$answer) return 0;
      try{
        $query = $this->db->prepare("
            INSERT INTO 
            `cryptic_questions` (`level`, `hint1`, `hint2`, `answer`) 
            VALUES 
            (?, ?, ?, ?)");
        $query->execute(array($level, $hint1, $hint2, $answer));
        return 1;
      }
       catch(PDOException $e){
        SysLog::send($e,LOG_ERR);
      }
    }
    public function update($level, $hint1, $hint2, $answer){
      $answer = $this->app->_cleanString($answer);
      try{
        $query = $this->db->prepare("
            UPDATE `cryptic_questions` SET `hint1` = ?, `hint2` = ?, `answer` = ? WHERE `level` = ?");
        $query->execute(array($hint1, $hint2, $answer, $level));
        return 1;
      }
       catch(PDOException $e){
      SysLog::send($e,LOG_ERR);
      }
    }
    public function getOne($level){
      $level = $this->app->_cleanINT($level);
      try{
        $query = $this->db->prepare("
            SELECT `level`, `hint1`, `hint2`,`answer` FROM `cryptic_questions` WHERE `level` = ?
            ");
        $query->execute(array($level));
        $rows = $query->fetch(PDO::FETCH_ASSOC);
        return $rows;
      }
      catch(PDOException $e){
        SysLog::send($e,LOG_ERR);
      }
    }
    public function getList(){
      try{
        $query = $this->db->prepare("
            SELECT `level`, `hint1`, `hint2`,`answer` FROM `cryptic_questions` ORDER BY  `level` 
            ");
        $query->execute();
        $rows = $query->fetchAll(PDO::FETCH_ASSOC);
        return $rows;
      }
      catch(PDOException $e){
        SysLog::send($e,LOG_ERR);
      }
    }
    public function getLevelList(){
      try{
        $query = $this->db->prepare("
            SELECT `level` FROM `cryptic_questions`
            ");
        $query->execute();
        $rows = $query->fetchAll(PDO::FETCH_ASSOC);
        $temp = array();
        foreach ($rows as $key) array_push( $temp,$key['level']);
        $rows = $temp;
        return $rows;
      }
      catch(PDOException $e){
          SysLog::send($e,LOG_ERR);
      }
    }
  }