<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Cargo Management</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #111;
            color: #fff;
        }
        .card-custom {
            background-color: #222;
            color: #fff;
            border: none;
            border-radius: 10px;
        }
        .btn-contact {
            background-color: #f48221;
            color: white;
            font-weight: bold;
        }
        .location-icon, .weight-icon {
            color: #39d57f;
        }
        .rating {
            background-color: #ffd700;
            color: #111;
            padding: 0.2em 0.5em;
            border-radius: 5px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <!-- Header -->
        <div class="mb-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <strong>مبدا:</strong> <span>استان تهران</span>
                </div>
                <div>
                    <strong>مقصد:</strong> <span>همه استان‌ها</span>
                </div>
            </div>
        </div>

        <!-- First Cargo Card -->
        <div class="card card-custom mb-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <h5>توافقی</h5>
                        <span>690 Km</span>
                    </div>
                    <div class="col-md-4 text-center">
                        <p class="mb-0">تهران</p>
                        <span>استان تهران</span>
                    </div>
                    <div class="col-md-4 text-end">
                        <p class="mb-0">مرند</p>
                        <span>استان آذربایجان شرقی</span>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <i class="bi bi-box-seam location-icon"></i>
                        <span>گل و گیاه</span>
                        <i class="bi bi-weight weight-icon ms-2"></i>
                        <span>3 تن</span>
                    </div>
                    <button class="btn btn-contact">تماس با صاحب‌بار</button>
                </div>
            </div>
        </div>

        <!-- Second Cargo Card -->
        <div class="card card-custom">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <span class="rating">4.7</span>
                        <span>4,500,000 تومان</span>
                        <span>250 Km</span>
                    </div>
                    <div class="col-md-4 text-center">
                        <p class="mb-0">تهران</p>
                        <span>استان تهران</span>
                    </div>
                    <div class="col-md-4 text-end">
                        <p class="mb-0">ساری</p>
                        <span>استان مازندران</span>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <i class="bi bi-box-seam location-icon"></i>
                        <span>دارو</span>
                        <i class="bi bi-weight weight-icon ms-2"></i>
                        <span>4 تن</span>
                    </div>
                    <button class="btn btn-contact">تماس با صاحب‌بار</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</body>
</html>
