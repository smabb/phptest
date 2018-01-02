const path = require('path');

module.exports = {
  entry: './js/run_php_code.js',
  output: {
    filename: 'run_php_code.js',
    path: path.resolve(__dirname, 'dist')
  },
  module: {
  	rules: [
  		{ test: /\.js$/, exclude: /node_modules/, loader: "babel-loader" }
  	]
  }
};