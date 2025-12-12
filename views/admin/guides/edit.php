<?php
startSection();
$pageTitle = 'Chỉnh sửa hướng dẫn viên';
$breadcrumbs = [
    ['label' => 'Quản lý hướng dẫn viên', 'url' => BASE_URL . 'guide/index', 'active' => false],
    ['label' => $pageTitle, 'url' => '#', 'active' => true],
];
ob_start();
?>
<div class="row">
    <div class="col-mb-8">
        <div class="card">
            <div class="card-header bg-primry">
                <h5 class="card-title">Chỉnh sửa hướng dẫn viên</h5>
            </div>
            <form action="<?= BASE_URL ?>guide/update" method="post">
                <div class="card-body">
                    <input type="hidden" name="id" value="<?= htmlspecialchars($guide['id'] ?? '') ?>" />
                    <div class="mb-3">
                        <label for="guideName" class="form-label fw-semibold">Tên hướng dẫn viên <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($guide['name'] ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="guideEmail" class="form-label fw-semibold">Email<span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($guide['email'] ?? '') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="guidePhone" class="form-label fw-semibold">Số điện thoại</label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại">
                    </div>
                    <div class="mb-3">
                        <label for="guideExperience" class="form-label fw-semibold">Kinh nghiệm</label>
                        <textarea type="text" class="form-control" id="experience" name="experience" rows="3" placeholder="Nhập kinh nghiệm hướng dẫn"></textarea>
                    </div> 
                    <div class="alert alert-info">
                        <i class="bi bi-info-circle"></i> Để thay đổi mật khẩu, vui lòng liên hệ quảntrị viên.

                    </div>                   
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-cỉcle"></i> Cập nhật hướng dẫn viên
                    </button>
                    <a href="<?= BASE_URL ?>guide/index" class="btn btn-secondary">
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
    'title' => $pageTitle . ' - Website Quản Lý Tour',
    'pageTitle' => $pageTitle,
    'breadcrumb' => $breadcrumb,
    'content' => $content,
]);
?>
