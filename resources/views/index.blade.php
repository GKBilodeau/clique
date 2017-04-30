<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
        <h1>Check The Weather Forecast</h1>
        <br>
        <?php
        for ($i=0; $i < count($csv); $i+=2) { 
            
        echo '<br>';
        echo "<a href = '/show/{$csv[$i]}/{$csv[$i+1]}'><h2>$csv[$i]</h2></a>";
        }
        ?>



</body>
</html>