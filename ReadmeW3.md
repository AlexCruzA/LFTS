# Workshop 3 - Laravel en Bookworm con VHOSTs
### Habilitar varios sitios en el mismo server

## En el archivo hosts agregamos las entradas correspondientes
![Alt text](images/image-1.png)
```bash
# Sitio de prueba en webserver
192.168.178.10		alex.isw811.xyz
# Nuevos sitios a hospedar en el Apache2
192.168.178.10		lfts.isw811.xyz
192.168.178.10		lospatitos.com
192.168.178.10		elblogdealex.com
```
![Alt text](images/image.png)

## Hacer ping a las ip's
### Los patitos
![Alt text](images/image-37.png)

### Laravel From the Scratch
![Alt text](images/image-38.png)

### El blog de Alex
![Alt text](images/image-39.png)

## Crear confs de las rutas
![Alt text](images/image-2.png)

![Alt text](images/image-3.png)

![Alt text](images/image-6.png)

## Remplazar las entradas 'alex' por las que correspondan al dominio que queremos hospedar
![Alt text](images/image-5.png)

![Alt text](images/image-8.png)

## Comprobar que los archivos se hayan modificado correctamente con el comando 'cat'
```bash
cat lfts.isw811.xyz.conf
cat lospatitos.com.conf
cat elblogdealex.com.conf
```
![Alt text](images/image-9.png)

![Alt text](images/image-10.png)

![Alt text](images/image-11.png)

## Crear una carpeta por cada sitio
```bash
mkdir elblogdealex.com
mkdir lospatitos.com
mkdir lfts.isw811.xyz
```
![cd](images/image-12.png)

## Ingresar a las carpetas y crear los index
### Los patitos
```bash
touch index.com
code index.com
```
![Alt text](images/image-14.png)

![Alt text](images/image-15.png)

Crear carpeta public y assets
```bash
mkdir -p public/assets
```
![Alt text](images/image-19.png)

### El blog de Alex
```bash
touch index.com
code index.com
```
![Alt text](images/image-16.png)

Crear carpeta public y assets
```bash
mkdir -p public/assets
```
![Alt text](images/image-20.png)

### Laravel from the scratch
```bash
touch index.com
code index.com
```
![Alt text](images/image-17.png)

Crear carpeta public y assets
```bash
mkdir -p public/assets
```
![Alt text](images/image-18.png)

## Agregar imagenes a los sitios

### Los patitos
```bash
curl -O https://isw811.s3.amazonaws.com/images/patitos.png public/assets/
curl -o public/assets/patitos.png https://isw811.s3.amazonaws.com/images/patitos.png
```
![Alt text](images/image-22.png)

### El blog de Alex
```bash
curl -O https://isw811.s3.amazonaws.com/images/patitos.png public/assets/
curl -o public/assets/patitos.png https://isw811.s3.amazonaws.com/images/patitos.png
```
![Alt text](images/image-24.png)

### LFTS
```bash
curl -O https://isw811.s3.amazonaws.com/images/patitos.png public/assets/
curl -o public/assets/patitos.png https://isw811.s3.amazonaws.com/images/patitos.png
```
![Alt text](images/image-25.png)

![Alt text](images/image-21.png)

![Alt text](images/image-23.png)

## Copiar los archivos de configuracion de los VHOSTS 
Copiar desde la VM los archivos de configuracion de vhosts a la ruta de sitios disponibles de Apache2.
```bash
cd /vagrant
cd confs
sudo cp lospatitos.com.conf /etc/apache2/sites-available/
sudo cp elblogdealex.com.conf /etc/apache2/sites-available/
sudo cp lfts.isw811.xyz.conf /etc/apache2/sites-available/
```
O podemos utilizar el comando abreviado
```bash
sudo cp /vagrant/confs/* /etc/apache2/sites-available/
```
![Alt text](images/image-27.png)

![Alt text](images/image-28.png)

## Habilitar los sitios
```bash
sudo a2ensite lospatitos.com.conf
sudo a2ensite elblogdealex.com.conf
sudo a2ensite lfts.isw811.xyz.conf
```
![Alt text](images/image-29.png)

Para recargar apache y obligarlo a aplicar la nueva config
```bash
sudo systemctl reload apache2
```
Podemos verificar nuestros sitios con el comando
```bash
sudo apache2ctl -S
```
![Alt text](images/image-30.png)

# Creacion del proyecto laravel

```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
rm composer-setup.php

sudo mkdir -p /opt/composer/
sudo mv composer.phar /opt/composer/
sudo ln -s /opt/composer/composer.phar /usr/bin/composer

cd /vagrant/sites
rm -r lfts.isw811.xyz
composer create-project laravel/laravel:8.6.12 lfts.isw811.xyz
```
## Se crea el composer setup
```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
```
![Alt text](images/image-32.png)

```bash
rm composer-setup.php
```
![Alt text](images/image-33.png)

```bash
cd /vagrant/sites
rm -r lfts.isw811.xyz
composer create-project laravel/laravel:8.6.12 lfts.isw811.xyz
```
![Alt text](images/image-34.png)

## Se modifica el archivo lfts.isw.811.xyz.conf para agregar a las rutas el "/public"
![Alt text](images/image-36.png)