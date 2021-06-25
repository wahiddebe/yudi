<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Distances btn two cities App</title>
    <link href="{{ asset('route/Content/bootstrap.min.css') }}" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <script src="https://kit.fontawesome.com/ab2155e76b.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link href="{{ asset('route/App.css') }}" rel="stylesheet" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
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
                <li class="nav-item">
                    <a class="nav-link text-navbar" href="/">Home</a>
                </li>
                <li class="nav-item active">
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


    <div class="jumbotron">
        <div class="container-fluid">
            <h1>Find The Distance Between Two Places.</h1>
            <p>This App Will Help You Calculate Your Travelling Distances.</p>
            <form class="form-horizontal">
                <div class="form-group">
                    <label for="from" class="col-xs-2 control-label"><i class="far fa-dot-circle"></i></label>
                    <div class="col-xs-4">
                        <select name="from" id="from" placeholder="Origin" class="form-control">
                            @foreach ($data as $item)
                            <option value="{{ $item->lat." ,".$item->long }}" data-title="{{ $item->title }}">
                                {{ $item->title }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">

                    <label for="to" class="col-xs-2 control-label"><i class="fas fa-map-marker-alt"></i></label>
                    <div class="col-xs-4">
                        <select name="to" id="to" placeholder="to" class="form-control">
                            @foreach ($data as $item)
                            <option value="{{ $item->lat." ,".$item->long }}" data-title="{{ $item->title }}">
                                {{ $item->title }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>

            </form>

            <div class="col-xs-offset-2 col-xs-10">
                <button class="btn btn-info btn-lg " onclick="calcRoute();"><i class="fas fa-map-signs"></i></button>
            </div>
        </div>
        <div class="container-fluid">
            <div id="googleMap">

            </div>
            <div id="output">

            </div>
        </div>

    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://maps.googleapis.com/maps/api/js?key={{ $key }}&libraries=places">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->

    <script>
        //javascript.js
        //set map options
        var myLatLng = {  lat: -7.0496229, lng: 110.4274767 };

        var mapOptions = {
        center: myLatLng,
        zoom: 12,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        };

        //create map
        var map = new google.maps.Map(document.getElementById("googleMap"), mapOptions);

        //create a DirectionsService object to use the route method and get a result for our request
        var directionsService = new google.maps.DirectionsService();

        //create a DirectionsRenderer object which we will use to display the route
        var directionsDisplay = new google.maps.DirectionsRenderer();

        //bind the DirectionsRenderer to the map
        directionsDisplay.setMap(map);

        //define calcRoute function
        function calcRoute() {
        //create request
        var request = {
        origin: document.getElementById("from").value,
        destination: document.getElementById("to").value,
        travelMode: google.maps.TravelMode.DRIVING, //WALKING, BYCYCLING, TRANSIT
        unitSystem: google.maps.UnitSystem.METRIC,
        };

        //pass the request to the route method
        directionsService.route(request, function (result, status) {
        if (status == google.maps.DirectionsStatus.OK) {
        //Get distance and time
        const output = document.querySelector("#output");
        var from=document.getElementById("from");
        var fromOption=from.options[from.selectedIndex];
        var to=document.getElementById("to");
        var toOption=to.options[to.selectedIndex];
        output.innerHTML =
        "<div class='alert-info'>From: " +
            fromOption.getAttribute("data-title") +
            ".<br />To: " +
            toOption.getAttribute("data-title") +
            ".<br /> Driving distance <i class='fas fa-road'></i> : " +
            result.routes[0].legs[0].distance.text +
            ".<br />Duration <i class='fas fa-hourglass-start'></i> : " +
            result.routes[0].legs[0].duration.text +
            ".</div>";

        //display route
        directionsDisplay.setDirections(result);
        } else {
        //delete route from map
        directionsDisplay.setDirections({ routes: [] });
        //center map in London
        map.setCenter(myLatLng);

        //show error message
        output.innerHTML =
        "<div class='alert-danger'><i class='fas fa-exclamation-triangle'></i> Could not retrieve driving distance.</div>";
        }
        });
        }

        //create autocomplete objects for all inputs
        // var options = {
        // types: ["(cities)"],
        // };

        // var input1 = document.getElementById("from");
        // var autocomplete1 = new google.maps.places.Autocomplete(input1, options);

        // var input2 = document.getElementById("to");
        // var autocomplete2 = new google.maps.places.Autocomplete(input2, options);
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
