<?php
include "/xampp/htdocs/vcs/baigiamasiscrud/models/DB.php";
class Plant{
    public $id;
    public $nameLt;
    public $nameLatin;
    public $annual;
    public $age;
    public $height;

    
    public function __construct($id, $nameLt, $nameLatin, $annual, $age, $height) {
        $this->id = $id;
        $this->nameLt = $nameLt;
        $this->nameLatin = $nameLatin;
        $this->annual = $annual;
        $this->age = $age;
        $this->height = $height; 
    }
    public static function find($id)
    {

    $db = new DB();
    $sql = "SELECT * FROM `listed_plants` where `id` =". $id;
    $result = $db->conn->query($sql);

    while($row = $result->fetch_assoc()) {
        $plant = new Plant($row["id"], $row["name_lt"], $row["name_latin"], $row["annual"], $row["age"], $row["height"]);
    }
    $db->conn->close();
    return $plant;
    }

    public static function all()
    {
       $plants = [];
       $db = new DB();
       $sql = "SELECT * FROM `listed_plants`";
       $result = $db->conn->query($sql);

       while($row = $result->fetch_assoc()) {
           $plants[] = new Plant($row["id"], $row["name_lt"], $row["name_latin"], $row["annual"], $row["age"], $row["height"]);
       }
       $db->conn->close();
       return $plants;
    }

    public static function create(){
        $db = new DB();
        $stmt = $db->conn->prepare("INSERT INTO listed_plants (name_lt, name_latin, annual, age, height) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssiii", $_POST['nameLt'], $_POST['nameLatin'], $_POST['annual'], $_POST['age'], $_POST['height']);
        $stmt->execute();
        $stmt->close();
        $db->conn->close();
    }

    public static function update(){
        $db = new DB();
        $stmt = $db->conn->prepare("UPDATE listed_plants SET name_lt = ?, name_latin = ?, annual = ?, age = ?, height = ? WHERE id = ?");
        $stmt->bind_param("ssiiii", $_POST['nameLt'], $_POST['nameLatin'], $_POST['annual'], $_POST['age'], $_POST['height'], $_POST['id']);
        $stmt->execute();
        $stmt->close();
        $db->conn->close();
    }

    public static function destroy(){
        $db = new DB();
        $stmt = $db->conn->prepare("DELETE FROM listed_plants WHERE id = ?");
        $stmt->bind_param("i", $_POST['id']);
        $stmt->execute();
        $stmt->close();
        $db->conn->close();
    }
}
?>