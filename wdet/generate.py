import xml.etree.ElementTree as ET

import mysql.connector

from . import category, tag


def wxr_header(site_url):
    root = ET.Element(
        "rss",
        attrib={
            "version": "2.0",
            "xmlns:excerpt": "http://wordpress.org/export/1.2/excerpt/",
            "xmlns:content": "http://purl.org/rss/1.0/modules/content/",
            "xmlns:wfw": "http://wellformedweb.org/CommentAPI/",
            "xmlns:dc": "http://purl.org/dc/elements/1.1/",
            "xmlns:wp": "http://wordpress.org/export/1.2/",
        },
    )
    channel = ET.SubElement(root, "channel")

    e = ET.SubElement(channel, "wp:wxr_version")
    e.text = "1.2"
    e = ET.SubElement(channel, "wp:base_site_url")
    e.text = site_url

    return root, channel


# reads in data from the django CMS database and returns an XML file to be exported
def wxr(host, database, user, password, site_url):
    connection = mysql.connector.connect(
        host=host, database=database, user=user, password=password
    )
    root, channel = wxr_header(site_url)

    # skip over any existing term IDs
    term_id = 1000

    # generate tags
    term_id = tag.generate(connection, channel, term_id)
    term_id, redirects = category.generate(connection, channel, term_id)

    return root, redirects
