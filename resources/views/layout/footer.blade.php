
{{--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>--}}
<script src="https://code.jquery.com/jquery-2.2.4.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="{{ asset('/public/js/slotmachine.js') }}"></script>
<script src="{{ asset('/public/js/jquery.slotmachine.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/languages/javascript.min.js"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCx3hq2cPOsxGGoLrOjmzQb_zNz2p40LeI"></script>

{{--<script id="codeScript1">--}}
    {{--const btn = document.querySelector('#actBtn');--}}
    {{--const el = document.querySelector('#lunchList');--}}
    {{--const machine = new SlotMachine(el);--}}

    {{--btn.addEventListener('click', () => {--}}
        {{--machine.shuffle(5, () => {--}}
            {{--fetch('/item')--}}
                {{--.then(function(response) {--}}
                    {{--return response.text()--}}
                {{--}).then(function(text) {--}}
                {{--console.log(text)--}}
            {{--}).catch(function(err) {--}}
                {{--// Error--}}
            {{--})--}}
        {{--});--}}
    {{--});--}}
{{--</script>--}}

<script>
    $(function () {

        const btn = document.querySelector('#actBtn');
        const el = document.querySelector('#lunchList');
        const machine = new SlotMachine(el);
        /*
        var ajaxGetAddress = function(active){
            
            var targetKey = active + 1;

            $('.lunch_item').eq(targetKey).addClass('target');

            var key = $('.target').data('key');

            $.ajax({
                url: './ajaxGetAddress',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: key
                },
                success: function(res) {
                    console.log(res);
                    $('#printAddress h2').html(res.address);
                },
                error: function(xhr) {
                    console.log('Ajax request 發生錯誤');
                }
            });
        };
        */

        $(btn).on('click', function () {

            $('#printAddress h2').html('');
            $('.lunch_item').removeClass('target');

            $(el).slotMachine({
                active: 1,
                delay: 450
            // },machine.shuffle(5, ajaxGetAddress));
            },machine.shuffle(5));

        });

        $('#mapModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var title = button.data('title');
            var address = button.data('address');
            var modal = $(this);
            modal.find('.modal-title').text(title);
            // modal.find('.modal-body input').val(recipient);
            CodeAddress(address);
        })

        // $("#mapModal").on("show.bs.modal", function(e) {
        //     // var id = $(e.relatedTarget).data('target-id');
        //     // $.get( "/controller/" + id, function( data ) {
        //     //     $(".modal-body").html(data.html);
        //     // });
        //     console.log('open modal');
        //
        // });

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
                CreateMap(lat,lng);
                Distance('新北市中和區中和路366號',address);
            } else {
                alert("失敗, 原因: " + status);
            }
        });
    }

    function CreateMap(lat,lng) {
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

    function Distance(start,end) {
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


</script>
