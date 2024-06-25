document.addEventListener('DOMContentLoaded', () => {
    const profileIcon = document.getElementById('profileIcon');
    const menu = document.getElementById('menu');
    const logoutButton = document.getElementById('logoutButton');
    const logoutForm = document.getElementById('logoutForm');
    const deleteButtons = document.querySelectorAll('.delete-button');
    const addForm = document.getElementById('addForm');
    const addSubmit = document.getElementById('addSubmit');

    if (profileIcon) {
        profileIcon.addEventListener('click', () => {
            menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
        });
    }

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
        logoutButton.addEventListener('click', function () {
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
    if (addForm) {
        addForm.addEventListener('submit', function(event) {
            event.preventDefault(); // Hentikan submit form secara default

            Swal.fire({
                title: "Success",
                text: "Data berhasil ditambahkan!",
                icon: "success"
            }).then((result) => {
                if (result.isConfirmed) {
                    addForm.submit(); // Lanjutkan submit form jika pengguna mengonfirmasi
                }
            });
        });
    }
});
