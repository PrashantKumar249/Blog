<?php
session_start();
include 'db.php';
$sql = "SELECT * FROM blogs";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Title - Blog Site</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar">
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="title.php">Title</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="login.php">Login</a></li>
            <?php endif; ?>
        </ul>
    </nav>
    <div class="container">
        <h1>Blogs</h1>
        <?php if ($result->num_rows > 0): ?>
            <ul class="blog-list">
                <?php while ($row = $result->fetch_assoc()): ?>
                    <li>
                        <h3><?php echo htmlspecialchars($row['title']); ?></h3>
                        <p><?php echo htmlspecialchars($row['content']); ?></p>
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a> |
                            <a href="delete.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                        <?php endif; ?>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>No blogs available.</p>
        <?php endif; ?>
    </div>
</body>
</html>