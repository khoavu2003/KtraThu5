<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Nhân Viên</title>
    <style>
        form { width: 50%; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; }
        label { font-weight: bold; display: block; margin-top: 10px; }
        input, select { width: 100%; padding: 8px; margin-top: 5px; }
        button { margin-top: 15px; padding: 10px; background: #28a745; color: white; border: none; cursor: pointer; }
        button:hover { background: #218838; }
    </style>
</head>
<body>

    <h2 style="text-align:center">Thêm Nhân Viên</h2>

    <form action="/Ktra/Employee/save" method="POST">
        <label for="Ma_NV">Mã Nhân Viên:</label>
        <input type="text" id="Ma_NV" name="Ma_NV" required>

        <label for="Ten_NV">Tên Nhân Viên:</label>
        <input type="text" id="Ten_NV" name="Ten_NV" required>

        <label>Giới Tính:</label>
        <select name="Phai">
            <option value="NAM">Nam</option>
            <option value="NU">Nữ</option>
        </select>

        <label for="Noi_Sinh">Nơi Sinh:</label>
        <input type="text" id="Noi_Sinh" name="Noi_Sinh" required>

        <label for="Ma_Phong">Phòng Ban:</label>
        <select id="Ma_Phong" name="Ma_Phong">
            <?php foreach ($departments as $department): ?>
                <option value="<?= $department['Ma_Phong'] ?>"><?= $department['Ten_Phong'] ?></option>
            <?php endforeach; ?>
        </select>

        <label for="Luong">Lương:</label>
        <input type="number" id="Luong" name="Luong" required>

        <button type="submit">Thêm Nhân Viên</button>
    </form>

</body>
</html>
