<?php
class GuideController
{
    public function index()
    {
        requireLoin();
        
        $db = getDB();
        $stmt = $db->prepare('SELECT * FROM users WHERE role = ? ORDER BY created_at DESC');
        $stmt->execute(['huong_dan_vien']);
        $guides = $stmt->fetchAll(PDO::FETCH_ASSOC);

        include BASE_PATH . 'views/admin/guides/index.php';
    }

    public function create()
    {
        requireLoin();
        isAdmin();
        include BASE_PATH . 'views/admin/guides/create.php';
    }
    public function store()
    {
        requireLoin();
        isAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('guide/index');
        }
        $errors = [];
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $experience = trim($_POST['experience'] ?? '');

        $errors = [];

        if (empty($name)) {
            $errors[] = 'Vui lòng nhập tên hướng dẫn viên';
        }

        if (empty($email)) {
            $errors[] = 'Vui lòng nhập email';
        }

        if (empty($password)) {
            $errors[] = 'Vui lòng nhập mật khẩu';
        } 

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            redirect('guide/create');
        }
        $db = getDB();

        try {
            $stmt = $db->prepare('INSERT INTO users (name, email, password, role, status) VALUES (?, ?, ?, ?, 1)');
            $stmt->execute([$name, $email, $password, 'huong_dan_vien']);

            $_SESSION['success'] = 'Tạo hướng dẫn viên thành công.';
            redirect('guide/index');
        } catch (PDOException $e) {
            if (strpos($e->getMessage(), 'Duplicate entry') !== false) {
            $_SESSION['error']= 'Email này đã tồn tại. Vui lòng sử đụng email khác.';
        }else {
            $_SESSION['error']= 'lỗi:' $e->getMessage();
        }
        redirect('guide/create');
    }
}
public function edit(){
        requireLoin();
        isAdmin();
        $id = $_GET['id'] ?? null;
        if (!$id){
        redirect('guide/index');
        }
        $db = getDB();
        $stmt = $db->prepare('SELECT * FROM users WHERE id = ? AND role = ?');
        $stmt->execute([$id, 'huong_dan_vien']);
        $guides = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$guides) {
            $_SESSION['error']= 'Huớng dẫn viên không tồn tại.';
            redirect('guide/index');
        }
        include BASE_PATH . 'views/admin/guides/edit.php';
}
public function updata()
{
        requireLoin();
        isAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('guide/index');
        }
        $id = $_POST['id'] ?? null;
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $experience = trim($_POST['experience'] ?? '');

        if (!$id || empty($name) || empty($email)) {
            $_SESSION['error'] = 'Thông tin không hợp lệ';
            redirect('guide/index');
        }

        $db = getDB();

        try {
            $stmt = $db->prepare('UPDATE users SET name = ?, email, status = 1 WHERE id = ? AND role = ?');
            $stmt->execute([$name, $email, $password, 'huong_dan_vien']);

            $_SESSION['success'] = 'Cập nhập hướng dẫn viên thành công.';
            redirect('guide/index');
        } catch (PDOException $e) {
            $_SESSION['error']='Lỗi:' . $e->getMessage();
            redirect('guide/edit?id=' . $id);
}
}
public function delete()
{
        requireLoin();
        isAdmin();
        $id = $_GET['id'] ?? null;
        if (!$id) {
            redirect('guide/index');
        }

        $db = getDB();

        try {
            $stmt = $db->prepare('DELETE FROM users WHERE id = ? AND role = ?');
            $stmt->execute([$id, 'huong_dan_vien']);
            
            $_SESSION['success'] = 'Xóa hướng dẫn viên thành công!';
            redirect('guide/index');
        } catch (PDOException $e) {
            $_SESSION['error'] = 'Lỗi: ' . $e->getMessage();
        }
        redirect('guide/index');
}

}