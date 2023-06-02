#!/bin/bash -e

echo "# Starting supervisor ..."
/usr/bin/supervisord -n -c /etc/supervisor/supervisord.conf
