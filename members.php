<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Members</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <h2>Members</h2>
    <div class="mb-3">
        <a href="add_member.php" class="btn btn-success">Add Member</a>
        <a href="index.php" class="btn btn-secondary">Home</a>
    </div>
    
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $res = $conn->query("SELECT * FROM members ORDER BY id DESC");
            while($row = $res->fetch_assoc()): 
            ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['phone']); ?></td>
                <td>
                    <a class="btn btn-sm btn-primary" href="edit_member.php?id=<?php echo $row['id']; ?>">Edit</a>
                    <a class="btn btn-sm btn-danger" href="delete.php?type=member&id=<?php echo $row['id']; ?>" onclick="return confirm('Delete this member?');">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>