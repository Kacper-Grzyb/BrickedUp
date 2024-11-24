<div class="input-container">
    <img src="/img/password.png" alt="password icon">
    <input type="password" name="password" id="passwordInput" placeholder="Password" required style="width: calc(83% - 50px); padding-right: 50px;">
    <button type="button" id="togglePassword" style="position: absolute; right: 15px; top: 60%; transform: translateY(-59%); width: 20px; height: 20px; background: none; border: none; cursor: pointer;">
        <i id="togglePasswordIcon" class="fas fa-eye"></i>
    </button>
</div>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<script>
    const passwordField = document.getElementById('passwordInput');
    const togglePassword = document.getElementById('togglePassword');
    const icon = document.getElementById('togglePasswordIcon');

    console.log(passwordField);
    togglePassword.addEventListener('click', function () {
        const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordField.setAttribute('type', type);
        
        icon.classList.toggle('fa-eye');
        icon.classList.toggle('fa-eye-slash');
    });
</script>