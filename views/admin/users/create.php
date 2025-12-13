<?php

startSession();
$pageTitle = 'Thêm hướng dẫn viên';
$breadcrumbs = [
    ['label' => 'Quản lý hướng dẫn viên', 'url' => BASE_URL . 'guide/index', 'active' => false],
    ['label' => $pageTitle, 'url' => BASE_URL, 'guide/active' => true],
];
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);

ob_start();
?>
<div class="row">
    <div class="col-mb-8">
        <div class="card">
            <div class="card-header bg-primary">
                <h5 class="card-title">Thêm hướng dẫn viên mới</h5>
                </div>
            <form action="<?= BASE_URL ?>guide/store" method="post">
                <div class="card-body">
                    <?php if (!empty($errors)): ?>
                        <div class="alert alert-danger" role="alert">
                            <i class="bi bi-exclamation-circle"></i> Vui lòng sửa các lỗi sau:
                            <ul class="mb-0 ps-3">
                                <?php foreach ($errors as $error): ?>
                                    <li><?= htmlspecialchars(string: $error) ?></li>
                                <?php endforeach; ?>
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>
                    <div class="mb-3">
                        <label for="guideName" class="form-label fw-semibold">Tên hướng dẫn viên <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên hướng dẫn viên" required>
                        </div>
                    <div class="mb-3">
                        <label for="guideEmail" class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" required>
                        </div>
                    <div class="mb-3">
                        <label for="guidePassword" class="form-label fw-semibold">Mật Khẩu <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" required>
                        <small class="text-muted">Mật khẩu tối thiểu 6 ký tự</small>
                        </div>
                    <div class="mb-3">
                        <label for="guidePhone" class="form-label fw-semibold">Số điện thoại</label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại">
                        </div>
                    <div class="mb-3">
                        <label for="guideExperience" class="form-label fw-semibold">Kinh nghiệm</label>
                        <textarea class="form-control" id="experience" name="experience" rows="3" placeholder="Nhập kinh nghiệm hướng dẫn"></textarea>
                        </div>
                    </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-check-circle"></i> Tạo hướng dẫn viên
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
view(view: 'layouts/AdminLayout', data: [
    'pageTitle' => $pageTitle,
    'breadcrumbs' => $breadcrumbs,
    'content' => $content,
]);
?>


