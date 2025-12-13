<?php
startSection();
$pageTitle = 'Tạo tour mới';
$breadcrumbs = [
    ['label' => 'Quản lý tour', 'url' => BASE_URL . 'tour/index'],
    ['label' => 'Tạo tour mới', 'url' => BASE_URL . 'tour/create', 'active' => true],
];
ob_start();
?>
<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="card-title">Tạo tour mới</h5>
            </div>
                <div class="card-body">
                    <?php if (isset($_SESSION['error'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-circle"></i> <?= htmlspecialchars($_SESSION['error']) ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        <?php unset($_SESSION['error']); ?>
                    <?php endif; ?>
                    <form action="<?= BASE_URL ?>tour/store" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Tên Tour <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên Tour" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label fw-semibold">Vị trí <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="location" name="location" placeholder="Ví dụ: Hà Nội - Hạ Long" value="<?= htmlspecialchars($_POST['location'] ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label fw-semibold">Giá (VND)<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="price" name="price" step="1000" min="0" placeholder="Nhập giá tour" value="<?= htmlspecialchars($_POST['price'] ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="num_reviews" class="form-label fw-semibold">Số lượt đánh giá</label>
                        <input type="number" class="form-control" id="num_reviews" name="num_reviews" min="0" value="<?= htmlspecialchars($_POST['num_reviews'] ?? 0) ?>" placeholder="Nhập Số lượt đánh giá">
                    </div>
                    <div class="mb-3">
                        <label for="departure_date" class="form-label fw-semibold">Ngày khởi hành</label>
                        <input type="date" class="form-control" id="departure_date" name="departure_date" value="<?= htmlspecialchars($_POST['departure_date'] ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label fw-semibold">Mô tả<span class="text-danger">*</span></label>
                        <textarea class="form-control" id="description" name="description" rows="5" placeholder="Nhập mô tả chi tiết về tour" required><?= htmlspecialchars($_POST['description'] ?? '') ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Trạng thái</label>
                        <select class="form-control" id="status" name="status" >
                            <option value="1" <?= (!isset($_POST['status']) || $_POST['status'] == '1') ? 'selected' : '' ?>>Hoạt động</option>
                            <option value="0" <?= (isset($_POST['status']) && $_POST['status'] == '0') ? 'selected' : '' ?>>Không hoạt động</option>
                        </select>
                    </div>                     
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="<?= BASE_URL ?>tour/index" class="btn btn-secondary"><i class="bi bi-x"></i> Hủy</a>
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
    'title' => $pageTitle . ' - Website Quản Lý Tour',
    'pageTitle' => $pageTitle,
    'breadcrumbs' => $breadcrumbs,
    'content' => $content,
]);
?>