<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting to PayFast</title>
</head>

<body>
    <h3>Please wait, redirecting you to PayFast...</h3>

    <!-- Dynamically injected HTML form -->
    {!! $htmlForm !!}
</body>

</html>

<script>
    // Automatically submit the PayFast form when the page is loaded
    window.onload = function() {
        document.forms['payfastform'].submit();
    }
</script>
