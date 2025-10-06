document.addEventListener('DOMContentLoaded', () => {
  const themeButton = document.getElementById('boton-tema');
  const themeIcon = document.querySelector('.theme_icon_mode');

  if (themeButton && themeIcon) {
    // Cuando se abre el dropdown
    themeButton.addEventListener('show.bs.dropdown', () => {
      themeIcon.classList.add('active');
    });

    // Cuando se cierra el dropdown
    themeButton.addEventListener('hide.bs.dropdown', () => {
      themeIcon.classList.remove('active');
    });
  }
});
