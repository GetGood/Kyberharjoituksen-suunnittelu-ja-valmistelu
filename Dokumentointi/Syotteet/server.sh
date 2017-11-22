#!/usr/bin/env bash
# based on Ben Randy's shinatra web server https://github.com/benrady/shinatra
RESPONSE="HTTP/1.1 200 OK\r\nConnection: keep-alive\r\n\r\n${2:-"OK"}\r\n"
while { echo -en "$RESPONSE"; } | ncat -l "${1:-8080}"; do
  echo "another one falls for the link"
done
