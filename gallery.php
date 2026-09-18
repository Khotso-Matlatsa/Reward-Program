<?php
require_once __DIR__ . '/config.php';
requireLogin(); // make sure user is logged in

$images = [];

$stmt = $conn->prepare("SELECT filename FROM images ORDER BY upload_date DESC");
if ($stmt && $stmt->execute()) {
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $images[] = $row;
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Image Gallery</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 flex items-center justify-center p-6">

<div class="w-full max-w-5xl backdrop-blur-lg bg-white/20 border border-white/30 rounded-3xl shadow-2xl p-8 text-white">

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Image Gallery</h1>

        <a href="admin_upload.php"
           class="px-4 py-2 rounded-full bg-white/30 border border-white/40 hover:bg-white/50 transition font-semibold">
           Upload Page
        </a>
    </div>

<?php if (count($images) > 0): ?>

    <!-- Carousel -->
    <div class="relative overflow-hidden rounded-2xl">

        <div id="carousel" class="flex transition-transform duration-700 ease-in-out">

            <?php foreach ($images as $img): ?>
                <div class="min-w-full flex justify-center">
                    <img src="uploads/<?= htmlspecialchars($img['filename']) ?>"
                         class="h-96 object-cover rounded-2xl shadow-xl border border-white/30">
                </div>
            <?php endforeach; ?>

        </div>

        <!-- Prev Button -->
        <button onclick="prevSlide()"
            class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/20 px-4 py-2 rounded-full hover:bg-white/40 transition">
            ◀
        </button>

        <!-- Next Button -->
        <button onclick="nextSlide()"
            class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/20 px-4 py-2 rounded-full hover:bg-white/40 transition">
            ▶
        </button>

    </div>

    <!-- Dots -->
    <div class="flex justify-center mt-6 space-x-3">
        <?php foreach ($images as $index => $img): ?>
            <button onclick="goToSlide(<?= $index ?>)"
                class="dot w-3 h-3 rounded-full bg-white/40 hover:bg-white transition"
                data-index="<?= $index ?>">
            </button>
        <?php endforeach; ?>
    </div>

<?php else: ?>

    <p class="text-center opacity-70 text-lg">No images uploaded yet.</p>

<?php endif; ?>

</div>

<script>
const totalSlides = <?= count($images) ?>;

if (totalSlides > 0) {

    let index = 0;
    const carousel = document.getElementById('carousel');
    const dots = document.querySelectorAll('.dot');

    function updateDots() {
        dots.forEach(dot => dot.classList.remove('bg-white'));
        if (dots[index]) dots[index].classList.add('bg-white');
    }

    function showSlide() {
        carousel.style.transform = `translateX(-${index * 100}%)`;
        updateDots();
    }

    function nextSlide() {
        index = (index + 1) % totalSlides;
        showSlide();
    }

    function prevSlide() {
        index = (index - 1 + totalSlides) % totalSlides;
        showSlide();
    }

    function goToSlide(i) {
        index = i;
        showSlide();
    }

    setInterval(nextSlide, 4000);
    updateDots();
}
</script>

</body>
</html>