<!----
  PHP code take from http://css-tricks.com/snippets/php/check-if-website-is-available/
  Modified and edited by Grady @adroidman
---->
<!Doctype html>
<html>
<body>
<?php
    $filename = "servers.txt";
    $lines = file($filename, FILE_IGNORE_NEW_LINES);
    //returns true, if domain is availible, false if not
    function isDomainAvailible($domain) {
        
        //initialize curl
        $curlInit = curl_init($domain);
        curl_setopt($curlInit,CURLOPT_CONNECTTIMEOUT,10);
        curl_setopt($curlInit,CURLOPT_HEADER,true);
        curl_setopt($curlInit,CURLOPT_NOBODY,true);
        curl_setopt($curlInit,CURLOPT_RETURNTRANSFER,true);

        //get answer
        $response = curl_exec($curlInit);
        curl_close($curlInit);

        if ($response) {
            echo "Up and running!";
        } else {
            echo "Currently experiencing issues";
        }
    }
?>

<table>
  <tr>
    <td>Server Name</td>
    <td>Status</td>
  </tr>
  <tr>
    <?php
        foreach($lines as $url) {
            echo "<td>$url</td>" . "<td>" , isDomainAvailible($url) , "</td>";
            echo "</tr>";
        }
    ?>
</table>
</body>
</html>