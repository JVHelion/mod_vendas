<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Vuetify CDN</title>

    <!-- Vuetify CSS via CDN -->
    <link href="/public/css/mod_vendas/vuetify.min.css" rel="stylesheet" />

    <!-- Google Fonts para Vuetify -->
    <link href="/public/css/mod_vendas/css2.css?family=Roboto&display=swap" rel="stylesheet" />
    <link href="/public/css/mod_vendas/materialdesignicons.min.css" rel="stylesheet" />

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>

<body>

    <div id="app"></div>

    <!-- Vue 3 CDN -->
    <script src="/public/js/mod_vendas/vue.global.js"></script>

    <!-- Vuetify 3 CDN -->
    <script src="/public/js/mod_vendas/vuetify.min.js"></script>

    <!-- Vuetify Plugin Setup -->
    <script>
        const { createApp, ref } = Vue;
        const { createVuetify } = Vuetify;
        const vuetify = createVuetify();
    </script>

    <!-- App -->
    <script>
        const App = {
            setup() {
               
                return {
                   
                };
            },
            template:
                `
               
                `
        };

        createApp(App).use(vuetify).mount('#app');
    </script>
</body>

</html>