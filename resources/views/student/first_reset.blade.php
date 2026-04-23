<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set New Password - LEDIPO</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            min-height: 100vh;
            background: #f0f4f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card {
            background: #fff;
            border-radius: 20px;
            padding: 48px 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 8px 32px rgba(2, 86, 40, 0.10);
        }
        .card-logo {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 28px;
        }
        .card-logo img {
            width: 64px;
            height: 64px;
            object-fit: contain;
            margin-bottom: 12px;
        }
        .card-logo h2 {
            font-size: 20px;
            font-weight: 700;
            color: #025628;
            margin-bottom: 4px;
        }
        .card-logo p {
            font-size: 13px;
            color: #888;
            text-align: center;
            line-height: 1.5;
        }
        .divider {
            height: 1px;
            background: #f0f0f0;
            margin-bottom: 24px;
        }
        .form-group { margin-bottom: 16px; }
        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: #444;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: .04em;
        }
        .input-wrap { position: relative; }
        .input-wrap i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
            font-size: 14px;
        }
        .input-wrap input {
            width: 100%;
            padding: 11px 14px 11px 38px;
            border: 1.5px solid #e0e0e0;
            border-radius: 10px;
            font-size: 14px;
            font-family: inherit;
            color: #1a1a1a;
            outline: none;
            transition: border-color 0.2s;
        }
        .input-wrap input:focus { border-color: #025628; }
        .error-box {
            background: #FCEBEB;
            color: #A32D2D;
            border-radius: 10px;
            padding: 10px 14px;
            margin-bottom: 16px;
            font-size: 13px;
        }
        .error-box div { margin-bottom: 2px; }
        .btn-submit {
            width: 100%;
            background: #025628;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 13px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            font-family: inherit;
            margin-top: 8px;
            transition: background 0.2s;
        }
        .btn-submit:hover { background: #014d20; }
        .hint {
            display: flex;
            align-items: center;
            gap: 6px;
            background: #f0faf3;
            border: 1px solid rgba(2,86,40,0.12);
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 12px;
            color: #025628;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="card-logo">
        <img src="{{ asset('images/logo.png') }}" alt="LEDIPO Logo">
        <h2>Set Your New Password</h2>
        <p>Welcome! Para sa iyong seguridad, palitan ang temporary password bago mag-continue.</p>
    </div>

    <div class="divider"></div>

    <form action="{{ route('first.reset.save') }}" method="POST">
        @csrf

        @if($errors->any())
            <div class="error-box">
                @foreach($errors->all() as $error)
                    <div><i class="fa-solid fa-triangle-exclamation"></i> {{ $error }}</div>
                @endforeach
            </div>
        @endif

        <div class="hint">
            <i class="fa-solid fa-circle-info"></i>
            Password must be at least 6 characters.
        </div>

        <div class="form-group">
            <label>New Password</label>
            <div class="input-wrap">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password" placeholder="Enter new password" required minlength="6">
            </div>
        </div>

        <div class="form-group">
            <label>Confirm New Password</label>
            <div class="input-wrap">
                <i class="fa-solid fa-lock"></i>
                <input type="password" name="password_confirmation" placeholder="Re-enter new password" required>
            </div>
        </div>

        <button type="submit" class="btn-submit">
            <i class="fa-solid fa-key"></i> Set New Password
        </button>
    </form>
</div>

</body>
</html>