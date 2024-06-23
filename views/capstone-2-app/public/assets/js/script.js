document.addEventListener('DOMContentLoaded', () => {
    const profileIcon = document.getElementById('profileIcon');
    const menu = document.getElementById('menu');
    const logoutButton = document.getElementById('logoutButton');
    const logoutForm = document.getElementById('logoutForm');

    profileIcon.addEventListener('click', () => {
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    });

    window.addEventListener('click', (e) => {
        if (e.target !== profileIcon && !profileIcon.contains(e.target) && e.target !== menu && !menu.contains(e.target)) {
            menu.style.display = 'none';
        }
    });

    logoutButton.addEventListener('click', () => {
        if (confirm('Yakin untuk logout dari akun ini?')) {
            logoutForm.submit();
        }
    });
});
