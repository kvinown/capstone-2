const express = require('express');
const path = require('path');
const { createProxyMiddleware } = require('http-proxy-middleware');
const app = express();
const router = express.Router();

// Serve static files (like CSS, JS, images)
app.use('/views', express.static(path.join(__dirname, 'views/capstone-2-app')));

// Proxy requests to Laravel
router.use('/laravel', createProxyMiddleware({
    target: 'http://localhost:8000', // URL Laravel Anda
    changeOrigin: true,
    pathRewrite: {
        '^/laravel': '', // Hapus /laravel dari URL sebelum meneruskan
    },
}));

module.exports = router;
