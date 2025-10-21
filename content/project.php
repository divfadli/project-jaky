<?php
// Ambil semua data project
$q = mysqli_query($koneksi, "SELECT * FROM projects ORDER BY id DESC");

// Ambil daftar kategori unik untuk filter menu
$categories = [];
$cq = mysqli_query($koneksi, "SELECT DISTINCT category FROM projects ORDER BY category ASC");
while ($c = mysqli_fetch_assoc($cq)) {
    $categories[] = $c['category'];
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
                        data-zanim-xs='{"duration":2,"delay":0}'>Project</h1>
                </div>
                <div class="overflow-hidden">
                    <div class="d-flex justify-content-center" data-zanim-xs='{"duration":2,"delay":0.1}'>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb text-uppercase ls-1">
                                <li class="breadcrumb-item"><a class="text-400 hover-color-white" href="/">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Project</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============================================-->
<!-- Projects Section ===========================-->
<section class="text-center pb-6">
    <div class="container px-3">
        <div class="sortable" data-options='{"layoutMode":"packery"}'>

            <!-- Dynamic Category Filter -->
            <div class="menu mb-3 justify-content-center">
                <div class="item active" data-filter="*">All</div>
                <?php foreach ($categories as $cat): ?>
                    <div class="item" data-filter=".<?= strtolower($cat); ?>"><?= htmlspecialchars($cat); ?></div>
                <?php endforeach; ?>
            </div>

            <!-- Dynamic Project Cards -->
            <div class="row sortable-container sortable-container-gutter-fix hoverdir-grid" data-zanim-timeline="{}"
                data-zanim-trigger="scroll">
                <?php while ($data = mysqli_fetch_assoc($q)): ?>
                    <div class="col-sm-6 col-lg-4 px-2 sortable-item <?= strtolower($data['category']); ?> mb-3">
                        <div class="hoverdir-item position-relative rounded overflow-hidden"
                            data-zanim-xs='{"duration":1.5,"animation":"zoom-in","delay":0}'>
                            <a class="d-block" href="?page=project-detail&id=<?= $data['id']; ?>">
                                <img class="img-fluid rounded"
                                    src="../admin/content/uploads/projects/<?= htmlspecialchars($data['image']); ?>"
                                    alt="<?= htmlspecialchars($data['title']); ?>">
                                <div class="hoverdir-item-content">
                                    <div class="h-100 d-flex flex-center p-3 hoverdir-text">
                                        <div class="text-700">
                                            <h3 class="text-white lh-1 fs-2"><?= htmlspecialchars($data['title']); ?></h3>
                                            <p class="ls-0 mb-0"><?= nl2br(htmlspecialchars($data['short_description'])); ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</section>

<!-- ============================================-->
<!-- Call to Action =============================-->
<section class="text-center pt-0" data-zanim-timeline="{}" data-zanim-trigger="scroll">
    <div class="container">
        <div class="overflow-hidden">
            <h4 class="font-weight-medium mb-1" data-zanim-xs='{"duration":1.5,"delay":0}'>Make a Project With Us</h4>
        </div>
        <div class="overflow-hidden">
            <p data-zanim-xs='{"duration":1.5,"delay":0.1}'>Our Team is always ready to help you</p>
        </div>
        <div data-zanim-xs='{"from":{"opacity":0,"y":30},"to":{"opacity":1,"y":0},"duration":1.5,"delay":0.3}'>
            <a class="btn btn-dark btn-sm hvr-sweep-top mt-2" href="#!">Start Now</a>
        </div>
    </div>
</section>