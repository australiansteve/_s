const path = require('path');

module.exports = {
	mode: 'development',
  entry: './js/app.js',
  devtool: 'source-map',
  output: {
    filename: 'main.js',
    path: path.resolve(__dirname, 'dist'),
  },
  optimization: {
    nodeEnv: 'production'
  }
};