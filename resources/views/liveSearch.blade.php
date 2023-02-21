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
            <div class="mt-2" id="result"></div>
        </div>    

        <!-- <div class="container">
        @foreach($User as $hehe)
            <h1 id="name"> {{$hehe->name}} </h1>
        @endforeach
        </div> -->


        <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
        <script>
            const rfid = $('#inputRFID')
            const result = $('#result')

            $(document).ready(() => {
                readData();
                rfid.keyup(() => {
                    if (!rfid.val()) return readData()

                    $.ajax({
                        type: 'get',
                        url: "{{ url('action') }}",
                        data: {
                            'name': rfid.val()
                        },
                        success: (data) => {
                            result.html(data)
                        }
                    })
                })
            })

             // $(document).ready(function(){
            //     readData();
            //     $("#input").keyup(function(){
            //         var strcari = $("#input").val();
            //         if (strcari != "") {
            //             $("#hasil").html('<p class="text-muted">Mencari data...</p>');

            //             $.ajax({
            //                 type: "get",
            //                 url: "{{ url('action') }}",
            //                 data: "name=" + strcari,
            //                 success: function(data){
            //                     $("#hasil").html(data);
            //                 }
            //             });
            //         } else {
            //             readData();
            //         }
            //     });

            // });

            function readData() {
                $.get("{{ url('hasil') }}", {}, 
                
                function(data, status){
                    result.html(data);
                });
            }
        </script>
    </body>
</html>