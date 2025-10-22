<?php
include 'db.php';

if(isset($_GET['type']) && isset($_GET['id'])) {
    $type = $_GET['type'];
    $id = (int)$_GET['id'];
    
    switch($type) {
        case 'book':
            // Check if book is borrowed
            $check = $conn->query("SELECT availability FROM books WHERE id = $id");
            if($check->num_rows > 0) {
                $book = $check->fetch_assoc();
                if($book['availability'] == 'Borrowed') {
                    die("Cannot delete a borrowed book. Please return it first.");
                }
            }
            $conn->query("DELETE FROM books WHERE id = $id");
            header("Location: books.php");
            break;
            
        case 'member':
            // Check if member has active borrows
            $check = $conn->query("SELECT COUNT(*) as active_borrows FROM borrow_records WHERE member_id = $id AND return_date IS NULL");
            $result = $check->fetch_assoc();
            if($result['active_borrows'] > 0) {
                die("Cannot delete member with active book borrows. Please return all books first.");
            }
            $conn->query("DELETE FROM members WHERE id = $id");
            header("Location: members.php");
            break;
            
        case 'borrow':
            // Get book_id before deleting to update availability
            $record = $conn->query("SELECT book_id FROM borrow_records WHERE id = $id")->fetch_assoc();
            $conn->query("DELETE FROM borrow_records WHERE id = $id");
            // Update book availability if it was borrowed
            if($record) {
                $conn->query("UPDATE books SET availability = 'Available' WHERE id = {$record['book_id']}");
            }
            header("Location: borrow_records.php");
            break;
            
        default:
            header("Location: index.php");
            break;
    }
    exit();
} else {
    header("Location: index.php");
    exit();
}
?>