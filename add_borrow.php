<?php
include 'db.php';

if(isset($_POST['submit'])){
    $member_id = (int)$_POST['member_id'];
    $book_id   = (int)$_POST['book_id'];
    $borrow_date = $conn->real_escape_string($_POST['borrow_date']);

    // Insert borrow record
    $sql = "INSERT INTO borrow_records (member_id, book_id, borrow_date) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $member_id, $book_id, $borrow_date);
    
    if($stmt->execute()){
        // Update book availability
        $conn->query("UPDATE books SET availability='Borrowed' WHERE id=$book_id");
        header("Location: borrow_records.php");
        exit();
    } else {
        $error = "Error adding borrow record: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Borrow Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Add Borrow Record</h2>
                </div>
                <div class="card-body">
                    <?php if(isset($error)): ?>
                        <div class="alert alert-danger"><?php echo $error; ?></div>
                    <?php endif; ?>
                    
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Member</label>
                            <select name="member_id" class="form-control" required>
                                <option value="">Select Member</option>
                                <?php
                                $members = $conn->query("SELECT * FROM members");
                                while($m = $members->fetch_assoc()){
                                    echo "<option value='{$m['id']}'>{$m['name']} ({$m['email']})</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Book</label>
                            <select name="book_id" class="form-control" required>
                                <option value="">Select Book</option>
                                <?php
                                $books = $conn->query("SELECT * FROM books WHERE availability='Available'");
                                while($b = $books->fetch_assoc()){
                                    echo "<option value='{$b['id']}'>{$b['title']} by {$b['author']}</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Borrow Date</label>
                            <input type="date" name="borrow_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
                        </div>

                        <button type="submit" name="submit" class="btn btn-success w-100">Add Borrow Record</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <a href="borrow_records.php" class="btn btn-secondary">Back to Records</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>