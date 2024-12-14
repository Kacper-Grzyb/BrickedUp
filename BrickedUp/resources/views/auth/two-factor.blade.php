<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
    <title>Bricked Up</title>
</head>

<style>
    body {
        margin: 0;
        padding: 0;
        height: 100vh;
        font-family: 'Inter', sans-serif;
        background-image: url('{{ asset('img/gold-bricks-falling-d.png') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    body::before {
        content: "";
        background-color: rgba(0, 0, 0, 0.8);
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: -1;
    }

    .card-holder {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100%;
        padding: 20px;
    }

    .card {
        background: rgba(0, 0, 0, 0.8);
        border-radius: 15px;
        padding: 30px 20px;
        width: 100%;
        max-width: 400px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.37);
        display: flex;
        flex-direction: column;
        align-items: center;
        animation: fadeIn 1s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .card label {
        color: #fff;
        margin-bottom: 10px;
        font-size: 1.2rem;
    }

    .card input {
        width: 100%;
        padding: 10px 15px;
        margin-bottom: 20px;
        border: 2px solid rgba(255, 255, 255, 0.6);
        border-radius: 5px;
        background: transparent;
        color: white;
        font-size: 1rem;
        outline: none;
        transition: border-color 0.3s;
    }

    .card input:focus {
        border-color: orange;
    }

    .card button {
        width: 100%;
        padding: 10px 15px;
        font-size: 1rem;
        color: white;
        background: orange;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .card button:hover {
        background-color: #d18b26;
    }

    .card .error-messages {
        background: rgba(255, 0, 0, 0.2);
        color: #ff6b6b;
        padding: 10px;
        border-radius: 5px;
        width: 100%;
        margin-top: 20px;
    }

    .card .error-messages p {
        margin: 0;
        font-size: 0.9rem;
    }

    @media (max-width: 480px) {
        .card {
            padding: 20px;
        }

        .card label,
        .card input,
        .card button {
            font-size: 0.9rem;
        }
    }
</style>

<body>
    <div class="card-holder">
        <div class="card">
            <form action="{{ route('two-factor.verify') }}" method="POST">
                @csrf
                <label for="code">Two-Factor Code</label>
                <input type="text" name="code" id="code" placeholder="Enter code" required>
                <button type="submit">Verify</button>
            </form>

            @if($errors->any())
                <div class="error-messages">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</body>

</html>