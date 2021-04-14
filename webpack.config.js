const path = require('path');
const TerserPlugin = require("terser-webpack-plugin");

module.exports = {
	mode: 'development',
  entry: './js/app.js',
  devtool: 'source-map',
  output: {
    filename: 'main.js',
    path: path.resolve(__dirname, 'dist'),
  },
  optimization: {
    nodeEnv: 'production',
    minimize: true,
    minimizer: [new TerserPlugin()],
  }
};