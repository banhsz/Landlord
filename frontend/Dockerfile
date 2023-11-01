FROM yiisoftware/yii2-php:8.1-apache

# Change document root for Apache
RUN sed -i -e 's|/app/web|/app/frontend/web|g' /etc/apache2/sites-available/000-default.conf
RUN ln -s /etc/apache2/sites-available/docker-apache-config-frontend.conf /etc/apache2/sites-enabled/docker-apache-config-frontend.conf
