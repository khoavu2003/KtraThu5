<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chỉnh Sửa Nhân Viên</title>
    <style>
        form { width: 50%; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; }
        label { font-weight: bold; display: block; margin-top: 10px; }
        input, select { width: 100%; padding: 8px; margin-top: 5px; }
        button { margin-top: 15px; padding: 10px; background: #ffc107; color: white; border: none; cursor: pointer; }
        button:hover { background: #e0a800; }
    </style>
</head>
<body>

    <h2 style="text-align:center">Chỉnh Sửa Nhân Viên</h2>

    <form action="/Ktra/Employee/update" method="POST">
        <input type="hidden" name="Ma_NV" value="<?= $employee['Ma_NV'] ?>">

        <label for="Ten_NV">Tên Nhân Viên:</label>
        <input type="text" id="Ten_NV" name="Ten_NV" value="<?= $employee['Ten_NV'] ?>" required>

        <label>Giới Tính:</label>
        <select name="Phai">
            <option value="NAM" <?= $employee['Phai'] == 'NAM' ? 'selected' : '' ?>>Nam</option>
            <option value="NU" <?= $employee['Phai'] == 'NU' ? 'selected' : '' ?>>Nữ</option>
        </select>

        <label for="Noi_Sinh">Nơi Sinh:</label>
        <input type="text" id="Noi_Sinh" name="Noi_Sinh" value="<?= $employee['Noi_Sinh'] ?>" required>

        <label for="Ma_Phong">Phòng Ban:</label>
        <select id="Ma_Phong" name="Ma_Phong">
            <?php foreach ($departments as $department): ?>
                <option value="<?= $department['Ma_Phong'] ?>" <?= $employee['Ma_Phong'] == $department['Ma_Phong'] ? 'selected' : '' ?>>
                    <?= $department['Ten_Phong'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="Luong">Lương:</label>
        <input type="number" id="Luong" name="Luong" value="<?= $employee['Luong'] ?>" required>

        <button type="submit">Cập Nhật</button>
    </form>

</body>
</html>
