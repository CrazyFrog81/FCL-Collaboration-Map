# Organic Collaboration in a Multidisciplinary Research Institute

"Organic Collaboration in a Multidisciplinary Research Institute" is a research project of The Future Cities Laboratory(FCL) at Singapore-ETH Centre. This project will help to investigate the process behind the emergence of organic collaboration in a multidisciplinary research centre.

This project includes sub-projects: 
1. Collaboration Form
2. Collaboration Network (https://github.com/sisisalia/FCL-Collaboration-Network-Map)

# Collaboration Form
This sub-project is a web application to collect information of FCL researchers by using Symfony.

## Getting Started

1. Download All files to Desktop
2. Go to the root folder from terminal and run 'composer update'
3. Go to 'app/config/config_dev.yml' and 'app/config/config.yml' to add your Email(gmail) information accordingly at the end of the lines for each file.
4. Run 'php  bin/console server:run' on terminal
5. Filled up the database information and Email(gmail) information
6. Go to web browser and run the URL stated in the terminal.

## Deployment

Deployment into an Apache server required database server, preferable MySQL. Read more on how to configure Apache server from the link: http://symfony.com/doc/current/setup/web_server_configuration.html.

A few things to note:
1. Rewrite module in Apache server is enabled.
2. 'cache/dev' and 'cache/log' in Symfony project is writtable.
