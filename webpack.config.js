const path = require('path');
const VueLoaderPlugin = require('vue-loader/lib/plugin');

module.exports = {
    mode: 'production',
    entry: './assets/js/src/main.js',
    output: {
        path: path.resolve(__dirname, 'assets/js/build'),
        filename: 'app.js'
    },
    //vue configuration
    resolve: {
        alias: {
            vue: 'vue/dist/vue.js',
            'vue$': 'vue/dist/vue.common.js'
        },
        extensions: ['.ts', '.js', '.vue', '.json']
    },
    module: {
        rules: [
            // ... other rules
            {
                test: /\.vue$/,
                loader: 'vue-loader',
            }
        ]
    },
    plugins: [
        // make sure to include the plugin!
        new VueLoaderPlugin()
    ],

    //compilation constant run command: webpack --watch
    watch: true
};
// run this command to compile assets: npx webpack