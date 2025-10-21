<?php
$id = $_GET['id'] ?? null;
$data = [
    'title' => '',
    'short_description' => '',
    'category' => '',
    'image' => '',
    'detail' => '',
    'date' => '',
    'tag' => ''
];

// --- Ambil data jika mode edit ---
if ($id) {
    $stmt = $koneksi->prepare("SELECT * FROM projects WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $data = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}

// --- Simpan data (insert/update) ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $short_description = trim($_POST['short_description']);
    $category = trim($_POST['category']);
    $detail = trim($_POST['detail']);
    $date = $_POST['date'];
    $tag = trim($_POST['tag']);

    // === Handle upload gambar ===
    $image = $data['image']; // pakai gambar lama jika tidak upload baru
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $tmp_name = $_FILES['image']['tmp_name'];
        $filename = basename($_FILES['image']['name']);
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        if (in_array($ext, $allowed)) {
            $image = time() . '_' . preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $filename);
            $target_dir = __DIR__ . "/uploads/projects/";
            $target_file = $target_dir . $image;

            // Buat folder upload jika belum ada
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            if (move_uploaded_file($tmp_name, $target_file)) {
                // === Hapus gambar lama jika ada ===
                if (!empty($data['image'])) {
                    $old_file = $target_dir . $data['image'];
                    if (file_exists($old_file)) {
                        unlink($old_file);
                    }
                }
            } else {
                die("<div class='alert alert-danger m-3'>❌ Gagal menyimpan file ke folder upload.</div>");
            }
        } else {
            die("<div class='alert alert-warning m-3'>⚠️ Format file tidak diperbolehkan (gunakan JPG, PNG, GIF, WEBP).</div>");
        }
    }


    // === Query ===
    if ($id) {
        $update = mysqli_query($koneksi, "UPDATE projects SET title='$title', short_description='$short_description', category='$category', image='$image', detail='$detail', date='$date', tag='$tag'  WHERE id='$id'");

        if ($update) {
            header("Location: ?page=project&msg=updated");
            exit();
        }
    } else {
        // Insert
        $insert = mysqli_query(
            $koneksi,
            "INSERT INTO projects (title, short_description, category, image, detail, date, tag) 
             VALUES ('$title','$short_description','$category','$image','$detail','$date','$tag')"
        );
        if ($insert) {
            header("Location: ?page=project&msg=added");
            exit();
        }
    }
}
?>

<!-- ===== Tampilan Form ===== -->
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white fw-bold">
            <?= $id ? 'Edit Project' : 'Add New Project' ?>
        </div>

        <div class="card-body">
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Title</label>
                        <input type="text" name="title" class="form-control" required
                            value="<?= htmlspecialchars($data['title']) ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Category</label>
                        <input type="text" name="category" class="form-control"
                            value="<?= htmlspecialchars($data['category']) ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Short Description</label>
                    <textarea name="short_description" class="form-control"
                        rows="2"><?= htmlspecialchars($data['short_description']) ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Detail</label>
                    <textarea name="detail" class="form-control"
                        rows="4"><?= htmlspecialchars($data['detail']) ?></textarea>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Date</label>
                        <input type="date" name="date" class="form-control"
                            value="<?= htmlspecialchars($data['date']) ?>">
                    </div>
                    <div class="col-md-8 mb-3">
                        <label class="form-label">Tag</label>
                        <input type="text" name="tag" class="form-control"
                            value="<?= htmlspecialchars($data['tag']) ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Image</label><br>
                    <?php if (!empty($data['image'])): ?>
                        <img src="../admin/content/uploads/projects/<?= htmlspecialchars($data['image']) ?>" width="120"
                            class="rounded mb-2 shadow-sm"><br>
                    <?php endif; ?>
                    <input type="file" name="image" class="form-control">
                    <small class="text-muted">Allowed: JPG, PNG, GIF, WEBP</small>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <a href="?page=project" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save"></i> <?= $id ? 'Update Project' : 'Save Project' ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>