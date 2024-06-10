// Controller untuk menggunakan class Fakultas
const Fakultas = require('../model/Fakultas');

const index = (req, res) => {
    // Buat instance Fakultas langsung tanpa menggunakan getInstance()
    new Fakultas().all((err, fakultas) => {
        if (err) {
            return res.status(500).json({
                success: false,
                message: 'Internal server error',
            });
        }
        res.status(200).json({
            success: true,
            data: fakultas,
        });
    });
}


module.exports = {
    index,
};
