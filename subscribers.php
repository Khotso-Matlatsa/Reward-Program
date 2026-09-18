<?php  
require_once 'config.php';
requireAdmin();

/* DELETE SUBSCRIBER */
if(isset($_GET['delete']))
{
    $id = (int)$_GET['delete'];

    $delete = "DELETE FROM tblsubscribers WHERE id = $id";
    mysqli_query($conn, $delete);

    header("Location: subscribers.php");
    exit();
}

$query = "SELECT * FROM tblsubscribers ORDER BY subscribed_at DESC";
$result = mysqli_query($conn, $query);
$count = mysqli_num_rows($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Subscribers</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-8">

<div class="max-w-6xl mx-auto">

    <!-- Page Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Subscribers</h1>
            <p class="text-gray-500 mt-1">Manage newsletter subscriptions</p>
        </div>

        <div class="bg-blue-600 text-white px-5 py-2 rounded-xl shadow-md">
            Total: <?php echo $count; ?>
        </div>
    </div>

    <!-- Card -->
    <div class="bg-white shadow-lg rounded-2xl overflow-hidden">

        <div class="overflow-x-auto">
            <table class="min-w-full text-left">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-4 text-sm font-semibold text-gray-600 uppercase tracking-wider">
                            Email Address
                        </th>
                        <th class="px-6 py-4 text-sm font-semibold text-gray-600 uppercase tracking-wider">
                            Subscribed On
                        </th>
                        <th class="px-6 py-4 text-sm font-semibold text-gray-600 uppercase tracking-wider">
                            Action
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">

                <?php if($count > 0): ?>
                    <?php while($row = mysqli_fetch_assoc($result)) { ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-gray-700">
                                <?php echo htmlspecialchars($row['email']); ?>
                            </td>

                            <td class="px-6 py-4 text-gray-500">
                                <?php echo date("F j, Y g:i A", strtotime($row['subscribed_at'])); ?>
                            </td>

                            <td class="px-6 py-4">
                                <a href="subscribers.php?delete=<?php echo $row['id']; ?>"
                                   onclick="return confirm('Delete this subscriber?')"
                                   class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm">
                                   Delete
                                </a>
                            </td>
                        </tr>
                    <?php } ?>

                <?php else: ?>
                    <tr>
                        <td colspan="3" class="px-6 py-8 text-center text-gray-400">
                            No subscribers yet.
                        </td>
                    </tr>
                <?php endif; ?>

                </tbody>
            </table>
        </div>

    </div>

</div>

</body>
</html>