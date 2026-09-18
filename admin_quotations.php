<?php
session_start();
require_once 'config.php';

/* SHOW ERRORS (TEMP FOR DEBUG) */
error_reporting(E_ALL);
ini_set('display_errors', 1);

/* FETCH DATA */
$result = $conn->query("SELECT * FROM quotations ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Quotations</title>
    <style>
        body {
            font-family: Arial;
            background: #f4f6f9;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }

        th {
            background: #222;
            color: #fff;
        }

        .resolved {
            color: green;
            font-weight: bold;
        }

        .unresolved {
            color: red;
            font-weight: bold;
        }

        a.btn {
            padding: 6px 10px;
            text-decoration: none;
            border-radius: 5px;
            color: white;
        }

        .resolve { background: green; }
        .unresolve { background: orange; }
        .delete { background: red; }
    </style>
</head>

<body>

<h1>Quotation Requests</h1>

<?php if (isset($_GET['success'])): ?>
    <p style="color:green; text-align:center;">Quotation submitted successfully!</p>
<?php endif; ?>

<table>
<tr>
    <th>Name</th>
    <th>Email</th>
    <th>Company</th>
    <th>Phone</th>
    <th>Description</th>
    <th>Status</th>
    <th>Actions</th>
</tr>

<?php while($row = $result->fetch_assoc()): ?>
<tr>
    <td><?php echo htmlspecialchars($row['name']); ?></td>
    <td><?php echo htmlspecialchars($row['email']); ?></td>
    <td><?php echo htmlspecialchars($row['company']); ?></td>
    <td><?php echo htmlspecialchars($row['phone']); ?></td>
    <td><?php echo htmlspecialchars($row['description']); ?></td>

    <td class="<?php echo $row['status'] ? 'resolved' : 'unresolved'; ?>">
        <?php echo $row['status'] ? 'Resolved' : 'Unresolved'; ?>
    </td>

    <td>
        <a class="btn resolve" href="?resolve=<?php echo $row['id']; ?>">Resolve</a>
        <a class="btn unresolve" href="?unresolve=<?php echo $row['id']; ?>">Unresolve</a>
        <a class="btn delete" href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Delete this record?');">Delete</a>
    </td>
</tr>
<?php endwhile; ?>

</table>

</body>
</html>

<?php
/* ACTIONS */

/* RESOLVE */
if (isset($_GET['resolve'])) {
    $id = intval($_GET['resolve']);
    $conn->query("UPDATE quotations SET status=1 WHERE id=$id");
    header("Location: admin_quotations.php");
    exit();
}

/* UNRESOLVE */
if (isset($_GET['unresolve'])) {
    $id = intval($_GET['unresolve']);
    $conn->query("UPDATE quotations SET status=0 WHERE id=$id");
    header("Location: admin_quotations.php");
    exit();
}

/* DELETE */
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM quotations WHERE id=$id");
    header("Location: admin_quotations.php");
    exit();
}
?>