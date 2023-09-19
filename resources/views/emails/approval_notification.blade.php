<!DOCTYPE html>
<html>
<head>
    <title>Approval Notification</title>
</head>
<body>
    <h2>Your verification request has been {{ $status === 'approve' ? 'Approved' : 'Rejected' }}</h2>
    <p>Thank you for your submission. Your request has been {{ $status === 'approve' ? 'approved' : 'rejected' }}.</p>
</body>
</html>