<?php
session_start();
include 'db.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$blog = null;
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM blogs WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $blog = $result->fetch_assoc();
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $sql = "UPDATE blogs SET title = ?, content = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $title, $content, $id);
    $stmt->execute();
    header("Location: title.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Blog - Blog Site</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="title.php">Title</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </nav>
    <div class="container">
        <h1>Edit Blog</h1>
        <?php if ($blog): ?>
            <form method="POST">
                <input type="hidden" name="id" value="<?php echo $blog['id']; ?>">
                <label>Title:</label>
                <input type="text" name="title" value="<?php echo htmlspecialchars($blog['title']); ?>" required>
                <label>Content:</label>
                <textarea name="content" required><?php echo htmlspecialchars($blog['content']); ?></textarea>
                <button type="submit">Save</button>
            </form>
        <?php else: ?>
            <p>Blog not found.</p>
        <?php endif; ?>
    </div>
</body>
</html>