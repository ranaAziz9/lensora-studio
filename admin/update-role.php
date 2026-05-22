<?php
require_once "../includes/auth.php";
require_once "../includes/db.php";

// 1. التأكد أن الطلب POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // 2. التحقق من وجود المتغيرات
    if (isset($_POST['user_id']) && isset($_POST['new_role'])) {
        
        $userId = $_POST['user_id'];
        $newRole = $_POST['new_role'];

        // 3. تحديث البيانات في قاعدة البيانات
        $stmt = $pdo->prepare("UPDATE users SET role = ? WHERE id = ?");
        $stmt->execute([$newRole, $userId]);

        // 4. إعادة التوجيه لصفحة المستخدمين
        header("Location: users.php");
        exit();
    }
}
?>