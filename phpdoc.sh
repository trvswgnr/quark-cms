#!/usr/bin/env bash
DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" >/dev/null 2>&1 && pwd)"; cd $DIR
phpdoc -d ./ -f "index.php,header.php" -t ./docs --ignore=vendor/*
