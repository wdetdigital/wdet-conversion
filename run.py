#!/usr/bin/env python
import csv
import logging
import os
import os.path
import sys
import xml.dom.minidom as minidom
import xml.etree.ElementTree as ET

from wdet import generate

LOG = logging.getLogger(__name__)

DB_HOST = os.getenv("DB_HOST", "127.0.0.1")
DB_DATABASE = os.getenv("DB_DATABASE", "webproject")
DB_USER = os.getenv("DB_USER", "webproject")
DB_PASS = os.getenv("DB_PASS")  # no default, must be passed in
SITE_URL = os.getenv("SITE_URL", "https://wdetcms.wdet.org")


def run(xml_path, redirect_path):
    xmls, redirects = generate.wxr(
        DB_HOST, DB_DATABASE, DB_USER, DB_PASS, SITE_URL
    )

    for index, xml in enumerate(xmls):
        LOG.info("Processing XML chunk %d", index + 1)
        reparsed = minidom.parseString(ET.tostring(xml, encoding="unicode"))
        LOG.info("XML prettified")

        name, ext = os.path.splitext(xml_path)
        chunk_path = f"{name}-{index:02}{ext}"
        with open(chunk_path, "wb") as f:
            f.write(reparsed.toprettyxml(indent="  ", encoding="UTF-8"))
        LOG.info("Finished writing XML")

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
    LOG.info("Finished writing redirects")


if __name__ == "__main__":
    logging.basicConfig(
        format="%(asctime)s %(levelname)s %(name)s: %(message)s",
        level=logging.INFO,
    )
    run(sys.argv[1], sys.argv[2])
