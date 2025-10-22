<?php
include 'db.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) {
    header('Location: borrow_records.php');
    exit;
}

// Get borrow record details
$record = $conn->query("SELECT * FROM borrow_records WHERE id = $id")->fetch_assoc();
if (!$record) {
    header('Location: borrow_records.php');
    exit;
}

if ($record['return_date'] !== null) {
    header('Location: borrow_records.php');
    exit;
}

// Process return
if (isset($_POST['return'])) {
    $return_date = date('Y-m-d');
    
    // Update borrow record
    $conn->query("UPDATE borrow_records SET return_date = '$return_date' WHERE id = $id");
    
    // Update book availability
    $conn->query("UPDATE books SET availability = 'Available' WHERE id = {$record['book_id']}");
    
    header('Location: borrow_records.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Return Book</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Return Book</h2>
                </div>
                <div class="card-body">
                    <p>Are you sure you want to mark this book as returned?</p>
                    <form method="post">
                        <button type="submit" name="return" class="btn btn-success w-100">Confirm Return</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <a href="borrow_records.php" class="btn btn-secondary">Cancel</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>