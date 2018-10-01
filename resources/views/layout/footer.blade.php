<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script src="{{ asset('/public/js/slotmachine.js') }}"></script>
<script src="{{ asset('/public/js/jquery.slotmachine.js') }}"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js"
        integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+"
        crossorigin="anonymous"></script>
<script type="text/javascript"
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCx3hq2cPOsxGGoLrOjmzQb_zNz2p40LeI"></script>
<script>
    $(function () {

        /* 拉霸 開始 */
        const btn = document.querySelector('#actBtn');
        const el = document.querySelector('#lunchList');
        const machine = new SlotMachine(el);

        $(btn).on('click', function () {

            $('#printAddress h2').html('');
            $('.lunch_item').removeClass('target');

            $(el).slotMachine({
                active: 1,
                delay: 450
                // },machine.shuffle(5, ajaxGetAddress));
            }, machine.shuffle(5));

        });
        /* 拉霸 結束 */

        $('#mapModal').on('show.bs.modal', function (e) {
            var target = $(e.relatedTarget);
            var title = target.data('title');
            var address = target.data('address');
            var modal = $(this);
            modal.find('.modal-title').text(title);
            CodeAddress(address);
        });

        $('#menuModal').on('show.bs.modal', function (e) {
            var target = $(e.relatedTarget);
            var modal = $(this);
            var menu = target.data('menu');
            modal.find('.modal-body').html('<img src="public/upload/'+menu+'" class="img-thumbnail">');
        });

    });

    // var lat = '';
    // var lng = '';
    // var shopName = 'AAA';
    // var shopADDR = '新北市中和區中正路';

    function CodeAddress(address) {
        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({'address': address}, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                var lat = results[0].geometry.location.lat();
                var lng = results[0].geometry.location.lng();
                CreateMap(lat, lng);
                Distance('新北市中和區中和路366號', address);
            } else {
                alert("失敗, 原因: " + status);
            }
        });
    }

    function CreateMap(lat, lng) {
        $('#map').css('height', '360px');
        $('#map').css('height', '360px');
        var myLatlng = new google.maps.LatLng(lat, lng);
        // var markerImg = 'assets/img/p-salon.png';
        // var markerContent = '<h4>' + shopName + '</h4><p>' + shopADDR + '</p>';

        var mapOptions = {
            center: myLatlng,
            zoom: 16,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        var map = new google.maps.Map(document.getElementById("map"), mapOptions);

        var marker = new google.maps.Marker({
            position: myLatlng,
            map: map,
            // icon: markerImg
        });

        // var infowindow = new google.maps.InfoWindow({
        //     content: markerContent
        // });
        //
        // google.maps.event.addListener(marker, 'click', function() {
        //     infowindow.open(map,marker);
        // });
    }

    /*
    function Distance(start, end) {
        var request = {
            origin: start,
            destination: end,
            travelMode: google.maps.DirectionsTravelMode.DRIVING
        };

        var directionsService = new google.maps.DirectionsService();
        directionsService.route(request, function (response, status) {
            var strTmp = '';
            if (status == google.maps.DirectionsStatus.OK) {
                var route = response.routes[0];
                for (var i = 0; i < route.legs.length; i++) {
                    var routeSegment = i + 1;
                    strTmp += route.legs[i].distance.text;
                }
                //取得距離(正整數，公尺)
                var dist = parseInt(parseFloat(strTmp) * 1000).toString();
            }
        });
    }
    */


</script>
