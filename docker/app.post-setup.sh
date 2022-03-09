#!/bin/bash

# Activate wp-graphql

source _lib.sh

install_gravityforms
install_gravityforms_signature
install_gravityforms_chainedselects
install_gravityforms_quiz
setup_plugin

# If maintenance mode is active, de-activate it
if $( wp maintenance-mode is-active --allow-root ); then
  echo "Deactivating maintenance mode"
  wp maintenance-mode deactivate --allow-root
fi
