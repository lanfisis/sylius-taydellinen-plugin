const Encore = require('@symfony/webpack-encore');

Encore
  .setOutputPath('public')
  .setPublicPath('/public')

  .addEntry('taydellinen', './assets/entry.js')

  .disableSingleRuntimeChunk()
  .cleanupOutputBeforeBuild()

  .enablePostCssLoader((options) => {
    options.postcssOptions = {
      config: './postcss.config.js'
    }
  })

  .enableSourceMaps(!Encore.isProduction())
  .enableVersioning(Encore.isProduction())

  .configureFilenames({
    js: '[name].js',
    css: '[name].css'
  })
;

module.exports = Encore.getWebpackConfig();
