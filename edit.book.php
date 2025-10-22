<?php 
include 'db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) { 
    header('Location: books.php'); 
    exit; 
}

$res = $conn->query("SELECT * FROM books WHERE id=$id");
if ($res->num_rows === 0) { 
    header('Location: books.php'); 
    exit; 
}
$book = $res->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $conn->real_escape_string($_POST['title']);
    $author = $conn->real_escape_string($_POST['author']);
    $category = $conn->real_escape_string($_POST['category']);
    $availability = $conn->real_escape_string($_POST['availability']);

    $sql = "UPDATE books SET title=?, author=?, category=?, availability=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $title, $author, $category, $availability, $id);
    
    if ($stmt->execute()) { 
        header('Location: books.php'); 
        exit; 
    } else { 
        $error = $conn->error; 
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Edit Book</h2>
                </div>
                <div class="card-body">
                    <?php if(!empty($error)): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($book['title']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Author</label>
                            <input type="text" name="author" class="form-control" value="<?php echo htmlspecialchars($book['author']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <input type="text" name="category" class="form-control" value="<?php echo htmlspecialchars($book['category']); ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Availability</label>
                            <select name="availability" class="form-control" required>
                                <option value="Available" <?php if($book['availability']==='Available') echo 'selected'; ?>>Available</option>
                                <option value="Borrowed" <?php if($book['availability']==='Borrowed') echo 'selected'; ?>>Borrowed</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Update Book</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <a href="books.php" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>