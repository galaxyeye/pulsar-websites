#!/usr/bin/env sh

bin=$(dirname "$0")
bin=$(cd "$bin">/dev/null || exit; pwd)

bin/cake acl_extras aco_update
bin/cake privilege_grantor
