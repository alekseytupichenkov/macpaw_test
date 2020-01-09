#!/usr/bin/env bash

set -e

# Set code user same UID and GID as host user
TARGET_UID=$(stat -c "%u" /var/www/macpawtest)
TARGET_GID=$(stat -c "%g" /var/www/macpawtest)

if [[ ${TARGET_UID} != 0 ]] || [[ ${TARGET_GID} != 0 ]]; then
    echo '* Working around permission errors by making sure that "code" has the same uid and gid as the host user'
fi

if [[ ${TARGET_UID} != 0 ]]; then
    echo ' -- Setting code uid to '${TARGET_UID}
    usermod -o -u $TARGET_UID code || true
fi

if [[ ${TARGET_GID} != 0 ]]; then
    echo ' -- Setting code gid to '${TARGET_GID}
    groupmod -o -g ${TARGET_GID} code || true
fi

exec "$@"
