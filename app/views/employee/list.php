<?php session_start(); ?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông Tin Nhân Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Reset margin & padding */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
        }

        /* Tiêu đề */
        .title {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            text-transform: uppercase;
            margin-bottom: 20px;
        }

        /* Bảng dữ liệu */
        .employee-table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            background: white;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            overflow: hidden;
        }

        /* Định dạng tiêu đề bảng */
        .employee-table thead {
            background: #007bff;
            color: white;
        }

        .employee-table th,
        .employee-table td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        /* Dòng chẵn có màu nền xám nhạt */
        .employee-table tbody tr:nth-child(even) {
            background: #f9f9f9;
        }

        /* Hover hiệu ứng */
        .employee-table tbody tr:hover {
            background: #e1f5fe;
        }

        /* Cột tiền lương in đậm */
        .employee-table td:last-child {
            font-weight: bold;
            color: #d9534f;
        }
    </style>
</head>

<body>
    <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px; background: #007bff; color: white;">
        <div>
            <?php if (isset($_SESSION['user'])): ?>
                <span>👋 Chào, <?= htmlspecialchars($_SESSION['user']['username']) ?>!</span>
            <?php else: ?>
                <span> Chào mừng bạn đến với hệ thống!</span>
            <?php endif; ?>
        </div>

        <div>
            <?php if (isset($_SESSION['user'])): ?>
                <a href="/Ktra/login/logout" style="color: white; text-decoration: none; padding: 8px 15px; background: red; border-radius: 5px;">Đăng xuất</a>
            <?php else: ?>
                <a href="/Ktra/login" style="color: white; text-decoration: none; padding: 8px 15px; background: green; border-radius: 5px;">Đăng nhập</a>
            <?php endif; ?>
        </div>
    </div>
    <h2 class="title">THÔNG TIN NHÂN VIÊN</h2>
    <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
        <div class="d-flex justify-content-end">
            <a href="/Ktra/Employee/add" class="btn btn-primary fw-bold px-4 py-2 shadow-sm rounded">+ Thêm Nhân Viên</a>
        </div>
    <?php endif; ?>
    <table class="employee-table">
        <thead>
            <tr>
                <th>Mã Nhân Viên</th>
                <th>Tên Nhân Viên</th>
                <th>Giới tính</th>
                <th>Nơi Sinh</th>
                <th>Tên Phòng</th>
                <th>Lương</th>
                <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                    <th>Hành động</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employees as $employee): ?>
                <tr>
                    <td><?= htmlspecialchars($employee['Ma_NV']) ?></td>
                    <td><?= htmlspecialchars($employee['Ten_NV']) ?></td>
                    <td>
                        <?php
                        $genderImg = "/Ktra/public/" . ($employee['Phai'] == 'NAM' ? 'man.jpg' : 'women.jpg');
                        ?>
                        <img src="<?= $genderImg ?>" alt="<?= htmlspecialchars($employee['Phai']) ?>" width="40" height="40">
                    </td>
                    <td><?= htmlspecialchars($employee['Noi_Sinh']) ?></td>
                    <td><?= $employee['Ten_Phong'] ?? 'Không xác định' ?></td>
                    <td><?= number_format($employee['Luong'], 0, ',', '.') ?></td>
                    <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                        <td class="action-buttons">
                            <a href="/Ktra/Employee/edit/<?= $employee['Ma_NV'] ?>" class="edit-btn">Sửa</a>
                            <a href="/Ktra/Employee/delete/<?= $employee['Ma_NV'] ?>" class="delete-btn" onclick="return confirm('Bạn có chắc chắn muốn xóa?');">Xóa</a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Phân trang -->
    <div class="pagination justify-content-center">
        <?php if ($page > 1): ?>
            <a href="?page=<?= $page - 1 ?>">&laquo; Trước</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?= $i ?>" class="<?= ($i == $page) ? 'active' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>

        <?php if ($page < $totalPages): ?>
            <a href="?page=<?= $page + 1 ?>">Tiếp &raquo;</a>
        <?php endif; ?>
    </div>

    <style>
        .pagination {
            margin-top: 20px;
            text-align: center;
        }

        .pagination a {
            display: inline-block;
            padding: 8px 12px;
            margin: 2px;
            border: 1px solid #007bff;
            color: #007bff;
            text-decoration: none;
            border-radius: 5px;
        }

        .pagination a.active {
            background-color: #007bff;
            color: white;
        }

        .pagination a:hover {
            background-color: #0056b3;
            color: white;
        }
    </style>

</body>

</html>