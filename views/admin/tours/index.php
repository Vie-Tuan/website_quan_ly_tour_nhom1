<?php
startSection();
$pageTitle = 'Danh sách tour';
$breadcrumbs = [
    ['label' => 'Quản lý tour', 'url' => BASE_URL . 'tour/index', 'active' => true],
];
ob_start();
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header ">
                <h5 class="card-title mb-0">Danh sách tour</h5>
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
        <?php if (empty($tours)): ?>
            <div class="alert alert-info" role="alert">
                <i class="bi bi-info-circle"></i> Chưa có tour nào <a href="<?= BASE_URL ?>tour/create">Thêm tour mới</a>
            </div>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                                <th style="width: 50px">ID</th>
                                <th>Tên tour</th>
                                <th>Vị trí</th>
                                <th style="width: 120px">Giá (VND)</th>
                                <th style="width: 100px">Số lượt đánh giá</th>
                                <th style="width: 110px">Ngày khởi hành</th>
                                <th style="width: 100px">Trạng thái</th>
                                <th style="width: 150px">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tours as $tour): ?>
                            <tr>
                                <td><strong>#<?= htmlspecialchars($tour['id'] ?? '') ?></strong></td>
                                <td>
                                <strong><?= htmlspecialchars($tour['name'] ?? 'N/A') ?></strong>
                            <br>
                                <small class="text-muted"><?= htmlspecialchars(substr($tour['description'] ?? '', 0, 50)) ?>...,</small>
                        </td>
                                <td><?= htmlspecialchars($tour['location'] ?? 'N/A') ?></td>
                                <td><strong><?= number_format($tour['price'] ?? 0, 0, ',', '.') ?></strong></td>
                                <td><span class = "badge bg-info"><?= htmlspecialchars($tour['num_reviews'] ?? 0) ?></span></td>
                                <td><?= isset($tour['departure_date']) && !empty($tour['departure_date']) ? date('d/m/Y', strtotime($tour['departure_date'])) : 'Chưa set' ?></td>


                                <td>
                                    <?php if (($tour['status'] ?? 0) == 1): ?>
                                        <span class="badge bg-success"><i class="bi bi-check-circle"></i> Hoạt động</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger"><i class="bi bi-x-circle"></i> Không hoạt động</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?= BASE_URL ?>tour/edit?id=<?= htmlspecialchars($tour['id'] ?? '')?>" class="btn btn-primary btn-sm" title="Chỉnh sửa"><i class="bi bi-pencil-square"></i> Chỉnh sửa</a>
                                    <a href="<?= BASE_URL ?>tour/delete?id=<?= htmlspecialchars($tour['id'] ?? '')?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn chắc chắn muốn xóa tour này?')" title="Xóa"><i class="bi bi-trash"></i> Xóa</a>
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
    'title' => $pageTitle . ' - Website Quản Lý Tour',
    'pageTitle' => $pageTitle,
    'breadcrumbs' => $breadcrumbs,
    'content' => $content,
]);
?>
