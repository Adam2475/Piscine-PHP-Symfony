#!/usr/bin/sh

# -s for silent, -I only fetches HTTP headers
result=$(curl -s -I "$1" | grep "Location:" | cut -d' ' -f2)
echo "$result"

#tests
# bit.ly/4lltZjA
# bit.ly/1O72s3U