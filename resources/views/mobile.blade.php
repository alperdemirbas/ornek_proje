<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>

<script>
    $(document).ready((e)=>{
        const data = {
            "platform":"ios",
            "version":1
        };
        var jqxhr = $.post( "http://localhost/api/version/check",data, function() {
            console.log( "success" );
        })
            .done(function() {
                console.log( "second success" );
            })
            .fail(function() {
                console.log( "error" );
            })
            .always(function() {
                console.log( "finished" );
            });
        jqxhr.always(function() {
            console.log( "second finished" );
        });


    })
</script>
</body>
</html>