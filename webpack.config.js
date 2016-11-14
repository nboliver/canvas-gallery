var ExtractTextPlugin = require('extract-text-webpack-plugin');
var autoprefixer = require('autoprefixer');
var BrowserSyncPlugin = require('browser-sync-webpack-plugin');

module.exports = [
  {
    name: "admin",
    devtool: "source-map",
    entry: "./admin/js/src/canvas-admin.js",
    output: {
      path: "./admin/js",
      filename: "canvas-admin.js"
    },
    module: {
      loaders: [
        {
          test: /\.js$/,
          exclude: /node_modules/,
          loader: "babel",
          query: {
            presets: ["es2015", "react"]
          }
        },
        {
          test: /\.scss$/,
          loader: ExtractTextPlugin.extract('style?sourceMap', 'css!postcss-loader!sass?sourceMap'),
        }
      ]
    },
    postcss: [ 
      autoprefixer({ browsers: ['last 3 versions'] }) 
    ],
    plugins: [
      new ExtractTextPlugin("../css/canvas-admin.css"),
      new BrowserSyncPlugin({
        files: ['*.php'],
        host: 'localhost',
        port: 7788,
        proxy: 'http://localhost:8888' // proxy apache server
      })
    ]
  },
  {
    name: "public",
    devtool: "source-map",
    entry: "./public/js/src/canvas-public.js",
    output: {
      path: "./public/js",
      filename: "canvas-public.js"
    },
    module: {
      loaders: [
        {
          test: /\.js$/,
          exclude: /node_modules/,
          loader: "babel",
          query: {
            presets: ["es2015"]
          }
        }
      ]
    }
  }
];