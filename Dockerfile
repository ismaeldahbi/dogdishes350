FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Copy all your project files
COPY . .

# Move public folder contents to Apache's root
RUN rm -rf /var/www/html/html && \
    cp -r public/* /var/www/html/

# Set index.php as the default file
RUN echo "<IfModule dir_module>\n    DirectoryIndex index.php index.html\n</IfModule>" > /etc/apache2/mods-enabled/dir.conf

# Fix the ServerName warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

EXPOSE 80
CMD ["apache2-foreground"]
