const path = require('path');

module.exports = {
    mode: 'development',
    entry: path.resolve(__dirname.concat('/assets/js/src/prepare.js')),
    output: {
        path: path.resolve(__dirname, 'assets/js/build'),
        filename: 'app.js'
    }
};
// run this command to compile assets: npx webpack