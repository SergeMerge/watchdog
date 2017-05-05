#!/usr/bin/env bash

##
# Detect the ownership of the webroot
# and run php as that user.
#
main() {
    local owner group owner_id group_id tmp
    read owner group owner_id group_id < <(stat -c '%U %G %u %g' .)
    echo ${owner}
    echo ${group}
    echo ${owner_id}
    echo ${group_id}
    if [[ ${owner} = UNKNOWN ]]; then
        owner=$(getname)
        if [[ ${group} = UNKNOWN ]]; then
            group=${owner}
            addgroup --system --gid "$group_id" "$group"
        fi
        adduser --system --uid=${owner_id} --gid=${group_id} "$owner"
    fi
    prepare ${owner} ${group}

}

getname() {
    echo "backend"
}

prepare() {
    if [[ -f /usr/local/etc/php-fpm.d/www.conf ]];then
        sed -i "s/user = .*/user = ${1}/" /usr/local/etc/php-fpm.d/www.conf && \
        sed -i "s/group = .*/group = backend/" /usr/local/etc/php-fpm.d/www.conf
    fi
    # Not volumes, so need to be chowned
    chown -R "backend:backend" /app/var/
}

runAsUser()
{
	DEFAULT_USER=$(getname)
	USER=${2:-${DEFAULT_USER}}
	sudo -u ${USER} bash -c "${1}"
}
