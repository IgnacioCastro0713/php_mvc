const path = require('path');

module.exports = {
    mode: 'development',
    entry: './assets/js/src/main.js',
    output: {
        path: path.resolve(__dirname, 'assets/js/build'),
        filename: 'app.js'
    },
    //vue configuration
    resolve: {
        alias: {
            vue: 'vue/dist/vue.js'
        }
    },
    //compilation constant run command: webpack --watch
    watch: true
};
// run this command to compile assets: npx webpack