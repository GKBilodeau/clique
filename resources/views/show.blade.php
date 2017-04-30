<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
        <h1>Weather Today In {{$name}}</h1>
        <br>
        <h4>{{$date[0]}}</h4>
        <br>
        <h2>Current Temperature</h2>
        <h1>{{$temps[0]}} &deg; F</h1>
        <h2>High/Low</h2>
        <h2>{{$temps[1]}}/{{$temps[2]}}</h2>
        <br>
        <h2>Futurecast</h2>
        <h3>{{$date[1]}} &emsp; {{$maxarr[0]}}/{{$minarr[0]}} &deg; F</h3>
        <h3>{{$date[2]}} &emsp; {{$maxarr[1]}}/{{$minarr[1]}} &deg; F</h3>
        <h3>{{$date[3]}} &emsp; {{$maxarr[2]}}/{{$minarr[2]}} &deg; F</h3>
        <h3>{{$date[4]}} &emsp; {{$maxarr[3]}}/{{$minarr[3]}} &deg; F</h3>



</body>
</html>