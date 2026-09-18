<?php 
require_once 'config.php';

/* FETCH SOFTWARE FROM ADMIN UPLOADS */
$result = mysqli_query($conn, "SELECT * FROM softwaretasks ORDER BY id DESC");
$softwareList = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
<title>Software Hub</title>
<script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<div class="max-w-7xl mx-auto px-6 py-10">

    <!-- HEADER -->
    <div class="text-center mb-10">
        <h1 class="text-5xl font-bold text-gray-800">Software Hub</h1>
        <p class="text-gray-500 mt-2">Download tools or explore software</p>
    </div>

    <!-- SEARCH -->
    <div class="mb-10">
        <input 
            type="text" 
            id="searchInput"
            placeholder="🔍 Search software..."
            class="w-full p-4 rounded-xl border shadow-sm focus:outline-none focus:ring-2 focus:ring-black"
        >
    </div>

    <!-- SOFTWARE GRID -->
    <div id="softwareGrid" class="grid gap-8 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3">

        <?php foreach ($softwareList as $software): ?>

        <div class="software-card bg-white p-6 rounded-2xl shadow-md hover:shadow-2xl transition transform hover:-translate-y-2">

            <!-- Title -->
            <h3 class="text-xl font-bold text-gray-800 mb-2">
                <?php echo htmlspecialchars($software['softwaretitle']); ?>
            </h3>

            <!-- Badge -->
            <span class="inline-block bg-blue-100 text-blue-600 px-3 py-1 rounded-full text-xs mb-3">
                Software
            </span>

            <!-- Description -->
            <p class="text-gray-600 text-sm mb-5">
                <?php echo htmlspecialchars($software['softwaredescription']); ?>
            </p>

            <!-- ACTION BUTTONS -->
            <div class="flex gap-3">

                <!-- FILE DOWNLOAD -->
                <?php if (!empty($software['softwarefile'])): ?>
                    <a href="uploads/<?php echo $software['softwarefile']; ?>" download
                       class="flex-1 text-center bg-black text-white py-2 rounded-lg hover:bg-gray-800">
                        ⬇ Download
                    </a>
                <?php endif; ?>

                <!-- LINK -->
                <?php if (!empty($software['software_link'])): ?>
                    <a href="<?php echo $software['software_link']; ?>" target="_blank"
                       class="flex-1 text-center bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                        🔗 Visit
                    </a>
                <?php endif; ?>

            </div>

        </div>

        <?php endforeach; ?>

    </div>

</div>

<!-- 🔍 SEARCH SCRIPT -->
<script>
const searchInput = document.getElementById("searchInput");
const cards = document.querySelectorAll(".software-card");

searchInput.addEventListener("keyup", function() {
    let filter = this.value.toLowerCase();

    cards.forEach(card => {
        let text = card.innerText.toLowerCase();

        card.style.display = text.includes(filter) ? "block" : "none";
    });
});
</script>

</body>
</html>