<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Borrow Records</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Borrow Records</h2>
    <a href="add_borrow.php" class="btn btn-success mb-2">Add Borrow Record</a>
    <a href="index.php" class="btn btn-secondary mb-2">Back to Home</a>
    
    <?php
    if(isset($_GET['message'])) {
        $message_type = $_GET['type'] ?? 'success';
        $message = htmlspecialchars($_GET['message']);
        echo "<div class='alert alert-{$message_type} alert-dismissible fade show'>
                {$message}
                <button type='button' class='btn-close' data-bs-dismiss='alert'></button>
              </div>";
    }
    ?>
    
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Member</th>
                <th>Book</th>
                <th>Borrow Date</th>
                <th>Return Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT br.id, m.name as member, b.title as book, br.borrow_date, br.return_date,
                           CASE WHEN br.return_date IS NULL THEN 'Borrowed' ELSE 'Returned' END as status
                    FROM borrow_records br
                    JOIN members m ON br.member_id = m.id
                    JOIN books b ON br.book_id = b.id
                    ORDER BY br.id DESC";
            $result = $conn->query($sql);
            
            if($result->num_rows > 0) {
                while($row = $result->fetch_assoc()){
                    $status_class = $row['status'] == 'Borrowed' ? 'badge bg-warning' : 'badge bg-success';
                    $return_date = $row['return_date'] ? $row['return_date'] : 'Not Returned';
                    
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['member']}</td>
                        <td>{$row['book']}</td>
                        <td>{$row['borrow_date']}</td>
                        <td>{$return_date}</td>
                        <td><span class='{$status_class}'>{$row['status']}</span></td>
                        <td>";
                    
                    // Only show Return button for borrowed books
                    if($row['status'] == 'Borrowed') {
                        echo "<a href='return_book.php?id={$row['id']}' class='btn btn-info btn-sm'>Return</a> ";
                    } else {
                        echo "<button class='btn btn-secondary btn-sm' disabled>Returned</button> ";
                    }
                    
                    echo "<a href='delete.php?type=borrow&id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this borrow record?\")'>Delete</a>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='7' class='text-center'>No borrow records found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>