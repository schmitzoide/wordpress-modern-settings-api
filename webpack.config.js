const defaultConfig = require("@wordpress/scripts/config/webpack.config");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
var path = require("path");

module.exports = {
    ...defaultConfig,
    entry: {
        ...defaultConfig.entry,
        settings: "./src/settings.js",
        style: "./src/index.scss",
    },
    module: {
        ...defaultConfig.module,
    },
    plugins: [
        ...defaultConfig.plugins.filter(
            (plugin) =>
                plugin.constructor.name !== "DependencyExtractionWebpackPlugin"
        ),
        new MiniCssExtractPlugin({
            filename: "[name].css",
        }),
    ],
    resolve: {
        extensions: [".js", ".jsx", ".ts", ".tsx"],
    },
};
