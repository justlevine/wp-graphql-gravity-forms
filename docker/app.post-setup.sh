#!/bin/bash

# Activate wp-graphql

source _lib.sh

install_plugins
wp plugin activate wp-graphql-gravity-forms --allow-root

# Set pretty permalinks.
wp rewrite structure '/%year%/%monthnum%/%postname%/' --allow-root

wp db export "${DATA_DUMP_DIR}/dump.sql" --allow-root

# If maintenance mode is active, de-activate it
if $(wp maintenance-mode is-active --allow-root); then
	echo "Deactivating maintenance mode"
	wp maintenance-mode deactivate --allow-root
fi

chown -R www-data:www-data "${WP_ROOT_FOLDER}"
find "${WP_ROOT_FOLDER}" -type d -exec chmod 0775 {} \;
find "${WP_ROOT_FOLDER}" -type f -exec chmod 0664 {} \;
