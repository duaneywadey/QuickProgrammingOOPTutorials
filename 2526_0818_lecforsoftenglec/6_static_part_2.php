
<?php
class Student{
    public $age = 25;
    public $name = "IvanDuane";

    // belongs to the student class itself
    static $generation = 2006;

   public function readPublic(){
       return $this->age;  
   }

   public function readName(){
       return $this->name;         
    //   return $student1->age;    
    //   return self::$generation;    

   }
   public static function readStatic(){
       return self::$generation;    
   }
}

// $student1 = new Student();
// echo $student1->readPublic();
// echo $student1->readStatic();
echo Student::readStatic();
?>

