<?php
startSection();
$pageTitle = 'Chỉnh sửa tour';
$breadcrumbs = [
    ['label' => 'Quản lý tour', 'url' => BASE_URL . 'tour/index'],
    ['label' => 'Chỉnh sửa tour', 'url' => BASE_URL , 'tour/edit?id=' . $tour['id'], 'active' => true],
];
ob_start();
?>
<div class="row">
    <div class="col-mb-8 offset-md-2">
        <div class="card">
            <div class="card-header bg-primry">
                <h3 class="card-title">Chỉnh sửa tour- <?= htmlspecialchars($tour['name'])?></h3>
            </div>
            <div class="card-body">
                    <?php if (isset($_SESSION('errors'))): ?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-circle"></i> <?= $_SESSION['error']?>
                            <button type="button" class= "btn-close" data-bs-dimiss="alert" aria-label="Close"></button>
                        </div>
                        <?php unset($_SESSION['errors']);?>
                    <?php endif; ?>
                    <form action="<?= BASE_URL?>tuor/update" method="POST">
                        <input type="hidden" name="id" value="<?= $tour['id']?>">
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Tên Tour <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" value="<?=htmlspecialchars($tour['name']) ?>" placeholder="Nhập tên Tour"   required>
                    </div>
                    <div class="mb-3">
                        <label for="location" class="form-label fw-semibold">Vị trí <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="location" name="location"value="<?=htmlspecialchars($tour['location']) ?> placeholder="Ví dụ: Hà Nội - Hạ Long"   required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label fw-semibold">Giá (VND)<span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="price" name="price" step="1000" min="0"<?=$tour['price']?>  placeholder="Nhập giá tour" required>
                    </div>
                    <div class="mb-3">
                        <label for="num_reviewsphome" class="form-label fw-semibold">Số lượt đánh giá</label>
                        <input type="number" class="form-control" id="num_reviewsphome" name="num_reviews" min="0" value="<?=htmlspecialchars($tour['name'] ?? 0) ?>" placeholder="Nhập Số lượt đánh giá">
                    </div>
                    <div class="mb-3">
                        <label for="departure_date" class="form-label fw-semibold">Ngày khởi hành</label>
                        <input type="date" class="form-control" id="departure_date" name="departure_date" value="<?=htmlspecialchars($tour['departure_date'] ?? '') ?>" >
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label fw-semibold">Mô tả<span class="text-danger">*</span></label>
                        <textarea  class="form-control" id="description" name="description" rows="5" placeholder="Nhập mô tả chi tiết về tuor" required></textarea> <?=htmlspecialchars($tour['departure_date'] ?? '') ?></textarea>
                    </div> 
                    <div class="mb-3">
                        <label for="status" class="form-label">Trạng thái</label>
                        <select class="form-control" id="status" name="status" >
                            <option value="1"<?= $tour['status'] == 1 ? 'selected': '' ?>>Hoạt động</option>
                            <option value="0"<?= $tour['status'] == 0 ? 'selected': '' ?>>Không hoạt động</option>
                        </select>
                    </div>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="<?= BASE_URL ?>tour/index" class="btn btn-secondary"><i class="bi bi-x"></i>Hủy</a>
                        <button type="submit" class="btn btn-primary"><i class="bi bi-check-circle"></i> Cập nhật Tour</button>
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
    'breadcrumb' => $breadcrumb,
    'content' => $content,
]);
 ?>
 