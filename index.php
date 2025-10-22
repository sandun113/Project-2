<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LIBRARIA - Library Management System</title>
    <meta name="description" content="LIBRARIA - Professional Library Management System for books, members, and borrowing.">
    <link rel="icon" type="image/png" href="favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --light-color: #ecf0f1;
            --dark-color: #2c3e50;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.8rem;
            color: var(--light-color) !important;
        }
        .nav-link {
            color: var(--light-color) !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .nav-link:hover {
            color: var(--secondary-color) !important;
            transform: translateY(-2px);
        }
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            color: white;
            padding: 80px 0;
            margin-bottom: 40px;
            border-radius: 0 0 20px 20px;
        }
        .feature-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            height: 100%;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        }
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }
        .feature-icon {
            font-size: 3rem;
            margin-bottom: 20px;
            color: var(--secondary-color);
        }
        .btn-feature {
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 25px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        .btn-feature:hover {
            transform: scale(1.05);
            color: white;
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.4);
        }
        .stats-section {
            background-color: var(--light-color);
            padding: 60px 0;
            border-radius: 20px;
            margin: 40px 0;
        }
        .stat-number {
            font-size: 2.5rem;
            font-weight: bold;
            color: var(--primary-color);
        }
        .footer {
            background-color: var(--dark-color);
            color: white;
            padding: 30px 0;
            margin-top: 60px;
        }
        .brand-highlight {
            color: var(--secondary-color);
            font-weight: bold;
        }
        .welcome-text {
            font-size: 1.2rem;
            opacity: 0.9;
            margin-bottom: 30px;
        }
        a:focus, button:focus {
            outline: 2px solid var(--secondary-color);
            outline-offset: 2px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: var(--primary-color);">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="data:image/png;base64,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" alt="Library Logo" style="height:40px; width:auto; margin-right:10px;">
            <span>LIBRARIA</span>
        </a>

        <!-- Toggler for Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">
                        <i class="fas fa-home me-1"></i>Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="books.php">
                        <i class="fas fa-book me-1"></i>Books
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="members.php">
                        <i class="fas fa-users me-1"></i>Members
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="borrow_records.php">
                        <i class="fas fa-exchange-alt me-1"></i>Borrow Records
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-plus me-1"></i>Add New
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="add_book.php">Add Book</a></li>
                        <li><a class="dropdown-item" href="add_member.php">Add Member</a></li>
                        <li><a class="dropdown-item" href="add_borrow.php">Add Borrow Record</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-4">Welcome to <span class="brand-highlight">LIBRARIA</span></h1>
            <p class="welcome-text">VINATSALLTHELIBRARIA - Your Complete Library Management Solution</p>
            <p class="lead">Manage your library efficiently with our comprehensive system for books, members, and borrowing operations.</p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <!-- Quick Stats -->
        <div class="stats-section">
            <div class="row text-center">
                <div class="col-md-4 mb-4">
                    <?php
                    $total_books = $conn->query("SELECT COUNT(*) as total FROM books")->fetch_assoc()['total'];
                    ?>
                    <div class="stat-number"><?php echo $total_books; ?></div>
                    <p class="text-muted">Total Books</p>
                </div>
                <div class="col-md-4 mb-4">
                    <?php
                    $total_members = $conn->query("SELECT COUNT(*) as total FROM members")->fetch_assoc()['total'];
                    ?>
                    <div class="stat-number"><?php echo $total_members; ?></div>
                    <p class="text-muted">Registered Members</p>
                </div>
                <div class="col-md-4 mb-4">
                    <?php
                    $active_borrows = $conn->query("SELECT COUNT(*) as total FROM borrow_records WHERE return_date IS NULL")->fetch_assoc()['total'];
                    ?>
                    <div class="stat-number"><?php echo $active_borrows; ?></div>
                    <p class="text-muted">Active Borrows</p>
                </div>
            </div>
        </div>

        <!-- Feature Cards -->
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card feature-card">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <h3 class="card-title">Manage Books</h3>
                        <p class="card-text">Add, edit, and manage your book collection. Track availability and categories.</p>
                        <a href="books.php" class="btn btn-feature mt-3">
                            <i class="fas fa-arrow-right me-2"></i>Manage Books
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card feature-card">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="card-title">Manage Members</h3>
                        <p class="card-text">Register and manage library members. Track contact information and membership.</p>
                        <a href="members.php" class="btn btn-feature mt-3">
                            <i class="fas fa-arrow-right me-2"></i>Manage Members
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card feature-card">
                    <div class="card-body text-center p-4">
                        <div class="feature-icon">
                            <i class="fas fa-exchange-alt"></i>
                        </div>
                        <h3 class="card-title">Borrow Records</h3>
                        <p class="card-text">Track book borrowing and returns. Manage due dates and member activity.</p>
                        <a href="borrow_records.php" class="btn btn-feature mt-3">
                            <i class="fas fa-arrow-right me-2"></i>View Records
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-light">
                        <h4 class="mb-0"><i class="fas fa-bolt me-2"></i>Quick Actions</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-6 mb-3">
                                <a href="add_book.php" class="btn btn-outline-primary w-100">
                                    <i class="fas fa-plus me-2"></i>Add Book
                                </a>
                            </div>
                            <div class="col-md-3 col-6 mb-3">
                                <a href="add_member.php" class="btn btn-outline-success w-100">
                                    <i class="fas fa-user-plus me-2"></i>Add Member
                                </a>
                            </div>
                            <div class="col-md-3 col-6 mb-3">
                                <a href="add_borrow.php" class="btn btn-outline-warning w-100">
                                    <i class="fas fa-hand-holding me-2"></i>Lend Book
                                </a>
                            </div>
                            <div class="col-md-3 col-6 mb-3">
                                <a href="borrow_records.php" class="btn btn-outline-info w-100">
                                    <i class="fas fa-list me-2"></i>View All Records
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5><i class="fas fa-book me-2"></i>LIBRARIA</h5>
                    <p>VINATSALLTHELIBRARIA - Complete Library Management Solution</p>
                    <p>Streamlining library operations since 2024</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="books.php" class="text-light">Books Management</a></li>
                        <li><a href="members.php" class="text-light">Members Management</a></li>
                        <li><a href="borrow_records.php" class="text-light">Borrow Records</a></li>
                    </ul>
                </div>
            </div>
            <hr class="my-4" style="border-color: rgba(255,255,255,0.1);">
            <div class="text-center">
                <p class="mb-0">&copy; 2024 LIBRARIA. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Simple animation on page load
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.feature-card');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                
                setTimeout(() => {
                    card.style.transition = 'all 0.5s ease';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 200);
            });
        });
    </script>
</body>
</html>