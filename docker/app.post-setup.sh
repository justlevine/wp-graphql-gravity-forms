#!/bin/bash

# Activate wp-graphql

source _lib.sh

install_plugins
post_setup
wp plugin activate wp-graphql-gravity-forms --allow-root

# If maintenance mode is active, de-activate it
if $( wp maintenance-mode is-active --allow-root ); then
  echo "Deactivating maintenance mode"
  wp maintenance-mode deactivate --allow-root
fi
