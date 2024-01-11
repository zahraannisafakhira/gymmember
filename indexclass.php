<?php
$host = "localhost";
$port = "3306";
$username = "root";
$password = "";
$database = "gymmember";

$koneksi = new mysqli($host, $username, $password, $database, $port);

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Handle search
$search = isset($_GET['search']) ? $koneksi->real_escape_string($_GET['search']) : '';

// Handle filter for id_pembeli
$memberIdFilter = isset($_GET['class_id']) ? $koneksi->real_escape_string($_GET['class_id']) : '';

// Handle filter for nama
$nameFilter = isset($_GET['class_name']) ? $koneksi->real_escape_string($_GET['class_name']) : '';

// Pagination config for the search results
$resultsPerPage = 7;
$currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($currentPage - 1) * $resultsPerPage;

// Build the WHERE clause for the SQL query
$whereClause = "WHERE 1";

if (!empty($search)) {
    $whereClause .= " AND (class_id LIKE '%$search%' OR class_name LIKE '%$search%')";
}

if (!empty($memberIdFilter)) {
    $whereClause .= " AND class_id = '$memberIdFilter'";
}

if (!empty($nameFilter)) {
    $whereClause .= " AND class_name = '$nameFilter'";
}

// Query to retrieve filtered data with pagination
$sql = "SELECT * FROM class $whereClause LIMIT $offset, $resultsPerPage";
$result = $koneksi->query($sql);

// Query to count total results for pagination
$countSql = "SELECT COUNT(*) as total FROM class $whereClause";
$countResult = $koneksi->query($countSql);
$totalCount = $countResult->fetch_assoc()['total'];

// Calculate total pages
$totalPages = ceil($totalCount / $resultsPerPage);
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Class</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f5f5f5;
            padding-top: 50px;
            font-family: Arial, sans-serif;
        }

        .container {
            margin-top: 30px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #007bff;
        }

        .form-inline {
            justify-content: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .pagination {
            justify-content: center;
            margin-top: 20px;
        }

        .pagination a {
            padding: 8px 16px;
            margin: 0 5px;
            border: 1px solid #007bff;
            color: #007bff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .pagination a.current-page {
            background-color: #007bff;
            color: white;
        }

        .action-links a {
            margin-right: 10px;
            color: white;
            text-decoration: none;
            transition: color 0.3s;
        }

        .action-links a:hover {
            color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Data Class</h1>

        <!-- Search form -->
        <form class="form-inline">
            <input type="text" class="form-control mr-sm-2" placeholder="Search" name="search" value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>

        <!-- Display what was entered into the input field -->
        <?php if (!empty($search)) : ?>
            <p>Showing results for: <?php echo htmlspecialchars($search); ?></p>
        <?php endif; ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Class ID</th>
                    <th>Class Name</th>
                    <th>Price</th>
                    <th>Action</th>
            </thead>
            <tbody>
                <?php
                // Check if the query was successful before fetching results
                if ($result) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['class_id']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['class_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['price']) . "</td>";

                        echo '<td>
                            <a href="updateclass.php?class_id=' . $row['class_id'] . '">Update</a> 
                            <a href="deleteclass.php?class_id=' . $row['class_id'] . '">Delete</a>
                            <a href="detailclass.php?class_id=' . $row['class_id'] . '">Details</a>
                            </td>';
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='9'>Tidak ada data.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Display the search results table -->
        <div class="pagination">
            <nav aria-label="Page navigation">
                <ul class="pagination">
                    <?php
                    // Pagination links
                    $maxPagesToShow = 5;
                    $startPage = max(1, $currentPage - floor($maxPagesToShow / 2));
                    $endPage = min($startPage + $maxPagesToShow - 1, $totalPages);

                    for ($i = $startPage; $i <= $endPage; $i++) {
                        if ($i == $currentPage) {
                            echo '<a href="?search=' . $search . '&page=' . $i . '" class="current-page">' . $i . '</a>';
                        } else {
                            echo '<a href="?search=' . $search . '&page=' . $i . '">' . $i . '</a>';
                        }
                    }
                    ?>
        </div>
        </ul>
        </nav>

        <div class="action-links">
            <a href="createmember.php" class="btn btn-primary">Create Data</a>
            <a href="detail.php" class="btn btn-secondary">View All Data</a>
            <a href="createclass.php" class="btn btn-secondary">Create Class</a>
            <a href="indexclass.php" class="btn btn-secondary">View Class</a>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<?php
// Close the database connection
$koneksi->close();
?>