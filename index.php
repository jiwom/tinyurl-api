<!DOCTYPE html>
<html>
<head>
    <title></title>
    <?php
    $createOutput  = '';
    $extractOutput = '';

    if ($_POST) {
        $url    = $_POST['url'];
        $button = $_POST['button'];

        if ($button == 'create') {
            $createOutput = get_tiny_url($url);
        } else {
            $extractOutput = un_tiny_url($url);
        }
    }
    function get_tiny_url($url)
    {
        $ch      = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, 'http://tinyurl.com/api-create.php?url=' . $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

    function un_tiny_url($url)
    {
        return file_get_contents('http://untiny.me/api/1.0/extract/?url=' . $url . '&format=text');
    }

    ?>
</head>
<body>
<form method="POST">
    <h1>Create</h1>
    <input type="text" name="url">
    <h1><?php echo $createOutput; ?></h1>
    <input type="submit" value="create" name="button">
</form>

<form method="POST">
    <h1>Extract</h1>
    <input type="text" name="url">
    <h1><?php echo $extractOutput; ?></h1>
    <input type="submit" value="extract" name="button">
</form>

<h1>sample link:</h1>
<p>http://verylongurl.com</p>
</body>
</html>