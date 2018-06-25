<?php
class Internship
{
  public   $_db,
          $_data;
  public function __construct($id=null)
  {
      $this->_db = DB::getInstance();
  }
  public function getInternship($id=null){
   return $this->_data = $this->_db->get('internships',array('id','=',$id))->_results[0];
  }
  public function getOrganization($id=null){
   return $this->_data = $this->_db->get('company',array('id','=',$id))->_results[0];
  }
  public function getAppliedApplications($id=null){
    return $this->_data = $this->_db->get('applied',array('user_id','=',$id))->_results;
  }
  public function getApplications($id){
    return $this->_data = $this->_db->get('applied',array('internship_id','=',$id))->_results;
  }
  public function isAlreadyApplied($id){
    return count($this->_data = $this->_db->get('applied',array('user_id','=',$id))->_results);
  }
  public function getAll(){
    return $this->_db->get('internships',array('1','=','1'))->_results;

  }
  public function data(){
      return $this->_data;
  }


}
