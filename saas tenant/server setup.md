#!/bin/bash
# Apache, PHP 8.4, and Laravel Required Extensions Installation Script

# Step 1: Update the System
sudo apt update && sudo apt upgrade -y

# Step 2: Install Apache
sudo apt install apache2 -y
sudo systemctl start apache2
sudo systemctl enable apache2

# Step 3: Add PHP 8.4 Repository
sudo apt install software-properties-common -y
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update

# Step 4: Install PHP 8.4 and Apache PHP Module
sudo apt install php8.4 libapache2-mod-php8.4 -y

# Step 5: Install Required PHP Extensions for Laravel
sudo apt install php8.4-cli php8.4-curl php8.4-mbstring php8.4-xml php8.4-bcmath \
php8.4-json php8.4-zip php8.4-tokenizer php8.4-common php8.4-mysql php8.4-soap \
php8.4-intl php8.4-readline -y

# Step 6: Configure Apache for PHP
sudo a2enmod php8.4
sudo systemctl restart apache2

# Step 7: Install and Configure Self-Signed SSL
# Generate a Self-Signed SSL Certificate
sudo mkdir -p /etc/ssl/self-signed
sudo openssl req -x509 -nodes -days 365 -newkey rsa:2048 \
    -keyout /etc/ssl/self-signed/selfsigned.key \
    -out /etc/ssl/self-signed/selfsigned.crt \
    -subj "/C=US/ST=State/L=City/O=Organization/OU=Department/CN=your-domain.com"

# Update Apache SSL Configuration
sudo bash -c 'cat > /etc/apache2/sites-available/default-ssl.conf <<EOF
<VirtualHost *:443>
    ServerAdmin webmaster@localhost
    DocumentRoot /var/www/html

    SSLEngine on
    SSLCertificateFile /etc/ssl/self-signed/selfsigned.crt
    SSLCertificateKeyFile /etc/ssl/self-signed/selfsigned.key

    <Directory /var/www/html>
        AllowOverride All
    </Directory>
</VirtualHost>
EOF'

# Enable SSL and Restart Apache
sudo a2enmod ssl
sudo a2ensite default-ssl
sudo systemctl restart apache2

# Step 8: Verify PHP Installation
php -v

# Step 9: Test PHP with Apache
# Create a test PHP file
sudo bash -c 'echo "<?php phpinfo(); ?>" > /var/www/html/info.php'

# Provide Instructions to Access Test Page
echo "PHP is installed. You can test it by visiting: http://your-server-ip/info.php"
echo "After testing, remove the test file for security: sudo rm /var/www/html/info.php"

# Laravel Required Extensions Installed
echo "Apache, PHP 8.4, and all required PHP extensions for Laravel are installed."

# Step 10: Add New Server to Load Balancer
# Edit Nginx Configuration on Load Balancer
echo "To add a new server to the load balancer, follow these steps:"
echo "1. SSH into the load balancer."
echo "2. Edit the Nginx configuration: sudo nano /etc/nginx/sites-available/load-balancer"
echo "3. Add the new server IP (e.g., 10.0.0.4) to the upstream block:"
echo "   upstream backend {\n       server 10.0.0.3;\n       server 10.0.0.4;\n   }"
echo "4. Test the configuration: sudo nginx -t"
echo "5. Reload Nginx: sudo systemctl reload nginx"
echo "New server has been added to the load balancer."

# How to Install Nginx and Configure as a Load Balancer

# Step 1: Install Nginx
sudo apt update
sudo apt install nginx -y

# Step 2: Allow Port on UFW
sudo ufw allow 80
sudo ufw allow 443

# Step 3: Configure Nginx as a Load Balancer
sudo bash -c 'cat > /etc/nginx/sites-available/load-balancer <<EOF
upstream backend {
    server 10.0.0.3;
    server 10.0.0.4;
}

server {
    listen 80;
    server_name servcp.com *.servcp.com;

    location / {
        proxy_pass http://backend;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
    }
}
EOF'

sudo rm /etc/nginx/sites-enabled/default
sudo rm /etc/nginx/sites-available/default


sudo ln -s /etc/nginx/sites-available/load-balancer /etc/nginx/sites-enabled/
sudo systemctl restart nginx

# Step 4: Test Nginx Configuration
sudo nginx -t
sudo systemctl reload nginx

echo "Nginx is configured as a load balancer."

# How to Install a DNS-Based SSL Certificate for servcp.com Domain

# Step 1: Install Certbot and Nginx Plugin
sudo apt install certbot python3-certbot-nginx -y

# Step 2: Obtain SSL Certificate with DNS Validation
sudo certbot certonly --manual --preferred-challenges=dns \
    -d servcp.com -d *.servcp.com \
    --agree-tos --email admin@servcp.com

# Step 3: Add DNS TXT Record
# Certbot will prompt you to add a TXT record. Follow the instructions.
# Example:
# _acme-challenge.servcp.com TXT "random-value"
# Wait for DNS propagation, then press Enter in Certbot.

# Step 4: Configure Nginx for SSL
sudo bash -c 'cat > /etc/nginx/sites-available/load-balancer <<EOF
upstream backend {
    server 10.0.0.3;
    server 10.0.0.4;
}

server {
    listen 443 ssl;
    server_name servcp.com *.servcp.com;

    ssl_certificate /etc/letsencrypt/live/servcp.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/servcp.com/privkey.pem;

    location / {
        proxy_pass http://backend;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
    }
}
EOF'

sudo ln -s /etc/nginx/sites-available/load-balancer /etc/nginx/sites-enabled/
sudo systemctl reload nginx

# Step 5: Test SSL Configuration
sudo certbot renew --dry-run
echo "DNS-based SSL certificate for servcp.com is installed."

# How to Install Redis

# Step 1: Update the System
sudo apt update && sudo apt upgrade -y

# Step 2: Install Redis Server
sudo apt install redis-server -y

# Step 3: Configure Redis
# Open the Redis configuration file:
sudo nano /etc/redis/redis.conf
# Update the following settings as needed:
# - Set "supervised" to "systemd" (for modern systems):
#   supervised systemd

# Save the file and restart Redis:
sudo systemctl restart redis

# Step 4: Enable Redis on System Startup
sudo systemctl enable redis-server

# Step 5: Verify Redis Installation
# Test Redis with the CLI tool:
redis-cli ping
# It should return: PONG

echo "Redis is installed and configured."

# How to Configure Additional IP Addresses with Netplan (Ubuntu)

# Step 1: Edit the Netplan Configuration File
sudo nano /etc/netplan/01-netcfg.yaml

# Example Configuration:
network:
  version: 2
  renderer: networkd
  ethernets:
    eth0:
      addresses:
        - 192.168.0.250/32
        - 2001:db8:1234::1/64
      routes:
        - to: 0.0.0.0/0
          via: 192.168.0.1
          on-link: true
          metric: 100  # Lower metric, higher priority
        - to: ::/0
          via: fe80::1
          metric: 100
      nameservers:
        addresses:
          - 8.8.8.8
          - 2001:4860:4860::8888

    enp7s0:
      addresses:
        - 10.0.0.3/24
        - 2001:db8:abcd::3/64
      dhcp4: false
      routes:
        - to: 0.0.0.0/0
          via: 10.0.0.1
          metric: 200  # Higher metric, lower priority
        - to: ::/0
          via: fe80::2
          metric: 200



# Step 2: Apply the Configuration
sudo netplan apply

echo "Netplan configuration updated with additional IP addresses."
