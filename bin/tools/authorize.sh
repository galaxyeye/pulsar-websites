#!/usr/bin/env sh

bin=$(dirname "$0")
bin=$(cd "$bin">/dev/null || exit; pwd)

config=$(cd "$bin/../../config">/dev/null || exit; pwd)
if [ -e "$config/private/database.php" ]; then
  cp "$config/private/database.php" "$config"
else
  cp "$config/public/database.php" "$config"
fi

if [ ! -e "$config/database.php" ]; then
  echo "Database is not configured"
  exit 0;
fi

bin/cake acl_extras aco_update
bin/cake privilege_grantor
