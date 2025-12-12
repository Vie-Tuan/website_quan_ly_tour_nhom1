<?php
startSection();
$pageTitle = 'Tạo tuor mới';
$breadcrumbs = [
    ['label' => 'Quản lý tuor', 'url' => BASE_URL . 'tuor/index'],
    ['label' => "Tạo tuor mới", 'url' => BASE_URL, 'tuor/create', 'active' => true],
];
ob_start();
?>
<div class="row">
    <div class="col-mb-8">
        <div class="card">
            <div class="card-header bg-primry">
                <h5 class="card-title">Tạo tuor mới</h5>
            </div>
                <div class="card-body">
                    <?php if (isset($_SESSION('errors'))): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-circle"></i> <?= $_SESSION['error']?>
                            <button type="button" class= "btn-close" data-bs-dimiss="alert" aria-label="Close"></button>
                        </div>
                        <?php unset($_SESSION['errors']);?>
                    <?php endif; ?>
                    <form action="<?= BASE_URL?>tuor/store" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Tên Tour <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên Tour"   required>
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label fw-semibold">Vị trí <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="location" name="location" placeholder="Ví dụ: Hà Nội - Hạ Long"   required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label fw-semibold">Giá (VND)<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="price" name="price" step="1000" min="0" placeholder="Nhập giá tour" required>
                    </div>
                    <div class="mb-3">
                        <label for="num_reviewsphome" class="form-label fw-semibold">Số lượt đánh giá</label>
                        <input type="number" class="form-control" id="num_reviewsphome" name="num_reviews" min="0" value="0" placeholder="Nhập Số lượt đánh giá">
                    </div>
                    <div class="mb-3">
                        <label for="departure_date" class="form-label fw-semibold">Ngày khởi hành</label>
                        <textarea type="date" class="form-control" id="departure_date" name="departure_date" ></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label fw-semibold">Mô tả<span class="text-danger">*</span></label>
                        <input class="form-control" id="description" name="description" rows="5" placeholder="Nhập mô tả chi tiết về tuor" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Trạng thái</label>
                        <select class="form-control" id="status" name="status" >
                            <option value="1"selected>Hoạt động</option>
                            <option value="0">Không hoạt động</option>
                        </select>
                    </div>                     
                </div>
                <div class="card-d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="<?= BASE_URL ?>tour/index" class="btn btn-secondary"><i class="bi bi-x"></i>Hủy</a>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Tạo Tour</button>
                  </div>
                 </form>
            </div>
       </div>
    </div>
</div>

<?php
$content = ob_get_clean();
view('layouts/AdminLayout', [
    'title' => $pageTitle, ' - Website Quan lý tour',
    'pageTitle' => $pageTitle,
    'breadcrumbs' => $breadcrumbs,
    'content' => $content,
]);
?>