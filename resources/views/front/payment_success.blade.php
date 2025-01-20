<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Success</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        .payment-thankyou {
            background: #f5f7fa;
            height: 100vh;
            overflow: auto;
        }

        .text-primary {
            color: #00b0ff !important;
        }

        .payment-thankyou .container .card {
            max-width: 718px;
            box-shadow: 0 1px 3px #00000026;
            position: relative;
            background-color: #fff;
            border-radius: 8px;
            padding: 40px;
            margin: auto;
            border: 0 solid rgba(0, 0, 0, 0.125);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }

        .btn-primary {
            background: #00b0ff !important;
            border-color: #00b0ff !important;
        }

        .btn-primary:hover {
            color: #fff;
            background: #00b0ff;
            border-color: #00b0ff;
        }
    </style>
</head>

<body>

    <section class="payment-thankyou p-5">
        <div class="container mt-5">
            <div class="card">
                <svg width="60" height="60" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_148_1090)">
                        <path
                            d="M8 15C6.14348 15 4.36301 14.2625 3.05025 12.9497C1.7375 11.637 1 9.85652 1 8C1 6.14348 1.7375 4.36301 3.05025 3.05025C4.36301 1.7375 6.14348 1 8 1C9.85652 1 11.637 1.7375 12.9497 3.05025C14.2625 4.36301 15 6.14348 15 8C15 9.85652 14.2625 11.637 12.9497 12.9497C11.637 14.2625 9.85652 15 8 15ZM8 16C10.1217 16 12.1566 15.1571 13.6569 13.6569C15.1571 12.1566 16 10.1217 16 8C16 5.87827 15.1571 3.84344 13.6569 2.34315C12.1566 0.842855 10.1217 0 8 0C5.87827 0 3.84344 0.842855 2.34315 2.34315C0.842855 3.84344 0 5.87827 0 8C0 10.1217 0.842855 12.1566 2.34315 13.6569C3.84344 15.1571 5.87827 16 8 16Z"
                            fill="#4CAF50" />
                        <path
                            d="M10.9703 4.96979L10.9503 4.99179L7.47734 9.41679L5.38434 7.32279C5.24216 7.19031 5.05412 7.11819 4.85982 7.12162C4.66551 7.12505 4.48013 7.20376 4.34272 7.34117C4.2053 7.47858 4.12659 7.66397 4.12316 7.85827C4.11974 8.05257 4.19186 8.24062 4.32434 8.38279L6.97034 11.0298C7.04162 11.1009 7.1265 11.157 7.21992 11.1946C7.31334 11.2323 7.41339 11.2507 7.51408 11.2488C7.61478 11.247 7.71407 11.2249 7.80604 11.1838C7.898 11.1427 7.98074 11.0835 8.04934 11.0098L12.0413 6.01979C12.1773 5.87712 12.2516 5.68669 12.2482 5.48966C12.2449 5.29263 12.1641 5.10484 12.0234 4.96689C11.8827 4.82893 11.6933 4.7519 11.4963 4.75244C11.2992 4.75299 11.1103 4.83106 10.9703 4.96979Z"
                            fill="#4CAF50" />
                    </g>
                    <defs>
                        <clipPath id="clip0_148_1090">
                            <rect width="60" height="60" fill="white" />
                        </clipPath>
                    </defs>
                </svg>
                <h1 class="text-center text-primary my-4">{{ $message }}</h1>
                <a href="{{ url('/home') }}" class="btn btn-primary px-3 fw-semibold d-flex align-items-center gap-2 py-2"><svg
                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left"
                        viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8" />
                    </svg> Go back to Homepage</a>
            </div>
        </div>
    </section>

</body>

</html>