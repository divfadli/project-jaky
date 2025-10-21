<?php
// Ambil ID dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Query detail project
$q = mysqli_query($koneksi, "SELECT * FROM projects WHERE id = $id LIMIT 1");
$data = mysqli_fetch_assoc($q);

if (!$data) {
    echo "<script>alert('Project tidak ditemukan'); window.location='?page=project';</script>";
    exit;
}
?>

<!-- ============================================-->
<!-- Header Section ============================-->
<section class="text-center overflow-hidden py-0" id="top" data-zanim-timeline="{}" data-zanim-trigger="scroll">
    <div class="bg-holder overlay parallax" style="background-image:url(assets/img/headers/header-9.jpg);"></div>
    <div class="container-fluid">
        <div class="header-overlay"></div>
        <div class="position-relative pt-10 pb-8">
            <div class="header-text">
                <div class="overflow-hidden">
                    <h1 class="display-3 text-white font-weight-extra-light ls-1"
                        data-zanim-xs='{"duration":2,"delay":0}'>
                        Detail Project
                    </h1>
                </div>
                <div class="overflow-hidden">
                    <div class="d-flex justify-content-center" data-zanim-xs='{"duration":2,"delay":0.1}'>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb text-uppercase ls-1">
                                <li class="breadcrumb-item"><a class="text-400 hover-color-white" href="/">Home</a></li>
                                <li class="breadcrumb-item"><a class="text-400 hover-color-white"
                                        href="?page=project">Project</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    <?= htmlspecialchars($data['title']); ?>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================-->
<!-- Detail Project Section ====================-->
<section>
    <div class="container">
        <div class="row">
            <!-- Gambar Carousel -->
            <div class="col-12">
                <div class="owl-carousel owl-carousel-theme owl-theme owl-dots-inner owl-theme-white mb-4"
                    data-options='{"margin":0,"nav":true,"autoplay":true,"loop":true,"dots":true,"items":1,"autoplaySpeed":800,"smartSpeed":600,"responsive":{"0":{"nav":false},"992":{"nav":true}}}'>
                    <?php
                    // Jika ada banyak gambar, misal disimpan dalam kolom "gallery" (dipisahkan koma)
                    if (!empty($data['gallery'])) {
                        $images = explode(',', $data['gallery']);
                        foreach ($images as $img) {
                            echo '<img class="rounded" src="../admin/content/uploads/projects/' . htmlspecialchars(trim($img)) . '" alt="">';
                        }
                    } else {
                        // Jika hanya ada 1 gambar utama
                        echo '<img class="rounded" src="../admin/content/uploads/projects/' . htmlspecialchars($data['image']) . '" alt="">';
                    }
                    ?>
                </div>
            </div>

            <!-- Deskripsi -->
            <div class="col-lg pr-lg-5 mb-4 mb-lg-0">
                <h4 class="font-weight-normal text-base"><?= htmlspecialchars($data['title']); ?></h4>
                <p><?= nl2br(htmlspecialchars($data['detail'])); ?></p>
                <div class="vertical-line"></div>
            </div>

            <!-- Informasi Tambahan -->
            <div class="col-lg-auto pl-lg-5">
                <h5 class="font-weight-normal mb-1">Informations</h5>
                <table class="table table-borderless mb-0">
                    <?php if (!empty($data['developer'])): ?>
                    <tr>
                        <td class="py-1 pl-0 text-dark">Developer:</td>
                        <td class="py-1 text-600"><?= htmlspecialchars($data['developer']); ?></td>
                    </tr>
                    <?php endif; ?>

                    <?php if (!empty($data['demo_link'])): ?>
                    <tr>
                        <td class="py-1 pl-0 text-dark">Live Demo:</td>
                        <td class="py-1">
                            <a class="text-600" href="<?= htmlspecialchars($data['demo_link']); ?>" target="_blank">
                                <?= htmlspecialchars($data['demo_link']); ?>
                            </a>
                        </td>
                    </tr>
                    <?php endif; ?>

                    <tr>
                        <td class="py-1 pl-0 text-dark">Category:</td>
                        <td class="py-1 text-600"><?= htmlspecialchars($data['category']); ?></td>
                    </tr>
                    <tr>
                        <td class="py-1 pl-0 text-dark">Date Post:</td>
                        <td class="py-1 text-600"><?= htmlspecialchars($data['date']); ?></td>
                    </tr>
                    <tr>
                        <td class="py-1 pl-0 text-dark">Tags:</td>
                        <td class="py-1 text-600"><?= htmlspecialchars($data['tag']); ?></td>
                    </tr>
                    <tr>
                        <td class="py-1 pl-0 text-dark">Created:</td>
                        <td class="py-1 text-600"><?= htmlspecialchars($data['created_at']); ?></td>
                    </tr>
                    <tr>
                        <td class="py-1 pl-0 text-dark">Updated:</td>
                        <td class="py-1 text-600"><?= htmlspecialchars($data['updated_at']); ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</section>