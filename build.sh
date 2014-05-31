#!/bin/bash
git add --all

echo "...enter commit message"
read message
git commit -m "$message"
echo "...end commit...now pulling"
git pull
echo "...end pull....now pushing"
git push origin master
