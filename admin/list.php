<?php 
require_once "connect.php";
require_once '../libs/Helper.class.php';

// Kiểm tra và thêm điều kiện tìm kiếm
$searchValue = isset($_GET['search']) ? trim($_GET['search']) : '';
$query = "SELECT `id`, `link`, `status`, `ordering` FROM rss";
if ($searchValue != '') {
    $query .= " WHERE `link` LIKE '%$searchValue%'"; // Thêm khoảng trắng trước 'WHERE'
}

// Truy xuất dữ liệu sau khi câu truy vấn đã được cập nhật
$items = $database->listRecord($query);

// In ra dữ liệu để kiểm tra
echo '<pre style="color:red">';
print_r($items);
echo '</pre>';

// Hiển thị các kết quả
$xhtml = '';
foreach ($items as $item) {
    $id       = $item['id'];
    $link     = $item['link'];
    $status   = Helper::showItemStatus($id, $item['status']);
    $ordering = $item['ordering'];

    $xhtml .= '
    <tr>
        <td>' . $id . '</td>
        <td>' . $link . '</td>
        <td>' . $status . '</td>
        <td>' . $ordering . '</td>
        <td>
            <a href="edit.php?id=' . $id . '" class="btn btn-sm btn-warning">Edit</a>
            <a href="delete.php?id=' . $id . '" class="btn btn-sm btn-danger btn-delete">Delete</a>
        </td>
    </tr>
    ';
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/mdb.min.css">
    <link rel="stylesheet" href="css/my-style.css">
</head>

<body style="background-color: #eee;">
    <div class="container pt-5">
        <div class="card mb-4">
            <div class="card-body d-flex justify-content-between">
                <a href="../index.php" class="btn btn-primary m-0">Back to website</a>
                <a href="logout.php" class="btn btn-info m-0">Logout</a>
            </div>
        </div>
        <div class="card mb-4">
            <div class="card-body">
                <form action="" method="get">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="search" placeholder="Enter search keyword...."
                            value="<?php echo $searchValue?>">
                        <div class="input-group-append">
                            <button type="submit"
                                class="btn btn-md btn-outline-primary m-0 px-3 py-2 z-depth-0 waves-effect"
                                type="button">Search</button>
                            <a href="list.php"
                                class="btn btn-md btn-outline-danger m-0 px-3 py-2 z-depth-0 waves-effect"
                                type="button">Clear</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="m-0">RSS List</h4>
                <a href="form.html" class="btn btn-success m-0">Add</a>
            </div>
            <div class="card-body">
                <table class="table table-striped btn-table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Link</th>
                            <th scope="col">Status</th>
                            <th scope="col">Ordering</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $xhtml?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/mdb.min.js"></script>
</body>

</html>