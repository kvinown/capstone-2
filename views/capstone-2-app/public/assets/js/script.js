document.addEventListener('DOMContentLoaded', () => {
    const profileIcon = document.getElementById('profileIcon');
    const menu = document.getElementById('menu');
    const logoutButton = document.getElementById('logoutButton');
    const logoutForm = document.getElementById('logoutForm');

    profileIcon.addEventListener('click', () => {
        menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
    });



});

document.addEventListener('DOMContentLoaded', () => {
    const profileIcon = document.getElementById('profileIcon');
    const menu = document.getElementById('menu');
    const logoutButton = document.getElementById('logoutButton');
    const logoutForm = document.getElementById('logoutForm');

    if (profileIcon) {
        profileIcon.addEventListener('click', () => {
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        });
    }

    const deleteButtons = document.querySelectorAll('.delete-button');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const form = this.closest('form');

            Swal.fire({
                title: 'Apakah Anda yakin ingin menghapus?',
                text: "Anda tidak akan bisa mengembalikannya!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

    if (logoutButton) {
        logoutButton.addEventListener('click', function() {
            Swal.fire({
                title: 'Apakah Anda yakin ingin logout?',
                text: "Anda harus login kembali untuk mengakses layanan.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Logout',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    logoutForm.submit();
                }
            });
        });
    }
});
