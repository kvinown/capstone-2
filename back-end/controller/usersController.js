const Users = require('../model/users')
const {createProxyMiddleware} = require("http-proxy-middleware");

const index = (req, res) => {
    new Users().all((err, result) => {
        if (err) {
            return res.status(500).json({
                success: false,
                message: 'Internal server error'
            })
        }
        res.status(200).json({
            success: true,
            data: result
        })
    })
}


const create = (req, res) => {
    res.status(200).json({success: true, message: 'Create Page'})
}

const store = (req, res) => {
    console.log('Recieved data from storing', req.body)
    const user = {
        name: req.body.name,
        email: req.body.email,
        password: req.body.password,
        role_id: req.body.role,
        programStudi_id: req.body.programStudi_id
    }
    console.log('Data for storing', user)

    new User().save(user, (err,result) => {
        if (err) {
            console.error('Error while saving user', err)
            return res.status(500).json({
                success:false,
                message: 'Internal Server Error',
                error: err.message
            })
        }
        res.status(201).json({
            success:true,
            message: 'Data berhasil ditambah',
            data: result
        })
    })
}

const edit = (req, res) => {
    const id = req.params.id
    new User().edit(id, (err, user) => {
        if (err) {
            return res.status(500).json({
                success: false,
                message: 'Internal server error'
            })
        }
        if (!user) {
            return res.status(404).json({
                success: false,
                message: `No User found with id ${id}`
            })
        }
    })
}

const update = (req, res) => {
    console.log('Recieved data from updating', req.body)
    const user = {
        name: req.body.name,
        email: req.body.email,
        password: req.body.password,
        role_id: req.body.role,
        programStudi_id: req.body.programStudi_id
    }
    console.log('Data for updating', user)

    new User().update(user, (err, result) => {
        if (err) {
            console.error('Error while updating user', err)
            return res.status(500).json({
                success: false,
                message: 'Internal server error',
                error: err.message
            })
        }
        res.status(201).json({success: true, message:'Data berhasil diubah', data: result})
    })
}

const destroy = (req, res) => {
    const id = req.params.id
    console.log('ID for delete', id)
    new User().delete(id, (err, result) => {
        if (err) {
            console.error('Error while deleting user', err)
            return res.status(500).json({success: false, message: 'Internal Server Error', error: err.message})
        }
        res.status(200).json({ success: true, message: 'Data berhasil dihapus', data: result });
    })
}

module.exports = {
    index,
    create,
    store,
    edit,
    update,
    destroy
}