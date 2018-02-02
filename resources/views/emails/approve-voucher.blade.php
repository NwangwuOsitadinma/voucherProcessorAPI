<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Voucher Response</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="css/app.css" />
</head>

<body>
    <div>
        <p>Good day {{ $voucherCreatorName }}, </p>
        <p>Your voucher with number {{ $voucherNumber }} was just {{ $response }} by {{ $responderName }}.</p>
        <p>Go to your dashboard to view this transaction</p>
        <br>
        <span>Thank you and best regards.</span>
        <p>Tenece Voucher Processing System</p>
    </div>
</body>

</html>