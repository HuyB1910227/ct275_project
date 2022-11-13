<?php

use CT275\Labs\SanPham;
use CT275\Labs\KhachHang;

require_once "../../bootstrap.php";
session_start();
if (isset($_SESSION["adminID"])) {
    $admin = new KhachHang($PDO);
    $admin->find($_SESSION["adminID"]);
} else {
    redirect("/quantri/dangnhap.php");
}
$sanpham = new SanPham($PDO);
$khachhang = new KhachHang($PDO);
$ds = $khachhang->allKH();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous" />
    <link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet" />
    <title>Trang quản trị</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body class="container-fluid">
    <header class="row">
        <div>
            <i class="fa fa-bars" id="control-bars"></i>
            <div class="logo pl-5">Bán Mắt Kính</div>
        </div>
        <div class="dropdown">
            <div class="dropdown-select">
                <span class="dropdown-value">
                    <div>
                        <img class="avatar" src="https://live.staticflickr.com/491/31818797506_41e52a8b36.jpg" alt="">
                        Nguyễn Minh Khôi
                    </div>
                    <i class="fa fa-caret-down ml-2"></i>
                </span>
            </div>
            <div class="dropdown-list">
                <div class="arrow-up"></div>
                <a class="dropdown-item" href="./hienthitaikhoan.php"><i class="fa fa-user"></i> Tài khoản</a>
                <a class="dropdown-item" href="./xulytaikhoan.php?dangxuat=1"><i class="fa fa-sign-out"></i> Đăng xuất</a>
            </div>
        </div>
    </header>
    <div class="row">
        <nav class="col-2 p-0">
            <a class="home" href="index.php"><i class="fa fa-home m-3"></i>Trang chủ</a>
            <div class="dropdown">
                <div class="dropdown-select">
                    <span class="dropdown-value"><i class="fa fa-product-hunt m-3"></i>Sản phẩm</span>
                    <i class="fa fa-caret-down mr-3"></i>
                </div>
                <div class="dropdown-list">
                    <a href="./hienthisanpham.php" class="dropdown-item">
                        <div class="pl-2">Quản lý sản phẩm</div>
                    </a>
                    <a href="./hienthiloaisanpham.php" class="dropdown-item">
                        <div class="pl-2">Quản lý loại sản phẩm</div>
                    </a>
                    <a href="./hienthihoadon.php" class="dropdown-item">
                        <div class="pl-2">Quản lý hoá đơn</div>
                    </a>
                </div>
            </div>
            <div class="dropdown">
                <div class="dropdown-select">
                    <span class="dropdown-value"><i class="fa fa-users m-3"></i>Khách hàng</span>
                    <i class="fa fa-caret-down mr-3"></i>
                </div>
                <div class="dropdown-list drop">
                    <a href="#" class="dropdown-item active-item">
                        <div class="pl-2">Quản lý tài khoản</div>
                    </a>
                </div>
            </div>

        </nav>
        <main class="col-10 mb-5">
            <h1>Quản lý tài khoản</h1>
            <div class="nav row mb-2">
                <a href="index.php" class="nav-item"><i class="fa fa-home"> Home</i></a>
                <span class="nav-item"><i class="fa fa-angle-right"></i></span>
                <a href="#" class="nav-item">Khách hàng</a>
                <span class="nav-item"><i class="fa fa-angle-right"></i></span>
                <a href="#" class="nav-item">Quản lý tài khoản</a>
            </div>
         
            <table id="DataTable" class="table table-bordered table-striped mt-5 bg-light">
                <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Họ tên</th>
                        <th scope="col">Email</th>
                        <th scope="col">Ngày sinh</th>
                        <th scope="col">Giới tính</th>
                        <th scope="col">SDT</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    foreach ($ds as $khachhang) : ?>
                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $khachhang->hoten ?></td>
                            <td><?= $khachhang->email ?></td>
                            <td><?= $khachhang->ngaysinh ?></td>
                            <td><?= $khachhang->gioitinh ?></td>
                            <td><?= $khachhang->sdt ?></td>
                            <td><?= $khachhang->diachi ?></td>
                            <td>
                                <form class="delete" action="<?= './xulytaikhoan.php' ?>" method="POST" onsubmit="return allow()" style="display: inline;">
                                    <input type="hidden" name="id" value="<?= $khachhang->getId() ?>">
                                    <button type="submit" class="btn btn-xs btn-danger" name="delete-contact">
                                        Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </main>
    </div>
    <footer class="row mt-1">
        &copy; Bản quyền thuộc về Nguyễn Minh Khôi, Đỗ Thái Gia Huy
    </footer>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="./js/script.js"></script>
    <script>
        function allow() {
            return confirm("Bạn có chắc muốn xoá");
        }
    </script>
</body>

</html>