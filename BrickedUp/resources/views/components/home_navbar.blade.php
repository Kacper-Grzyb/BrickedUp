<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
  href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap"
  rel="stylesheet">

<style>
  body {
    background-color: gray;
  }

  nav {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-grow: 1;
  }

  nav ul {
    list-style-type: none;
    justify-content: center;
    display: flex;
    flex-grow: 1;
    font-family: Inter;
  }

  nav li a {
    color: white;
    padding: 5px 10px;
    text-decoration: none;
    border: 1px solid;
    margin: 1rem 1rem;
    border-radius: 4px;
    font-family: Inter;
  }

  nav li a:hover {
    text-decoration: underline;
  }

  .title {
    font-size: 23px;
    font-weight: bold;
    margin-left: 10px;
    font-family: Montserrat;
    color: white;
    text-decoration: none;
  }

  .signup-btn {
    color: white;
    padding: 5px 10px;
    text-decoration: none;
    border: 1px solid white;
    /* Make sure it's white */
    margin: 1rem 0.5rem;
    border-radius: 4px;
    font-family: Inter;
  }

  .signup-btn:hover {
    text-decoration: underline;
  }

  /* Prevent the dashboard link from changing color when clicked */
  .signup-btn:focus,
  .signup-btn:active {
    outline: none;
    box-shadow: none;
    background-color: transparent;
    /* Prevent background color change */
    color: white;
    /* Ensure text remains white */
  }

  .btn-signup {
    color: white;
    padding: 5px 10px;
    text-decoration: none;
    border: 1px solid white;
    margin: 1rem 0.5rem;
    border-radius: 4px;
    font-family: Inter;
  }

  .btn-signup:hover {
    text-decoration: underline;
  }

  .btn-signup:focus,
  .btn-signup:active {
    outline: none;
    box-shadow: none;
    background-color: transparent;
    color: white;
  }
</style>

<div>
  <nav>
    <a class="title" href="/">BrickedUp</a>
    <ul>
      <li><a href="/">Home</a></li>
      <li><a href="/features">Features</a></li>
      <li><a href="mailto:info@pornhub.com">Contact</a></li>
    </ul>
    @if (Route::has('login'))
    <div class="auth-links">
      @auth
      <a class="signup-btn" href="{{ url('/dashboard') }}">Dashboard</a>
    @else
      <a class="signup-btn" href="{{ route('login') }}">Log In</a>
      @if (Route::has('register'))
      <a class="signup-btn" href="{{ route('register') }}">Sign Up</a>
    @endif
    @endauth
    </div>
  @endif
  </nav>
</div>