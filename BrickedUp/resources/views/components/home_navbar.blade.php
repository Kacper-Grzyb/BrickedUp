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
    border: 1px solid;
    margin: 1rem 1rem;
    border-radius: 4px;
    font-family: Inter;
  }

  .signup-btn:hover {
    text-decoration: underline;
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
    <a class="signup-btn" href="/signup">SignUp</a>
  </nav>
</div>