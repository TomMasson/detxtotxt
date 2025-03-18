<!DOCTYPE html>
<html>
<head>
	<title>DE2TXT</title>
</head>
<body>
    <p>Welcome to this DETX to TXT converter !<br>
    Please load your file below : </p>

    <form method="POST" enctype="multipart/form-data" action="convert.php">
        <label>Load DETX or Txt file</label>
        <br>
        <input type="file" id="file" name="file">
        <br>
        <button type="submit" name="txt">Convert to Txt</button>
        <button type="submit" name="detx">Convert to Detx</button>
        <button type="submit" name="example">Convert Detx Example Sample to Txt</button>
    </form>
</body>
</html>
