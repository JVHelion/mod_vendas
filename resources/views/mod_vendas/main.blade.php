<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Módulo de Vendas</title>

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
    <script src="/public/js/mod_vendas/vue.global.teste.js"></script>
    <script src="/public/js/mod_vendas/vuetify.min.js"></script>
    <script>
        const { createApp, ref } = Vue;
        const { createVuetify } = Vuetify;
        const vuetify = createVuetify();
    </script>

    <!-- App -->
    <script>
        const App = {
            setup() {
                const links = [
                  'Dashboard',
                  'Entrar',
                  'Registrar-se',
                    'Updates',
                    'Aba custom'
                ];

                const data = () => ({
                    links: [
                        'Dashboard',
                        'Messages',
                        'Profile',
                        'Updates',
                    ],
                });

                return {
                    links,
                    data
                };
            },
            template:
                `
                    <v-app id="inspire">
                        <v-app-bar flat>
                          <v-container class="mx-auto d-flex align-center justify-center">
                            <v-avatar
                              class="me-4 "
                              color="grey-darken-1"
                              size="32"
                            ></v-avatar>

                            <v-btn
                              v-for="link in links"
                              :key="link"
                              :text="link"
                              variant="text"
                            ></v-btn>

                            <v-spacer></v-spacer>

                            <v-responsive max-width="160">
                              <v-text-field
                                density="compact"
                                label="Search"
                                rounded="lg"
                                variant="solo-filled"
                                flat
                                hide-details
                                single-line
                              ></v-text-field>
                            </v-responsive>
                          </v-container>
                        </v-app-bar>

                        <v-main class="bg-grey-lighten-3">
                          <v-container>
                            <v-row>
                              <v-col cols="2">
                                <v-sheet rounded="lg">
                                  <v-list rounded="lg">
                                    <v-list-item
                                      v-for="n in 5"
                                      :key="n"
                                      :title="'List Item ' + n"
                                      link
                                    ></v-list-item>

                                    <v-divider class="my-2"></v-divider>

                                    <v-list-item
                                      color="grey-lighten-4"
                                      title="Refresh"
                                      link
                                    ></v-list-item>
                                  </v-list>
                                </v-sheet>
                              </v-col>

                              <v-col>
                                <v-sheet
                                  min-height="70vh"
                                  rounded="lg"
                                >
                                  <h1 class="text-center">Bem Vindo ao Modulo de Vendas</h1>
                                </v-sheet>
                              </v-col>
                            </v-row>
                          </v-container>
                        </v-main>
                    </v-app>
                `
        };

        createApp(App).use(vuetify).mount('#app');
    </script>
</body>

</html>