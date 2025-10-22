<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Books</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Books List</h2>
    <a href="add_book.php" class="btn btn-success mb-2">Add Book</a>
    <a href="index.php" class="btn btn-secondary mb-2">Back to Home</a>
    
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Category</th>
                <th>Availability</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT * FROM books ORDER BY id DESC");
            while($row = $result->fetch_assoc()){
                $availability_class = $row['availability'] == 'Available' ? 'badge bg-success' : 'badge bg-danger';
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['title']}</td>
                    <td>{$row['author']}</td>
                    <td>{$row['category']}</td>
                    <td><span class='{$availability_class}'>{$row['availability']}</span></td>
                    <td>
                        <a href='edit_book.php?id={$row['id']}' class='btn btn-primary btn-sm'>Edit</a>
                        <a href='delete.php?type=book&id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this book?\")'>Delete</a>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>