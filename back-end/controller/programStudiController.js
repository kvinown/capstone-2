// Controller untuk menggunakan class Fakultas
const ProgramStudi = require('../model/programStudi');

const index = (req, res) => {
    // Buat instance Fakultas langsung tanpa menggunakan getInstance()
    new ProgramStudi().all((err, fakultas) => {
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
