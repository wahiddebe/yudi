<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aplikasi Gis</title>
    <script src="http://maps.google.com/maps/api/js?key={{$gmaps_api_key}}"></script>
    <script src="{{ asset('js/gmaps.js')}}"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link type="text/css" rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </style>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous">
    </script>
    <style type="text/css">
        #map {

            width: 100%;
            height: 100vh;
        }

        .cari {
            position: absolute;
            z-index: 1000;
            top: 53px;
            left: 200px;
        }

        .text-navbar {
            font-family: 'Roboto';
            font-size: medium;

        }

        /* Small devices (tablets, 768px and up) */
        @media (max-width: 360px) {
            .cari {
                position: absolute;
                z-index: 1000;
                top: 120px;
                left: 26px;
            }
        }

        .gmaps {
            position: absolute;
            z-index: 999;
            margin: 13px;
            right: 50px;
        }

        .modal-content {
            position: relative;
            background-color: #ffffffc9;
            border: 1px solid #999;
            border: 1px solid rgba(0, 0, 0, .2);
            border-radius: 6px;
            box-shadow: 0 3px 9px rgba(0, 0, 0, .5);
            outline: 0;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light ">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link text-navbar" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-navbar" href="{{route('route')}}">Directions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-navbar" data-toggle="modal" href='#modal-id'>Login</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="modal fade" id="modal-id">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="close m-3 align-self-lg-start " data-dismiss="modal"
                    aria-hidden="true">&times;</button>
                <div class="modal-header">
                    <h4 class="modal-title">Login</h4>
                </div>
                <div class="modal-body">
                    @include('auth.partial_login')
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <style type="text/css">
            .no-padding {
                padding: 0px;
            }

            .container,
            .container-fluid {
                padding-left: 0px;
                padding-right: 0px;
            }

            .filter-gmaps {
                position: absolute;
                z-index: 999;
                margin: 69px;
                /*width: 100px;*/
            }

            .summary-gmaps {
                position: absolute;
                z-index: 999;
                margin-top: 121px;
                margin-left: 10px;
                width: 199px;
            }

            .form-inline {
                display: flex;
            }

            .panel {
                margin-bottom: 22px;
                background-color: #ffffff3d;
                border: 1px solid transparent;
                border-radius: 4px;
                box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
            }
        </style>

        <div class="summary-gmaps">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Data</h3>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Jum</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $jml=0; ?>
                        @foreach($kategoryCount as $cc)

                        <tr>
                            <td>{{$cc->name}}</td>
                            <td>{{$cc->jml}}</td>
                        </tr>
                        <?php $jml+=$cc->jml; ?>
                        @endforeach
                        <tr>
                            <td><strong>Total</strong></td>
                            <td><strong>{{$jml}}</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="map"></div>


        @push('js')

    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        var map = new GMaps({
          el: '#map',
          zoom: {{$set_zoom}},
          lat: {{ $latitude_centre }},
          lng: {{ $longitude_centre }}
      });

        @foreach($data as $d)
        map.addMarker({
            lat: '{{$d->lat}}',
            lng: '{{$d->long}}',
            title: '{{$d->title}} #',
            icon: 'img/{{$d->Kategori->icon}}',
            infoWindow: {
                content : '<h3>{{$d->title}}</h3><p>{{$d->description}}</p><p>{{$d->no_telp}}</p>'
            }
        });
        @endforeach
    </script>

    @stack('js')
</body>

</html>
