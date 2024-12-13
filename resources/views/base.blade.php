<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>225 Sport @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="@yield('keywords', '225 sport')">
    <meta name="description" content="@yield('description', 'Site web de news sportives en Côte d\'Ivoire')">

    <!-- Favicon -->
    {{-- <link href="{{asset("img/favicon.ico")}}" rel="icon"> --}}



    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('logo/apple-touch-icon.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset("logo/favicon-32x32.png")}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('logo/favicon-16x16.png')}}">
    <link rel="manifest" href="{{asset("logo/site.webmanifest")}}">


    <!-- Google Web Fonts -->
    <link rel="preconnect" href="{{ secure_url("https://fonts.gstatic.com")}}">
    <link href="{{secure_url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap')}}" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="{{asset("https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css")}}" rel="stylesheet">



    <!-- Libraries Stylesheet -->
    <link href="{{asset("lib/owlcarousel/assets/owl.carousel.min.css")}}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset("css/style.css")}}" rel="stylesheet">


    <!-- Toastr CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Toastr JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>



    <script>
        function updateTime() {
            const now = new Date();
            const days = ['dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi'];
            const months = ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];

            const dayName = days[now.getDay()];
            const day = now.getDate();
            const monthName = months[now.getMonth()];
            const year = now.getFullYear();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');

            const formattedDate = `${dayName} ${day} ${monthName} ${year}, ${hours}:${minutes}:${seconds}`;

            document.getElementById('currentDateTime').textContent = formattedDate;
        }

        document.addEventListener('DOMContentLoaded', function () {
            updateTime();
            setInterval(updateTime, 1000); // Mettre à jour l'heure chaque seconde
        });
    </script>


{{-- Pour la bate de recherche  --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</head>

<body>

@include('include.navbar')




@yield('content')




    <!-- Footer Start -->
    <div class="pt-5 mt-5 container-fluid bg-dark px-sm-3 px-md-5">
        <div class="content-center py-4 row">
                <div class="mb-5 col-lg-12 d-lg-flex col-md-12 d-flex">
                    <p class="font-weight-medium col-lg-4 col-md-6"><i class="mr-2 fa fa-map-marker-alt"></i>Abidjan, Cocody</p>
                    <p class="font-weight-medium col-lg-4 col-md-6"><i class="mr-2 fa fa-phone-alt"></i>+225 07 07 30 06 61</p>
                    <p class="font-weight-medium col-lg-4 col-md-6"><i class="mr-2 fa fa-envelope"></i>info@example.com</p>
                </div>
        </div>
    </div>
    <div class="py-4 container-fluid px-sm-3 px-md-5" style="background: #111111;">
        <p class="m-0 text-center">&copy; <a href="#">Komla Média</a>. Tous droits réservés.


        {{-- Distributed by <a href="https://themewagon.com">ThemeWagon</a> --}}
    </p>
    </div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary btn-square back-to-top"><i class="fa fa-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="{{ secure_url("https://code.jquery.com/jquery-3.4.1.min.js")}}"></script>
    <script src="{{ secure_url("https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js")}}"></script>
    <script src="{{asset("lib/easing/easing.min.js")}}"></script>
    <script src="{{asset("lib/owlcarousel/owl.carousel.min.js")}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset("js/main.js")}}"></script>


<script>
    $(document).ready(function() {
        $('#search').on('keyup', function() {
            var query = $(this).val();
            if (query.length > 0) {
                $.ajax({
                    url: "{{ route('articles.search') }}",
                    type: "GET",
                    data: {'query': query},
                    success: function(data) {
                        $('#search-results').empty();
                        if (data.length > 0) {
                            data.forEach(function(article) {
                                $('#search-results').append('<div class="search-item"><a href="/articles/' + escapeHtml(article.slug) + '">' + escapeHtml(article.titre) + '</a></div>');
                            });
                        } else {
                            $('#search-results').append('<div class="search-item">Aucun résultat trouvé</div>');
                        }
                    }
                });
            } else {
                $('#search-results').empty();
            }
        });

        function escapeHtml(text) {
            return text
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/"/g, "&quot;")
                .replace(/'/g, "&#039;");
        }
    });

</script>







</body>

</html>
