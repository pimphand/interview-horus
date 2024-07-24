<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Mockup</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <style>
        .side {
            display: block;
            transition: transform 0.3s ease;
            width: 400px;
            min-width: 270px;
            max-width: 270px;
            border-radius: 10px;
            box-sizing: border-box;
            overflow: hidden; /* Pastikan konten yang melebihi batas tersembunyi */
        }

        .side-hidden {
            transform: translateX(-100%);
        }

        .side-panel {
            position: fixed;
            top: 0;
            left: -300px;
            width: 300px;
            height: 100%;
            background-color: #f8f9fa;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.5);
            transition: left 0.3s ease, opacity 0.3s ease;
            z-index: 1050;
            padding: 20px;
            display: none;
            opacity: 0;
        }

        .side-panel.show {
            left: 0;
            display: block;
            opacity: 1;
            animation: slideIn 0.5s ease-in-out, fadeIn 0.5s ease-in-out;
        }

        .side-panel.hide {
            animation: slideOut 0.5s ease-in-out, fadeOut 0.5s ease-in-out;
            opacity: 0;
            left: -300px;
        }

        @keyframes slideIn {
            0% {
                left: -300px;
            }
            100% {
                left: 0;
            }
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        @keyframes slideOut {
            0% {
                left: 0;
            }
            100% {
                left: -300px;
            }
        }

        @keyframes fadeOut {
            0% {
                opacity: 1;
            }
            100% {
                opacity: 0;
            }
        }

        .modal-dialog.custom {
            max-width: 50vw;
            margin: 1.75rem auto;
        }

        .modal-content {
            border-radius: 0.5rem;
        }

        .hamburger-menu {
            display: none;
            flex-direction: column;
            justify-content: space-around;
            width: 30px;
            height: 30px;
            cursor: pointer;
        }

        .hamburger-menu span {
            display: block;
            width: 100%;
            height: 9px;
            background-color: white;
            border-radius: 2px;
            margin: 2px;
        }

        .card-price {
            position: absolute;
            bottom: 41%;
            right: 77%;
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
        }

        @media only screen and (max-width: 768px) {
            .side {
                display: none;
            }

            .text_ {
                display: none;
            }

            ._button {
                display: none;
            }

            .hamburger-menu {
                display: block;
            }
            .card-price {
                bottom: 41%;
                right: 73%;
            }
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
            max-height: 200px;
            min-height: 200px;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-description {
            text-align: center;
            margin-top: 10px;
        }

        .card-button {
            text-align: center;
        }
    </style>

    {{-- ajax header --}}
</head>
<body class="bg-light">
        <header class="d-flex justify-content-between align-items-center bg-dark text-white p-3">
            <div class="d-flex align-items-center">
                <img src="https://via.placeholder.com/50" alt="Profile Picture" class="rounded-circle mr-3 _button" style="width: 50px; height: 50px;">
                <h1 class="h4 m-0 _button">Nama</h1>
                <div class="hamburger-menu" id="showSidePanel">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <h1 class="h4 m-0 text_">Interview</h1>
            <a href="/" class="btn btn-secondary">Home</a>
        </header>
        <main class="d-flex">

            <section class="flex-fill p-4">
                <h2 class="h4 mb-4">History Voucher</h2>
                <div class="card">
                    <table class="table responsive">
                        <thead>
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="table">

                        </tbody>
                    </table>
                </div>
            </section>
            <aside class="bg-secondary side p-4 mt-3">
                <span class="btn btn-light btn-block mb-2"style="pointer-events: none;" disabled>Kategori Voucher</span>

                    <div class="_show_categories">

                    </div>

                <button class="btn btn-dark btn-block text-white">Log Out</button>
            </aside>
        </main>
    </div>

    <div class="side-panel" id="sidePanel">
        <button type="button" class="close" aria-label="Close" id="closeSidePanel">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="d-flex flex-column align-items-center">
            <img src="https://via.placeholder.com/50" alt="Profile Picture" class="rounded-circle mb-3" style="width: 50px; height: 50px;">
            <h2 class="h4 mb-4">Nama</h2>
            <button class="btn btn-light btn-block mb-2 w-75">Kategori Voucher</button>

            <div class="_show_categories">

            </div>
        <button class="btn btn-dark btn-block w-75 text-white">Log Out</button>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'Authorization': 'Bearer '+ localStorage.getItem('token'),
            }
        });

        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        function showSuccessToast() {
            Toast.fire({
                icon: 'success',
                title: 'Voucher berhasil di remove'
            });
        }

        $(document).ready(function() {
            $('.hamburger-menu').click(function() {
                $('aside').toggleClass('side-hidden');
            });

            $('#showSidePanel').click(function() {
                $('#sidePanel').removeClass('hide').addClass('show');
            });

            $('#closeSidePanel').click(function() {
                $('#sidePanel').removeClass('show').addClass('hide');
            });

            // Remove side panel from DOM after animation ends
            $('#sidePanel').on('animationend', function() {
                if ($(this).hasClass('hide')) {
                    $(this).css('display', 'none');
                }
            });

            function getVoucher(id = '') {
                $.ajax({
                type: "GET",
                url: "/api/vouchers?category_id=" + id + "&history=1",
                dataType: "json",
                success: function (response) {
                    $('#table').html('');
                    const formatter = new Intl.NumberFormat('id-ID', {
                        style: 'currency',
                        currency: 'IDR',
                        minimumFractionDigits: 0
                    });
                    const dateFormatter = new Intl.DateTimeFormat('id-ID', {
                        day: '2-digit',
                        month: 'long',
                        year: 'numeric'
                    });
                    $(document).find('._total_voucher').text(response.total);
                    $.each(response.data.data, function (indexInArray, valueOfElement) {
                    let html = `
                        <tr>
                            <th scope="row">
                                <div>
                                    <img src="${valueOfElement.photo}" alt="Image" class="rounded" style="width: 70px; margin-right: 5px;">
                                    <span style="text-align: left;">${valueOfElement.name}</span>
                                </div>
                            </th>
                            <td>
                                <button class="btn btn-danger flex btn-claim" data-id="${valueOfElement.id}"><i class="fa fa-trash"></i> remove</button>
                            </td>
                        </tr>
                    `;
                    $('#table').append(html);
                });
                }
            });
            }

            $('._show_categories').on('click', '.button_filter', function() {
                let id = $(this).data('id');
                getVoucher(id);
            });

            function getCategory(callback) {
                 $('._show_categories').html('');
                $.ajax({
                    url: "api/categories?history=1",
                    method: 'GET',
                    success: function(response) {
                        let html =`
                            <button data-id="" class="btn btn-light btn-block d-flex justify-content-between align-items-center mb-2 button_filter">
                                <span>Semua</span>
                                <span class="badge badge-primary _total_voucher"></span>
                            </button>`
                            response.forEach(element => {
                                html += `
                                    <button data-id="${element.id}" class="btn btn-light btn-block d-flex justify-content-between align-items-center mb-2 button_filter">
                                        <span>${element.name}</span>
                                        <span class="badge badge-primary">${element.vouchers_count}</span>
                                    </button>
                                `;

                            });
                            $('._show_categories').append(html);
                            if (callback) callback();
                        },
                    error: function(error) {
                        console.error('Error:', error);
                    }
                });
            }
            getCategory(getVoucher);

            $(document).on('click', '.btn-claim', function() {
                let id = $(this).data('id');
                remove(id);
            });

            function remove(id) {
                Swal.fire({
                    title: "apakah anda yakin?",
                    text: "Anda akan meremove voucher ini",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, remove!",
                    cancelButtonText: "Batal"
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "delete",
                            url: "api/voucher-claims/"+id,
                            success: function (response) {
                                showSuccessToast()
                                getCategory(getVoucher);
                            }
                        });
                    }
                });
            }
        });
    </script>
</body>
</html>