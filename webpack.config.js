const path = require('path');
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const OptimizeCSSAssetsPlugin = require("optimize-css-assets-webpack-plugin");
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const StyleLintPlugin = require('stylelint-webpack-plugin');
const AssetsPlugin = require('assets-webpack-plugin');
const TerserPlugin = require('terser-webpack-plugin');
const webpack = require('webpack');

module.exports = (env, argv) => ({
	entry: {
		main: './assets/js/main.js',
		admin: './assets/js/admin.js',
		publish_form: './assets/js/publish_form.js',
	},
	output: {
		path: __dirname + '/public',
		filename: 'js/[name].[contenthash:6].js',
		publicPath: '',
	},
	module: {
		rules: [
		{
			test: /\.scss$/,
			use: [
			argv.mode !== 'production' ? 'style-loader' : MiniCssExtractPlugin.loader,
			"css-loader",
			"postcss-loader",
			"sass-loader"
			]
		},
		{
			test: /\.css$/,
			use: [
			{
				loader: MiniCssExtractPlugin.loader,
				options: {
					publicPath: '../'
				}
			},
			{loader: "css-loader"},
			{loader: "postcss-loader"}
			]
		},
		]
	},
	optimization: {
		minimizer: argv.mode === 'production' ? [ new OptimizeCSSAssetsPlugin(), new TerserPlugin() ] : []
	},
	plugins: [
	new MiniCssExtractPlugin({
		filename: "css/[name].[contenthash:6].min.css",
		chunkFilename: "[name].[contenthash:6].css"
	}),
	new AssetsPlugin({
		path: path.join(__dirname, 'public'),
		filename: 'assets.json',
		prettyPrint: true,
		includeAllFileTypes: false,
		fileTypes: ['js', 'css']
	}),
	new BrowserSyncPlugin({
		port: 3000,
		proxy: 'https://levl.local',
	}),
	new StyleLintPlugin({
		failOnError: argv.mode === 'production' ? true : false,
	}),
	new webpack.IgnorePlugin({
		resourceRegExp: /^\.\/locale$/,
		contextRegExp: /moment$/,
	  })
	],
	externals: {
		jquery: 'jQuery'
	}
});
