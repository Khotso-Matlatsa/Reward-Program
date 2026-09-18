<?php 
require_once 'config.php';
requireAdmin();

$message = "";

if (isset($_POST['upload'])) {

    $title = mysqli_real_escape_string($conn, $_POST['softwaretitle']);
    $description = mysqli_real_escape_string($conn, $_POST['softwaredescription']);
    $link = mysqli_real_escape_string($conn, $_POST['softwarelink']);

    $fileName = $_FILES['softwarefile']['name'];
    $tempName = $_FILES['softwarefile']['tmp_name'];

    $filePath = "";

    /* ==========================
       OPTION 1: FILE UPLOAD
    ========================== */
    if (!empty($fileName)) {

        $filePath = "uploads/" . basename($fileName);

        if (move_uploaded_file($tempName, $filePath)) {

            $query = "INSERT INTO softwaretasks 
                (softwaretitle, softwaredescription, softwarefile, software_link)
                VALUES ('$title', '$description', '$fileName', NULL)";

            if (mysqli_query($conn, $query)) {
                $message = "Software uploaded successfully!";
            } else {
                $message = "Database error.";
            }

        } else {
            $message = "File upload failed.";
        }

    }

    /* ==========================
       OPTION 2: LINK ONLY
    ========================== */
    elseif (!empty($link)) {

        $query = "INSERT INTO softwaretasks 
            (softwaretitle, softwaredescription, softwarefile, software_link)
            VALUES ('$title', '$description', NULL, '$link')";

        if (mysqli_query($conn, $query)) {
            $message = "Software link added successfully!";
        } else {
            $message = "Database error.";
        }

    }

    else {
        $message = "Please upload a file OR provide a link.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Upload Software</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center">

<div class="w-full max-w-2xl bg-white shadow-2xl rounded-2xl p-10">

    <!-- Header -->
    <div class="text-center mb-8">
        <h2 class="text-3xl font-bold text-gray-800">Upload New Software</h2>
        <p class="text-gray-500 mt-2">Add a new downloadable software to your platform</p>
    </div>

    <!-- Message -->
    <?php if ($message != "") { ?>
        <div class="mb-6 p-4 rounded-lg 
            <?php echo ($message == 'Software uploaded successfully!') 
                ? 'bg-green-100 text-green-700 border border-green-300' 
                : 'bg-red-100 text-red-700 border border-red-300'; ?>">
            <?php echo $message; ?>
        </div>
    <?php } ?>

    <!-- Form -->
    <form method="POST" enctype="multipart/form-data" class="space-y-6">

        <!-- Title -->
        <div>
            <label class="block text-gray-700 font-semibold mb-2">
                Software Title
            </label>
            <input 
                type="text" 
                name="softwaretitle" 
                required
                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-black focus:outline-none"
                placeholder="Enter software title"
            >
        </div>

        <!-- Description -->
        <div>
            <label class="block text-gray-700 font-semibold mb-2">
                Description
            </label>
            <textarea 
                name="softwaredescription" 
                rows="4"
                required
                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-black focus:outline-none"
                placeholder="Enter software description"
            ></textarea>
        </div>

        <!-- File Upload -->
        <div>
            <label class="block text-gray-700 font-semibold mb-2">
                Upload File
            </label>
            <input 
                type="file" 
                name="softwarefile" 
                required
                class="w-full px-4 py-2 border border-gray-300 rounded-xl bg-gray-50 file:bg-black file:text-white file:px-4 file:py-2 file:border-0 file:rounded-lg file:cursor-pointer"
            >
        </div>
        <!-- OR Divider -->
<div class="text-center text-gray-500 font-semibold">OR</div>

<!-- Link Input -->
<div>
    <label class="block text-gray-700 font-semibold mb-2">
        Software Link (Optional)
    </label>
    <input 
        type="url" 
        name="softwarelink"
        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-black focus:outline-none"
        placeholder="https://example.com/software"
    >
</div>

        <!-- Button -->
        <button 
            type="submit" 
            name="upload"
            class="w-full bg-black text-white py-3 rounded-xl font-semibold hover:bg-gray-800 transition duration-300"
        >
            Upload Software
        </button>

    </form>

</div>

</body>
</html>