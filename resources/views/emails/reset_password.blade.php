<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body style="font-family: Poppins, sans-serif; background:#f4f4f4; padding: 30px;">
    <div style="max-width:600px; margin:0 auto; background:#ffffff; border-radius:8px; padding:40px;">
        
        <h2 style="color:#025628;">Laravel Password Reset</h2>
        
        <p>Hello,</p>
        <p>You requested to reset your password. Click the button below to reset it:</p>

        <div style="text-align:center; margin: 30px 0;">
            <a href="{{ $resetLink }}" 
               style="background:#025628; color:#ffffff; padding:12px 30px; 
                      border-radius:5px; text-decoration:none; font-weight:600;">
                Reset Password
            </a>
        </div>

        <p>This link will expire in <strong>30 minutes</strong>.</p>
        <p>If you did not request a password reset, ignore this email.</p>

        <hr style="margin-top:30px;">
        <p style="font-size:12px; color:#888;">Training Management System</p>
    </div>
</body>
</html>