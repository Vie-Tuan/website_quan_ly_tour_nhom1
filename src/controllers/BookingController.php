<?php
class BookingController
{
    public function index()
    {
        requireLogin();

        $tour_id = $_GET['tour_id'] ?? null;
        $bookings = new booking();

        if ($tour_id){
            $tour_id = $_GET['tour_id'];
            $bookings = new Booking();
        } else {
            $bookings = $Booking->all();
            $tour = null;
        }
        include BASE_PATH . 'views/admin/bookings/index.php'
    }

        public function create()
        {
        requireLogin();
        isAdmin();
        $tour_id = $_GET['tour_id'] ?? null;
        $tuor = $tour_id ? (new Tour())->find($tour_id) : null;
        include BASE_PATH . 'views/admin/bookings/create.php'
        }

 public function store()
    {
        requireLoin();
        isAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('booking/index');
        }
        $errors = [];
        $tour_id = $_POST['tour_id'] ?? null ;
        $customer_name = trim($_POST['customer_name'] ?? '');
        $customer_email = trim($_POST['customer_email'] ?? '');
        $customer_phone = trim($_POST['customer_phone'] ?? '');
        $num_people = $_POST['num_people'] ?? 1 ;
        $booking_date = $_POST['booking_date'] ?? date('Y-m-d');
        

        $errors = [];

        if (!$tour_id) {
            $errors[] = 'Tour không được để trống';
        }

        if (empty($customer_name)) {
            $errors[] = 'Tên khách hàng không được để trống';
        }

        if (empty($customer_email)) {
            $errors[] = 'Email không được để trống';
        } 
        if (empty($customer_phone)) {
            $errors[] = 'Số điện thoại không được để trống';
        } 

        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            redirect('booking/create?tour_id=' . $tour_id);
        }
        $booking = new Booking();

        try {
            $booking->create([
                'tour_id' => $tour_id,
                'customer_name' => $customer_name,
                'customer_email' => $customer_email,
                'customer_phone' => $customer_phone,
                'num_people' => $num_people,
                'booking_date' => $booking_date,
                'status' => 'cho_xac_nhan',
                'notes' => $_POST['notes'] ?? ''
            ])
            $_SESSION['success'] = 'Tạo bookinh thành công.';
            redirect('booking/index?tour_id=' . $tour_id);
        } catch (PDOException $e) {
        $_SESSION['error']= 'lỗi:' $e->getMessage();
        redirect('booking/create?tour_id=' . $tour_id);
    }
}
public function edit(){
        requireLoin();
        isAdmin();
        $id = $_GET['id'] ?? null;
        if (!$id){
        redirect('booking/index');
        }
        $booking = new Booking();
        $bookingDate = $booking->find($id);
        if (!$bookingDate) {
            $_SESSION['error']= 'Booking không tồn tại.';
            redirect('booking/index');
        }
        $tour = (new Tour())->find($bookingDate['tour_id'])
        include BASE_PATH . 'views/admin/bookings/edit.php';
}
public function updata()
{
        requireLoin();
        isAdmin();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            redirect('booking/index');
        }
        $id = $_POST['id'] ?? null;
        $tour_id = $_POST['tour_id'] ?? null;
        $customer_name = trim($_POST['customer_name'] ?? '');
        $customer_email = trim($_POST['customer_email'] ?? '');
        $customer_phone = trim($_POST['phocustomer_phonene'] ?? '');
        $num_people = $_POST['num_people'] ?? 1;
        $booking_date = $_POST['booking_date'] ?? date('Y-m-d');
        $status = $_POST['status'] ?? 'cho_xac_nhan';

        if (!$id || !$tour_id || empty($customer_name)) {
            $_SESSION['error'] = 'Thông tin không hợp lệ';
            redirect('booking/index');
        }

        $booking = new Booking();

        try {
            $booking->updata([
                'customer_name' => $customer_name,
                'customer_email' => $customer_email,
                'customer_phone' => $customer_phone,
                'num_people' => $num_people,
                'booking_date' => $booking_date,
                'status' => $status,
                'notes' => $_POST['notes'] ?? ''
            ])

            $_SESSION['success'] = 'Cập nhập booking thành công.';
            redirect('booking/index?tour_id=' . $tour_id);
        } catch (PDOException $e) {
            $_SESSION['error']='Lỗi:' . $e->getMessage();
            redirect('booking/edit?id=' . $id);
}
}
public function delete()
{
        requireLoin();
        isAdmin();
        $id = $_GET['id'] ?? null;
        if (!$id) {
            redirect('booking/index');
        }

        $booking = new Booking();
        $bookingDate = $booking->find($id);
        $tour_id = $bookingDate ? $bookingDate['tour_id'] ?? null;

        try {
            $booking->delete($id);
            
            $_SESSION['success'] = 'Xóa booking thành công!';
        } catch (PDOException $e) {
            $_SESSION['error'] = 'Lỗi: ' . $e->getMessage();
        }
        redirect('booking/index' . ($tour_id ? '?tour_id=' . $tour_id : ''  ));
}
public function updeteStatus()
{
    requireLogin();
    isAdmin();

    $id = $_POST['id'] ?? null;
    $status = $_POST['status'] ?? null;
    $tour_id = $_POST['tour_id'] ?? null;

    if (!$id || !$status) {
        $_SESSION['error'] = 'Thông tin không hợp lệ.';
    }else {
        $booking = new Booking();
        $booking->updateStatus($id, $status);
        $_SESSION['success'] = 'Cập nhập trạng thái thành công!';
    }
    redirect('booking/index' . ($tour_id ? '?tour_id=' . $tour_id : ''  ));

}


}