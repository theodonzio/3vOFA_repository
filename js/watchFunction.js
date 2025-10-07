document.addEventListener('DOMContentLoaded', () => {
  const watch = document.getElementById('watch');
  if (!watch) return;

  function updateTime() {
    const now = new Date();

    const date = now.toLocaleDateString('es-ES', {
      weekday: 'long',
      year: 'numeric',
      month: 'long',
      day: 'numeric'
    });

    const time = now.toLocaleTimeString([], {
      hour: '2-digit',
      minute: '2-digit',
      second: '2-digit',
      hour12: false
    });

    watch.innerHTML = `
      <div class="fecha text-secondary fw-medium" style="text-transform: capitalize; font-size: 1rem;">
        ${date}
      </div>
      <div class="hora text-primary fw-semibold fs-4">
        ${time}
      </div>
    `;
  }

  updateTime();
  setInterval(updateTime, 1000);
});
