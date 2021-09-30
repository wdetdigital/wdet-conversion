#!/usr/bin/env python
import csv
import os
import sys
import xml.dom.minidom as minidom
import xml.etree.ElementTree as ET

from wdet import generate

DB_HOST = os.getenv("DB_HOST", "127.0.0.1")
DB_DATABASE = os.getenv("DB_DATABASE", "webproject")
DB_USER = os.getenv("DB_USER", "webproject")
DB_PASS = os.getenv("DB_PASS")  # no default, must be passed in
SITE_URL = os.getenv("SITE_URL", "https://wdetcms.wdet.org")


def run(xml_path, redirect_path):
    xml, redirects = generate.wxr(
        DB_HOST, DB_DATABASE, DB_USER, DB_PASS, SITE_URL
    )

    reparsed = minidom.parseString(ET.tostring(xml, encoding="unicode"))
    with open(xml_path, "wb") as f:
        f.write(reparsed.toprettyxml(indent="  ", encoding="UTF-8"))

    with open(redirect_path, "w", newline="") as csvfile:
        fieldnames = [
            "source",
            "target",
            "regex",
            "type",
            "code",
            "match",
            "hits",
            "title",
        ]
        defaults = {
            "regex": "0",
            "type": "url",
            "code": "301",
            "match": "url",
            "hits": "0",
            "title": "",
        }
        writer = csv.DictWriter(csvfile, fieldnames=fieldnames)

        writer.writeheader()
        for redirect in redirects:
            redirect.update(defaults)
            writer.writerow(redirect)


if __name__ == "__main__":
    run(sys.argv[1], sys.argv[2])
