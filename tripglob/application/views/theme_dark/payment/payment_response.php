<html>
<head>
    <title>Payment Response</title>
</head>
<body>
    <center>
        <?php if ($order_status === "Success"): ?>
            <p>✅ Thank you for shopping with us. Your transaction is successful.</p>
        <?php elseif ($order_status === "Aborted"): ?>
            <p>⚠️ Thank you for shopping with us. Your transaction was aborted.</p>
        <?php elseif ($order_status === "Failure"): ?>
            <p>❌ Sorry, your transaction has been declined.</p>
        <?php else: ?>
            <p>🚨 Security Error: Illegal access detected.</p>
        <?php endif; ?>

        <br><br>
        <table cellspacing="4" cellpadding="4" border="1">
            <?php foreach ($decrypt_values as $val): ?>
                <?php 
                    $info = explode('=', $val); 
                    $key  = isset($info[0]) ? $info[0] : '';
                    $value= isset($info[1]) ? $info[1] : '';
                ?>
                <tr>
                    <td><?php echo $key; ?></td>
                    <td><?php echo $value; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </center>
</body>
</html>
