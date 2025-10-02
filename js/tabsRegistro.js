  const loginTab = document.getElementById('login-tab');
  const registerTab = document.getElementById('register-tab');
  const btnLogin = document.getElementById('btnLogin');
  const btnRegistro = document.getElementById('btnRegistro');

  loginTab.addEventListener('click', () => {
    btnLogin.classList.remove('d-none');
    btnRegistro.classList.add('d-none');
  });

  registerTab.addEventListener('click', () => {
    btnLogin.classList.add('d-none');
    btnRegistro.classList.remove('d-none');
  });