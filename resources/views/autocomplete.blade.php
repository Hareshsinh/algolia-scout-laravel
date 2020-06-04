<!DOCTYPE html>
<html>
<head>
    <title>Make Autocomplete search using jQuery UI in Laravel</title>

    <!-- Meta -->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('jqueryui/jquery-ui.min.css')}}">

    <!-- Script -->
    <script src="{{asset('jqueryui/jquery-3.1.1.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('jqueryui/jquery-ui.min.js')}}" type="text/javascript"></script>
</head>
<body>
<div class="container">
    <h1>Autocomplete Search with Laravel Scout!</h1>
    <!-- For defining autocomplete -->
    <input type="text"  class="form-control" id='employee_search'>

    <!-- For displaying selected option value from autocomplete suggestion -->
    <pre  class="form-control" id='employeeid' readonly></pre>
</div>
<!-- Script -->
<script type="text/javascript">
    // CSRF Token
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){
        var storeDb = {}
        $( "#employee_search" ).autocomplete({
            source: function( request, response ) {
                // Fetch data
                $.ajax({
                    url:"{{route('api.autocomplete')}}",
                    type: 'post',
                    dataType: "json",
                    data: {
                        _token: CSRF_TOKEN,
                        search: request.term
                    },
                    success: function( data ) {
                        var resp = $.map(data,function(obj){
                            storeDb[obj.id] = obj;
                            return {
                                label: obj.name + (obj.company ? ", " + obj.company : "") + ", " + obj.email,
                                value: obj.id
                            }
                        });
                        response( resp );
                    }
                });
            },
            select: function (event, ui) {
                // Set selection
                ui.item.value = storeDb[ui.item.value];
                $('#employee_search').val(ui.item.label); // display the selected text
                $('#employeeid').text(JSON.stringify(ui.item.value, undefined, 2)).css('height','auto')
                return false;
            }
        });

    });
</script>
</body>
</html>
