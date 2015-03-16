FROM codenvy/shellinabox

ENV DEBIAN_FRONTEND noninteractive
ENV APACHE_RUN_USER www-data
ENV APACHE_RUN_GROUP www-data
ENV APACHE_LOG_DIR /var/log/apache2
ENV SITE_DIR /var/www/html

RUN sudo apt-get update && \
    sudo apt-get -y install apache2 php5 php-pear && \
    sudo rm -R $SITE_DIR/* && \
    echo "ServerName localhost" | sudo tee -a /etc/apache2/apache2.conf

# expose and listen to 80 port
EXPOSE 80
ENV CODENVY_APP_PORT_80_HTTP 80

# start container

CMD sudo chown -R www-data:www-data $SITE_DIR/ && \
    sudo chmod -R 777 $SITE_DIR && \
    #sudo service mysql start > /dev/null && \
    sudo service apache2 start && \
    sudo tail -f $APACHE_LOG_DIR/access.log -f $APACHE_LOG_DIR/error.log
    
VOLUME ["/var/www/html"]
