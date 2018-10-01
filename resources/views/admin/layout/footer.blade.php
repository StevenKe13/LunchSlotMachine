<script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js"
        integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+"
        crossorigin="anonymous"></script>
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>


<script>
    $(function () {

        $('#showDataModal').on('show.bs.modal', function (e) {
            var modal = $(this);
            var id = $(e.relatedTarget).data('id');

            $.ajax({
                url: './item/' + id + '/show',
                dataType: 'json',
                type: 'GET',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function (res) {
                    var menu = res.menu ? '../public/upload/' + res.menu : '../public/upload/default-image.png';

                    modal.find('.modal-title').text(res.store_name);
                    modal.find('.modal-tel').text(res.tel);
                    modal.find('.modal-address').text(res.address);
                    modal.find('.modal-menu').attr('src', menu);
                    modal.find('.modal-created_at').text(res.created_at);
                },
                error: function (xhr) {
                    console.log('Ajax request 發生錯誤');
                }
            });

        });

        $('.deleteItem').on('click', function () {
            if (!confirm('確定刪除 ' + $(this).data('storename') + ' ？')) {
                return false;
            }
        });

        $('.changeStatus').on('change', function (e) {
            e.preventDefault();

            var _this = $(this);
            var id = _this.data('id');
            var status_mode;

            if(_this.prop('checked')) {
                status_mode = 'turnOn';
            }else{
                status_mode = 'turnOff';
            }

            $.ajax({
                url: './item/changeStatus',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: id,
                    status_mode: status_mode,
                },
                success: function (res) {
                    console.log(id+':'+status_mode);
                },
                error: function (xhr) {
                    console.log('Ajax request 發生錯誤');
                }
            });

        });

    });

</script>
