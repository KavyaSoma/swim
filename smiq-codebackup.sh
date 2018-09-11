#!/bin/bash
cd /home/centos/backup
mkdir -p /home/centos/backup/workdir
time_stamp=$(date +%Y_%m_%d_%H_%M_%S)
mkdir -p "/home/centos/backup/workdir/${time_stamp}"
sudo cp -r /var/www/html/new-swimmiq "/home/centos/backup/workdir/${time_stamp}"
cd "/home/centos/backup/workdir/${time_stamp}/"
tar cvfz "$1_${time_stamp}.tgz" *
s3cmd put "$1_${time_stamp}.tgz"  s3://smiqdbbackup
sudo rm -rf /home/centos/backup/workdir/
