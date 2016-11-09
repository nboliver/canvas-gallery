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
            presets: ["es2015"]
          }
        }
      ]
    }
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