const path = require('path');
const isDevMode = process.env.NODE_ENV !== 'production';

// Addtions for Hot Module Replace for Webpack
const PROXY = 'https://my-d8-site.ddev.site/';
const PUBLIC_PATH = '/themes/react_thm/js/dist_dev/';

const config = {
  entry: {
    main: [    
      "react-hot-loader/patch",
      "./js/src/index.jsx"
    ]
  },
  devtool: (isDevMode) ? 'source-map' : false,
  mode: (isDevMode) ? 'development' : 'production',
  output: {
    path: isDevMode ? path.resolve(__dirname, "js/dist_dev") : path.resolve(__dirname, "js/dist"),
    filename: '[name].min.js',
    publicPath: PUBLIC_PATH
  },
  resolve: {
    extensions: ['.js', '.jsx'],
    alias: {
      'react-dom': '@hot-loader/react-dom',
    },
  },
  module: {
    rules: [
      {
        test: /\.jsx?$/,
        loader: 'babel-loader',
        exclude: /node_modules/,
        include: path.join(__dirname, 'js/src'),
        options: {
          // This is a feature of `babel-loader` for webpack (not Babel itself).
          // It enables caching results in ./node_modules/.cache/babel-loader/
          // directory for faster rebuilds.
          cacheDirectory: true,
          plugins: ['react-hot-loader/babel'],
        },
      }
    ],
  },
  devServer: {
    port: 8181,
    hot: true,
    https: true,
    writeToDisk: true,
    headers: { 'Access-Control-Allow-Origin': '*' },
    // Settings for http-proxy-middleware.
    proxy: {
      '/': {
        index: '',
        context: () => true,
        target: PROXY,
        publicPath: PUBLIC_PATH,
        secure: false,
        // These settings allow Drupal authentication to work, so you can sign
        // in to your Drupal site via the proxy. They require some corresponding
        // configuration in Drupal's settings.php.
        changeOrigin: true,
        xfwd: true
      }
    }
  },
};

module.exports = config;