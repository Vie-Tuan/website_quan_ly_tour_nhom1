<?php
startSession();
$pageTitle = 'Chỉnh sửa Booking';
$breadcrumb = [
    ['label' => 'Danh sách Booking ', 'url' => BASE_URL . 'booking/index'],
    ['label' => 'Chỉnh sửa Booking ', 'url' => BASE_URL . 'booking/edit', 'active' => true],
];


$db = getDB();
$stmt = $db->prepare('SELECT * FROM tours WHERE status = 1 ORDER BY name ASC');
$stmt->execute();
$tours = $stmt->fetchAll(PDO::FETCH_ASSOC);

ob_start();
?>
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="card-title">Chỉnh sửa Booking</h3>
            </div>
            <form action="<?= BASE_URL ?>booking/update" method="POST">
                <div class="card-body">
                    <input type="hidden" name="id" value="<? htmlspecialchars($bookingData['id'] ?? '') ?>">
                    <input type="hidden" name="tour_id" value="<? htmlspecialchars($bookingData['tour_id'] ?? '') ?>">

                    <div class="mb-3">
                        <label for="tour_id" class="form-label">Tour</label>
                        <input type="text" class="form-control" disabled
                            value="<?= htmlspecialchars($tour['name'] ?? '') ?>">
                    </div>

                    <div class="mb-3">
                        <label for="customer_name" class="form-label">Tên khách hàng <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="customer_name" name="customer_name"
                            placeholder="Nhập tên khách hàng" required>
                    </div>

                    <div class="mb-3">
                        <label for="customer_email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="customer_email" name="customer_name"
                            placeholder="Nhập email" required>
                    </div>

                    <div class="mb-3">
                        <label for="customer_phone" class="form-label">Số điện thoại <span
                                class="text-danger">*</span></label>
                        <input type="tel" class="form-control" id="customer_phone" name="customer_phone"
                            placeholder="Nhập số điện thoại" required>
                    </div>

                    <div class="mb-3">
                        <label for="num_people" class="form-label">Số người <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="num_people" name="num_people" min="1" value="=1"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="booking_date" class="form-label">Ngày Booking</label>
                        <input type="date" class="form-control" id="booking_date" name="booking_date"
                            value="<?= date('Y-m-d') ?>">
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Trạng thái</label>
                        <select name="status" id="status" class="form-select">
                            <option value="cho_xac_nhan" <? ($bookingData['status'] ?? '') === 'cho_xac_nhan' ? 'selected' : '' ?>>Chờ xác nhận</option>
                            <option value="da_xac_nhan" <? ($bookingData['status'] ?? '') === 'da_xac_nhan' ? 'selected' : '' ?>>Đã xác nhận</option>
                            <option value="da_huy" <? ($bookingData['status'] ?? '') === 'da_huy' ? 'selected' : '' ?>>Đã hủy</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="notes" class="form-label">Ghi chú</label>
                        <textarea class="form-control" id="notes" name="notes" name="notes" rows="3"
                            placeholder="Nhập ghi chú"></textarea>
                    </div>

                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Cập nhật
                    </button>
                    <a href="<?= BASE_URL ?>booking/index" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Quay lại
                    </a>
                </div>

            </form>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
view('layouts/AdminLayout', [
    'title' => $pageTitle . '- Website Quản lý Tour',
    'pageTitle' => $pageTitle,
    'breadcrumb' => $breadcrumb,
    'content' => $content,
])
    ?>