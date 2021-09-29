#!/usr/bin/env python
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


def run(path):
    xml = generate.wxr(DB_HOST, DB_DATABASE, DB_USER, DB_PASS, SITE_URL)
    reparsed = minidom.parseString(ET.tostring(xml, encoding="unicode"))
    with open(path, "wb") as f:
        f.write(reparsed.toprettyxml(indent="  ", encoding="UTF-8"))


if __name__ == "__main__":
    run(sys.argv[1])
