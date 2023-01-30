module.exports = {
  content: [
    'templates/**/*.html.twig',
    'src/Resources/views',
    'assets/js/**/*.js'
  ],
  safelist: [
    {
      pattern: /h-([456])/, // Use to generate icon class in Heroicon twig templates
    },
  ],
  theme: {
    extend: {},
  },
  plugins: [require('daisyui')],
}
