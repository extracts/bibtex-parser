$software = <<SCRIPT
# Downgrade to PHP 7.1
apt-add-repository -y ppa:ondrej/php
apt-get -yq update
apt-get -yq install php7.1

# Install required PHP packages
apt-get -yq install php7.1-dom
apt-get -yq install php7.1-mbstring
apt-get -yq install php7.1-curl
apt-get -yq install php7.1-zip
SCRIPT

$pandoc = <<SCRIPT
apt-get -yq install pandoc
SCRIPT

$composer = <<SCRIPT
cd /vagrant
bin/install-composer.sh
bin/composer update
SCRIPT

$environment = <<SCRIPT
if ! grep "cd /vagrant" /home/vagrant/.profile > /dev/null; then
  echo "cd /vagrant" >> /home/vagrant/.profile
fi
if ! grep "PATH=/vagrant/bin" /home/vagrant/.bashrc > /dev/null; then
  echo "export PATH=/vagrant/bin:$PATH" >> /home/vagrant/.bashrc
fi
SCRIPT

$help = <<SCRIPT
echo "Use 'vagrant ssh' to log into VM and 'logout' to leave it."
echo "In VM use:"
echo "'composer test' for running tests"
echo "'composer update' to update dependencies"
SCRIPT

Vagrant.configure("2") do |config|
  config.vm.box = "bento/ubuntu-20.04"

  config.vm.provision "Install required software...", type: "shell", inline: $software
  config.vm.provision "Install Pandoc...", type: "shell", inline: $pandoc
  config.vm.provision "Install Composer dependencies...", type: "shell", privileged: false, inline: $composer
  config.vm.provision "Setup environment...", type: "shell", inline: $environment
  config.vm.provision "Help", type: "shell", privileged: false, inline: $help
end
