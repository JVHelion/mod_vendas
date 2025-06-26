const mix = require('laravel-mix');

// Compila os arquivos do Angular
mix.js('resources/angular/mod_vendas/src/main.ts', 'public/js')
   .sass('resources/angular/mod_vendas/src/styles.css', 'public/css') // Se você estiver usando Sass
   .setPublicPath('public'); // Define o caminho público

// Adicione outras configurações conforme necessário
