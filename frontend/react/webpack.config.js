const path = require('path');

module.exports = {
    mode: 'development',
    entry: './src/index.js', // Entry point of your React application
    output: {
        path: path.resolve(__dirname, '../web/js/react'), // Output directory for bundled JS
        filename: 'react_bundle.js', // Output filename
    },
    module: {
        rules: [
            {
                test: /\.(js|jsx)$/,
                exclude: /node_modules/,
                use: {
                    loader: 'babel-loader',
                    options: {
                        presets: ['@babel/preset-env', '@babel/preset-react'],
                    },
                },
            },
        ],
    },
};