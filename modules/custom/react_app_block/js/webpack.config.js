const path = require('path');
const isDevMode = process.env.NODE_ENV !== 'production';

const config = {
  entry: {
    main: ["./src/index.js"]
  },
  devtool: (isDevMode) ? 'source-map' : false,
  mode: (isDevMode) ? 'development' : 'production',
  output: {
    path: isDevMode ? path.resolve(__dirname, "dist_dev") : path.resolve(__dirname, "dist"),
    filename: '[name].min.js'
  },
  resolve: {
    extensions: ['.js', '.jsx'],
  },
  module: {
    rules: [
      {
        test: /\.(js|jsx)$/,
        exclude: /node_modules/,
        use: ['babel-loader']
      }
    ],
  },
};

module.exports = config;

// const config = {
//     entry: './src/index.js',
//     module: {
//         rules: [
//         {
//             test: /\.(js|jsx)$/,
//             exclude: /node_modules/,
//             use: ['babel-loader']
//         }
//         ]
//     },
//     resolve: {
//         extensions: ['*', '.js', '.jsx']
//     },
//     output: {
//         path: __dirname + '/dist',
//         filename: 'index.js'
//     }
// };

// module.exports = config;