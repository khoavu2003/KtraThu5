<?php
class DepartmentModel
{
    private $conn;
    private $table = "PHONGBAN";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getDepartments()
    {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
