<html>
    <head>
        <title>Live Search</title>
        <script src="
https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.min.js
"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    </head>
    <body>
        <h1 class="text-center mt-3">Hehe</h1>

        <div class="container">
            <!-- SEARCH -->
            <div class="form-group mt-4">
                <input type="text" class="form-control" id="inputRFID" placeholder="RFID">                
            </div>

            <!-- HASIL -->
            <div class="mt-2" id="resultNama"></div>
            <div class="mt-2" id="resultPassword"></div>
        </div>    

        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script>
            const rfid = $('#inputRFID')
            const resultNama = $('#resultNama')
            const resultPassword = $('#resultPassword')

            // LIVESEARCH OK
            $(document).ready(() => {
                readData();
                rfid.keyup(() => {
                    if (!rfid.val()) return readData()

                    resultNama.html('<p class="text-muted">Mencari data...</p>')

                    $.ajax({
                        type: 'get',
                        url: "{{ url('action') }}",
                        data: {
                            'id': rfid.val()
                        },
                        success: (data) => {
                            const res = JSON.parse(data)
                            resultNama.html(res.name)
                            resultPassword.html(res.password)
                        }
                    })
                })
            })

            function readData() {
                $.get("{{ url('hasil') }}", {}, 
                
                function(data, status){
                    $('#resultNama, #resultPassword').html('')
                });
            }
        </script>
    </body>
</html>