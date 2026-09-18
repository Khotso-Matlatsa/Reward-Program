<?php 
require_once(__DIR__ . '/config.php');
requireAdmin();

/* ================= DELETE IMAGE ================= */
if (isset($_GET['delete'])) {

    $id = (int)$_GET['delete'];

    if ($id > 0) {

        // Get filename
        $query = $conn->query("SELECT filename FROM images WHERE id = $id");

        if ($query && $query->num_rows > 0) {

            $row = $query->fetch_assoc();
            $filePath = __DIR__ . "/uploads/" . $row['filename'];

            // Delete file if exists
            if (file_exists($filePath)) {
                unlink($filePath);
            }

            // Delete database record
            $conn->query("DELETE FROM images WHERE id = $id");
        }
    }

    header("Location: gallery.php");
    exit();
}

/* ================= FETCH IMAGES ================= */
$images = [];
$result = $conn->query("SELECT * FROM images ORDER BY id DESC");

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $images[] = $row;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Gallery</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 flex items-center justify-center p-6">

<div class="w-full max-w-5xl backdrop-blur-lg bg-white/20 border border-white/30 rounded-3xl shadow-2xl p-8 text-white">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">Image Gallery</h1>

        <a href="admin_upload.php"
           class="px-4 py-2 rounded-full bg-white/30 border border-white/40 hover:bg-white/50 transition font-semibold">
           Upload Page
        </a>
    </div>

<?php if (count($images) > 0): ?>

    <div class="relative overflow-hidden rounded-2xl">

        <div id="carousel" class="flex transition-transform duration-700 ease-in-out">

            <?php foreach ($images as $img): ?>
                <div class="min-w-full flex justify-center relative">

                    <!-- DELETE BUTTON -->
                    <a href="<?= $_SERVER['PHP_SELF']; ?>?delete=<?= $img['id'] ?>"
                       onclick="return confirm('Are you sure you want to delete this image?')"
                       class="absolute top-4 right-4 bg-red-500 hover:bg-red-700 text-white px-3 py-1 rounded-full text-sm shadow-lg">
                       Delete
                    </a>

                    <img src="uploads/<?= htmlspecialchars($img['filename']) ?>"
                         class="h-96 object-cover rounded-2xl shadow-xl border border-white/30">
                </div>
            <?php endforeach; ?>

        </div>

        <button onclick="prevSlide()"
            class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/20 px-3 py-2 rounded-full hover:bg-white/40">
            ◀
        </button>

        <button onclick="nextSlide()"
            class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/20 px-3 py-2 rounded-full hover:bg-white/40">
            ▶
        </button>

    </div>

    <!-- Dots -->
    <div class="flex justify-center mt-6 space-x-3">
        <?php foreach ($images as $index => $img): ?>
            <button onclick="goToSlide(<?= $index ?>)"
                class="dot w-3 h-3 rounded-full bg-white/40 hover:bg-white"
                data-index="<?= $index ?>">
            </button>
        <?php endforeach; ?>
    </div>

<?php else: ?>
    <p class="text-center opacity-70">No images uploaded yet.</p>
<?php endif; ?>

</div>

<script>
let index = 0;
const carousel = document.getElementById('carousel');
const dots = document.querySelectorAll('.dot');
const totalSlides = <?= count($images) ?>;

function updateDots() {
    dots.forEach(dot => dot.classList.remove('bg-white'));
    if (dots[index]) dots[index].classList.add('bg-white');
}

function showSlide() {
    carousel.style.transform = `translateX(-${index * 100}%)`;
    updateDots();
}

function nextSlide() {
    if (totalSlides > 0) {
        index = (index + 1) % totalSlides;
        showSlide();
    }
}

function prevSlide() {
    if (totalSlides > 0) {
        index = (index - 1 + totalSlides) % totalSlides;
        showSlide();
    }
}

function goToSlide(i) {
    index = i;
    showSlide();
}

if (totalSlides > 0) {
    setInterval(() => {
        nextSlide();
    }, 4000);
}

updateDots();
</script>

</body>
</html>