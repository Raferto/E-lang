<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Bare - Start Bootstrap Template</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
        <!-- Page content-->

        @if ($penerima == 'user')
            <div class="container">
                <div class="text-center mt-5">
                    <p>
                        Terimakasih telah melaporkan keluhan anda kepada kami! Keluhan anda akan segera kami tangani.
                    </p>
                    <div>
                        <p>
                            subjek : {{ $keluhan->subjek }}
                        </p>
                        <p>
                            isi keluhan:
                        </p>
                        <p>
                            {{ $keluhan->isi_keluhan }}
                        </p>
                    </div>
                </div>
            </div>
        @else
        <div class="container">
            <div class="text-center mt-5">
                <p>
                    Keluhan baru dari <strong>{{ $user->email }}</strong>.
                </p>
                <div>
                    <p>
                        subjek : {{ $keluhan->subjek }}
                    </p>
                    <p>
                        isi keluhan:
                    </p>
                    <p>
                        {{ $keluhan->isi_keluhan }}
                    </p>
                </div>
            </div>
        </div>
        @endif

        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
