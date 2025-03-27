<?php
class EmployeeModel
{
    private $conn;
    private $table = "NHANVIEN";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getEmployees()
    {
        $sql = "SELECT 
                    NhanVien.MA_NV AS Ma_NV, 
                    NhanVien.TEN_NV AS Ten_NV, 
                    NhanVien.PHAI AS Phai, 
                    NhanVien.NOI_SINH AS Noi_Sinh, 
                    NhanVien.LUONG AS Luong, 
                    PhongBan.Ten_Phong AS Ten_Phong 
                FROM NhanVien
                LEFT JOIN PhongBan ON NhanVien.MA_PHONG = PhongBan.Ma_Phong";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEmployeeById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE Ma_NV = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function addEmployee($data)
    {
        $query = "INSERT INTO " . $this->table . " (Ma_NV, Ten_NV, Phai, Noi_Sinh, Ma_Phong, Luong) 
                  VALUES (:Ma_NV, :Ten_NV, :Phai, :Noi_Sinh, :Ma_Phong, :Luong)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

    public function updateEmployee($id, $data)
    {
        $query = "UPDATE " . $this->table . " 
                  SET Ten_NV = :Ten_NV, Phai = :Phai, Noi_Sinh = :Noi_Sinh, Ma_Phong = :Ma_Phong, Luong = :Luong 
                  WHERE Ma_NV = :Ma_NV";
        $stmt = $this->conn->prepare($query);
        $data['Ma_NV'] = $id;
        return $stmt->execute($data);
    }

    public function deleteEmployee($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE Ma_NV = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
    public function getEmployeesWithPagination($limit, $offset)
    {
        $query = "SELECT 
                    NhanVien.MA_NV AS Ma_NV, 
                    NhanVien.TEN_NV AS Ten_NV, 
                    NhanVien.PHAI AS Phai, 
                    NhanVien.NOI_SINH AS Noi_Sinh, 
                    NhanVien.LUONG AS Luong, 
                    PhongBan.Ten_Phong AS Ten_Phong 
                FROM NhanVien
                LEFT JOIN PhongBan ON NhanVien.MA_PHONG = PhongBan.Ma_Phong LIMIT :limit OFFSET :offset";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function countEmployees()
    {
        $sql = "SELECT COUNT(*) AS total FROM nhanvien";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }
}
