<?php
$title = 'Project';

// Delete safely
if (isset($_GET['delete'])) {
    $id = (int) $_GET['delete'];

    $qImg = mysqli_query($koneksi, "SELECT image FROM projects WHERE id = '$id'");
    $rowImg = mysqli_fetch_assoc($qImg);

    if ($rowImg) {
        if (!empty($rowFile['image']) && file_exists(__DIR__ . "/uploads/projects/" . $rowFile['image'])) {
            @unlink(__DIR__ . "/uploads/projects/" . $rowFile['image']);
        }
    }

    $stmt = $koneksi->prepare("DELETE FROM projects WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();

    header("Location: ?page=project&msg=deleted");
    exit;
}

// Fetch data
$result = $koneksi->query("SELECT * FROM projects ORDER BY id DESC");
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold text-primary"><i class="bi bi-kanban"></i> Project List</h2>
        <a href="?page=project-form" class="btn btn-primary shadow-sm">
            <i class="bi bi-plus-circle"></i> Add Project
        </a>
    </div>

    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            ✅ <?= htmlspecialchars($_GET['msg']) ?> successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-hover align-middle text-center">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Tag</th>
                        <th>Image</th>
                        <th width="180">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td class="text-start"><?= htmlspecialchars($row['title']) ?></td>
                            <td><?= htmlspecialchars($row['category']) ?></td>
                            <td><?= htmlspecialchars($row['date']) ?></td>
                            <td><?= htmlspecialchars($row['tag']) ?></td>
                            <td>
                                <?php if (!empty($row['image'])): ?>
                                    <img src="../admin/content/uploads/projects/<?= htmlspecialchars($row['image']) ?>"
                                        width="80" class="rounded shadow-sm" alt="<?= htmlspecialchars($row['title']) ?>">

                                <?php else: ?>
                                    <span class="text-muted fst-italic">No image</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="?page=project-form&id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil-square"></i> Edit
                                </a>
                                <a href="?page=project&delete=<?= $row['id'] ?>"
                                    onclick="return confirm('Yakin ingin menghapus data ini?')"
                                    class="btn btn-sm btn-danger">
                                    <i class="bi bi-trash3"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>