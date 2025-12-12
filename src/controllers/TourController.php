<?php
class TourController
{
    private $tourModel;
    public function __construct()
    {
        $this->tourModel = new Tour();
    }
     public function index()
     {
        if (!isLoggedIn()){
            header('Location:' . BASE_URL . 'welcome');
            exit;
        }

        $tours = $this->tourModel->all();
         view('admin/tours/index',[
            'title' => 'Danh sách Tour - Website quản lý tuor',
            'tours' => $tours,
         ]);
     }

     public function create()
     {
        if (!isLoggedIn()){
            
        }header('Location:' . BASE_URL . 'welcome');
            exit;
        $curentUser = getCurrentUser();
        if (!$currentUser->isAdmin()) {
            http_response_code(403);
            view('not_found',[
                'title' => '403 - Forbidden',
            ]);
            exit;
        }
        view('admin/tuors/create',[
                'title' => 'Tạo tour mới - Website quản lý tour',
        ]);
     }
     public function store()
     {
        if (!isLoggedIn()) {
            header('Location:' . BASE_URL . 'welcome');
            exit;
        }
        $currentUser = getCurrentUser();
        if (!$currentUser->isAdmin()) {
            http_response_code(403);
            exit;
        }
        if ($_SESSION['REQUEST_METHOD'] !== 'POST') {
            header('Location:' . BASE_URL . 'tour/create');
            exit;
        }
        $data = [
            'name' => $_POST['name'] ?? '',
            'description' => $_POST['description'] ?? '',
            'price' => $_POST['price'] ?? 0,
            'location' => $_POST['location'] ?? '',
            'status' => $_POST['status'] ?? 1,
        ];

        if (!$data['name'] || !$data['description'] || !$data['price'] || !$data['location'] ) {
            $_SESSION['error'] = 'Vui lòng điền đầy đủ thông tin.';
            header('Location:' . BASE_URL . 'tour/index');
            exit;
        }

        $data['price'] = (float)$data['price'];
        $data['status'] = (int)$data['status'];

        if ($this->tourModel->create($data)) {
            $_SESSION['success'] = 'Tạo tuor thành công';
            header('Location:' . BASE_URL . 'tour/index');
        } else {
            $_SESSION['error'] = 'Tạo tuor thất bại.';
            header('Location:' . BASE_URL . 'tour/create');
        }
        exit;
     } 

     public function edit(){

        if (!isLoggedIn()) {
            header('Location:' . BASE_URL . 'welcome');
            exit;
        }
        $currentUser = getCurrentUser();
        if (!$currentUser->isAdmin()) {
            http_response_code(403);
            view('not_found', [
                'title' => 'Truy cập bị từ chối',
            ]);
            exit;
        }
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location:' . BASE_URL . 'tour/index');
            exit;
     }

     $tour = $this->tourModel->find($id);
     if (!$tour) {
         http_response_code(404);
            view('not_found', [
                'title' => 'Không tìm thấy tour',
            ]);
            exit;
     }
     view('admin/tuors/create',[
        'title' => 'Chỉnh sửa tour - Website quản lý tour',
        'tour' => $tour,
        ]);
}

public function update()
{
    if (!isLoggedIn()) {
        header('Location:' . BASE_URL . 'welcome');
        exit;
    }
    $currentUser = getCurrentUser();
    if (!$currentUser->isAdmin()) {
        http_response_code(403);
        exit;
}
        if ($_SESSION['REQUEST_METHOD'] !== 'POST') {
            header('Location:' . BASE_URL . 'tour/index');
            exit;
        }
        $id = $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['error'] = 'ID tour không hợp lệ.'
            header('Location:' . BASE_URL . 'tour/index');
            exit;
     }
             $data = [
            'name' => $_POST['name'] ?? '',
            'description' => $_POST['description'] ?? '',
            'price' => $_POST['price'] ?? 0,
            'location' => $_POST['location'] ?? '',
            'status' => $_POST['status'] ?? 1,
        ];
if (!$data['name'] || !$data['description'] || !$data['price'] || !$data['location'] ) {
            $_SESSION['error'] = 'Vui lòng điền đầy đủ thông tin.';
            header('Location:' . BASE_URL . 'tour/edit?id=' . $id);
            exit;
}
        $data['price'] = (float)$data['price'];
        $data['status'] = (int)$data['status'];

        if ($this->tourModel->update($id, $data)) {
            $_SESSION['success'] = 'Cập nhật tour thành công';
            header('Location: ' . BASE_URL . 'tour/index');
        } else {
            $_SESSION['error'] = 'Cập nhật tour thất bại';
            header('Location: ' . BASE_URL . 'tour/edit?id=' . $id);
        }
        exit;
}

public function delete()
{
if (!isLoggedIn()) {
        header('Location:' . BASE_URL . 'welcome');
        exit;
    }
    $currentUser = getCurrentUser();
    if (!$currentUser->isAdmin()) {
        http_response_code(403);
        exit;
}
       $id = $_GET['id'] ?? null;
        if (!$id) {
            $_SESSION['error'] = 'ID tour không hợp lệ.'
            header('Location:' . BASE_URL . 'tour/index');
            exit;
}
if ($this->tourModel->delete($id)) {
    $_SESSION['success'] = 'Xóa tuor thành công';
} else {
    $_SESSION['error'] = 'Xóa tuor thất bại';

}
        header('Location:' . BASE_URL . 'tour/index');
        exit;
}
}