#!/usr/bin/env sh

bin=$(dirname "$0")
bin=$(cd "$bin">/dev/null || exit; pwd)

sudo mysql -u root < "$bin/../../data/Dump20201006.sql"
