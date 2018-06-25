<?php
/**
 *
 */
class Validate
{
    private $_passed = false,
    $_errors = array(),
    $_db = null;
    public function __construct(){
      $this->_db = DB::getInstance();
    }

    public function check($source,$items = array()){
        foreach ($items as $item => $rules) {
          foreach ($rules as $rule => $rule_value) {
            $value = $source[$item];
            if($rule==='required' && empty($value)){
              $this->addError("{$item} is required");
            }else if(!empty($value)){
                case 'min':
                    if(strlen($value)<$rule_value){
                      $this->addError("{$item} must be a minimum of {$rule_value}");
                    }
                  break;
                case 'max':
                    if(strlen($value)>$rule_value){
                      $this->addError("{$item} must be a maximum of {$rule_value}");
                    }
                  break;
                case 'matches':
                    if($value != $source[$rule_value]){
                      $this->addError("{$rule_value} must match {$item}");
                    }
                  break;
                case 'unique':
                  $check = $this->_db->get($rule_value,array($item,'=',$value));
                  if($check->count())
                    $this->addError("{$item} already exists");
                  break;
            }
          }
        }

        if(empty($this->_errors)){
          $this->_passed = true;
        }
    }
    private function addError($error){
      $this->_error[] = $error;
    }
    public function errors(){
      return $this->_errors;
    }
    public function errors(){
      return $this->_passed;
    }
}
