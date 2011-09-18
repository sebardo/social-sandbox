Copiar la carpeta EventPlugin en la carpeta plugins del proyecto
ejecutar el comando doctrine: build --all --no-confirmation
habilitar el modulo event o adminEvent en el archivo settings.yml de la aplicacion correspondiente
Ejecutar el comando plugin:publish-assets
conseguir una key para la api de google maps y reemplazar el link correspondiente en EventPlugin/config/app.yml