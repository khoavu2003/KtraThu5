<?php
require_once('app/config/database.php');
require_once('app/models/EmployeeModel.php');
require_once('app/models/DepartmentModel.php');

class EmployeeController
{
    private $employeeModel;
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->employeeModel = new EmployeeModel($this->db);
    }

    public function index()
    {
        $limit = 5; // Số nhân viên mỗi trang
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $offset = ($page - 1) * $limit;

        // Lấy danh sách nhân viên theo phân trang
        $employees = $this->employeeModel->getEmployeesWithPagination($limit, $offset);
        $totalEmployees = $this->employeeModel->countEmployees();
        $totalPages = ceil($totalEmployees / $limit);

        include 'app/views/employee/list.php';
    }

    public function show($id)
    {
        $employee = $this->employeeModel->getEmployeeById($id);

        if ($employee) {
            include 'app/views/employee/show.php';
        } else {
            echo "Không tìm thấy nhân viên.";
        }
    }

    public function add()
    {
        $departments = (new DepartmentModel($this->db))->getDepartments();
        include 'app/views/employee/add.php';
    }

    public function save()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'Ma_NV' => trim($_POST['Ma_NV']),
                'Ten_NV' => trim($_POST['Ten_NV']),
                'Phai' => $_POST['Phai'],
                'Noi_Sinh' => trim($_POST['Noi_Sinh']),
                'Ma_Phong' => $_POST['Ma_Phong'],
                'Luong' => $_POST['Luong']
            ];

            if (!empty($data['Ma_NV']) && !empty($data['Ten_NV']) && !empty($data['Noi_Sinh'])) {
                $this->employeeModel->addEmployee($data);
                header('Location: /Ktra/Employee');

                exit;
            } else {
                echo "Vui lòng nhập đầy đủ thông tin.";
            }
        }
    }

    public function edit($id)
    {
        $employee = $this->employeeModel->getEmployeeById($id);
        $departments = (new DepartmentModel($this->db))->getDepartments();

        if ($employee) {
            include 'app/views/employee/edit.php';
        } else {
            echo "Không tìm thấy nhân viên.";
        }
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['Ma_NV'];
            $data = [
                'Ten_NV' => $_POST['Ten_NV'],
                'Phai' => $_POST['Phai'],
                'Noi_Sinh' => $_POST['Noi_Sinh'],
                'Ma_Phong' => $_POST['Ma_Phong'],
                'Luong' => $_POST['Luong']
            ];

            $update = $this->employeeModel->updateEmployee($id, $data);

            if ($update) {
                header('Location: /Ktra/Employee');
            } else {
                echo "Đã xảy ra lỗi khi cập nhật thông tin nhân viên.";
            }
        }
    }

    public function delete($id)
    {
        if ($this->employeeModel->deleteEmployee($id)) {
            header('Location: /Ktra/Employee');
        } else {
            echo "Đã xảy ra lỗi khi xóa nhân viên.";
        }
    }
}
