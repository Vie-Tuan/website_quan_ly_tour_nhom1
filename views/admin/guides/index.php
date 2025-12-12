<?php
startSection();
$pageTitle = 'Danh sách hướng dẫn viên';
$breadcrumbs = [
    ['label' => 'Quản lý hướng dẫn viên', 'url' => BASE_URL . 'guide/index', 'active' => true],
];
ob_start();
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header ">
                <h5 class="card-title mb-0">Danh sách hướng dẫn viên mới</h5>
                <div class="card-tools">
                    <a href="<?= BASE_URL . 'guide/create' ?>" class="btn btn-sm btn-secondary">
                        <i class="bi bi-plus"></i>Thêm hướng dẫn viên mới
                    </a>
</div>
</div>
<div class = "card-body">
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle"></i> <?=($_SESSION['success']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-circle"></i> <?=($_SESSION['error']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        <?php if (empty($guides)): ?>
            <div class="alert alert-info" role="alert">
                <i class="bi bi-info-circle"></i> Hiện chưa có hướng dẫn viên nào được thêm vào hệ thống. <a href="<?= BASE_URL ?>guide/create">Thêm hướng dẫn viên mới</a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                                <th style="width: 50px">ID</th>
                                <th>Tên</th>
                                <th>Email</th>
                                <th style="width: 100px">Trạng thái</th>
                                <th style="width: 150px">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($guides as $guide): ?>
                            <tr>
                                <td><strong>#<?= htmlspecialchars($guide['id'] ?? '') ?></strong></td>
                                <td><?= htmlspecialchars($guide['name'] ?? 'N/A') ?></td>
                                <td><?= htmlspecialchars($guide['email'] ?? 'N/A') ?></td>
                                <td>
                                    <?php if ($guide['is_active']): ?>
                                        <span class="badge bg-success"><i class="bi bi-check-circle"></i>Hoạt động</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger"></span><i class="bi bi-x-circle"></i>Không hoạt động</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= BASE_URL ?>guide/edit?id=<?= htmlspecialchars($guide['id'] ?? '')?>" class="btn btn-primary btn-sm" title="Chỉnh sửa"><i class="bi bi-pencil-square"></i>Chỉnh sửa</a>
                                    <a href="<?= BASE_URL ?>guide/edit?id=<?= htmlspecialchars($guide['id'] ?? '')?>" class=" btbtn btn-danger btn-sm" onclick="return confirm('Bạn chắc chắn muốn xóa hướng đãn viên này?')" title="Xóa"><i class="bi bi-trash"></i>Xóa</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                 </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
view('layouts/AdminLayout', [
    'title' => $pageTitle, ' - Webes Quan lý tour',
    'pageTitle' => $pageTitle,
    'breadcrumbs' => $breadcrumbs,
    'content' => $content,
]);
?>
