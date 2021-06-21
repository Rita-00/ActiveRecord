<?php
$pdo = require 'connectPDO.php';

class person{
    private $id_p;
    private $name_p;
    private $surname;
    private $age;
    private $address;


    public function __construct($id_p, $name_p, $surname,$age,$address)
    {
        $this->id_p = $id_p;
        $this->name_p = $name_p;
        $this->surname = $surname;
        $this->age=$age;
        $this->address=$address;
    }

    public function getId_p()
    {
        return $this->id_p;
    }

    public function getName_p()
    {
        return $this->name_p;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function getAge()
    {
        return $this->age;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function save($pdo) : bool {
        $stmt = $pdo->prepare("INSERT INTO person (id_p,name_p,surname,age,address) values(?,?,?,?,?)");
        $stmt->bindParam(1, $this->id_p, PDO::PARAM_INT);
        $stmt->bindParam(2, $this->name_p, PDO::PARAM_STR, 20);
        $stmt->bindParam(3, $this->surname, PDO::PARAM_INT, 30);
        $stmt->bindParam(4, $this->age, PDO::PARAM_INT,3);
        $stmt->bindParam(5, $this->adress, PDO::PARAM_STR,100);
        return $stmt->execute();
    }

    public function remove($pdo) {
        $stmt = $pdo->prepare("Delete from person where id_p=?,name_p=?,surname=?,age=?,address=? ");
        $stmt->bindParam(1, $this->id_p, PDO::PARAM_INT);
        $stmt->bindParam(2, $this->name_p, PDO::PARAM_STR, 20);
        $stmt->bindParam(3, $this->surname, PDO::PARAM_INT, 30);
        $stmt->bindParam(4, $this->age, PDO::PARAM_INT,3);
        $stmt->bindParam(5, $this->adress, PDO::PARAM_STR,100);
        return $stmt->execute();
    }

    public function getById($pdo,$id_p): person
    {
        $stmt = $pdo->prepare("Select * from person where id_p = ? ");
        $stmt->bindParam(1, $id_p, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        return new Phone($row['id_p'],$row['name_p'],$row['surname'],$row['age'],$row['address']);
    }

    public function all($pdo): array
    {
        $stmt = $pdo->query("SELECT id_p,name_p,surname,age,address FROM person");
        $tableList = array();
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $tableList[] = array('id_p'=>$row['id_p'], 'name_p'=>$row['name_p'], 'surname'=>$row['surname'], 'age'=>$row['age'], 'address'=>$row['address']);
        }
        return $tableList;
    }

    public function getByField($fieldValue,$pdo): array
    {
        $stmt = $pdo->prepare("Select ? from person ");
        $stmt->bindParam(1, $fieldValue, PDO::PARAM_INT);
        $stmt->execute();
        $tableList = array();
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $tableList[] = array('id_p'=>$row['id_p'], 'name_p'=>$row['name_p'], 'surname'=>$row['surname'], 'age'=>$row['age'], 'address'=>$row['address']);
        }
        return $tableList;
    }


}


?>