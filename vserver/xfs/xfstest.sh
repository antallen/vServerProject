#!/bin/bash
echo "Help";
sudo -u root /usr/sbin/xfs_quota -x -c 'report' /media
sudo -u root xfs_quota -x -c 'project -s dgg' /media
